<?php

namespace App\Http\Controllers;

use App\RegistryRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Unirest\Request as UnirestRequest;

class HomeController extends Controller
{
    protected $requestHeaders = array(
        'Content-Type' => 'application/json',
        'AuthCode' => '53fb9daa-7f06-481f-aad6-c6a7a58ec0bb',
    );

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $filesUploaded = $request->user()->reports()->count();
        $rowsProcessed = $request->user()->reports()->sum('rows_count');
        $successRowsProcessed = $request->user()->reports()->sum('rows_success');
        $warningRowsProcessed = $request->user()->reports()->sum('rows_warning');

        return view('home', [
            'filesUploaded' => $filesUploaded,
            'rowsProcessed' => $rowsProcessed,
            'successRowsProcessed' => $successRowsProcessed,
            'warningRowsProcessed' => $warningRowsProcessed
        ]);
    }

    public function upload()
    {
        return view('home_upload');
    }

    public function processUpload(Request $request)
    {
        $file = $request->file('file');
        $name = Str::random(6) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('', $name);

        $xlsx = \SimpleXLSX::parse(Storage::disk('local')->path($name));
        $rows = $xlsx->rows(0);

        $processedData = [];
        $processedData[0] = [
            'Исходный адрес',
            'Исходный индекс',
            'Полученный адрес',
            'Статус',
            'Нераспознанные элементы',
            'Код неточности',
            'Время ответа',
            'Индекс(index)'
        ];
        $index = 1;
        $successCount = 0;
        foreach ($rows as $row) {

            $query = array(
                "version" => "ce2bedf1-f31c-45ed-b3a8-b67ac3d26b23",
                'fio' => 'Иванов Петр Васильевич',
                'addr' => [
                    [
                        'val' => $row[0],
                    ],
                ],
            );

            $response = UnirestRequest::post(
                'https://address.pochta.ru/validate/api/v7_1',
                $this->requestHeaders,
                json_encode($query, JSON_UNESCAPED_UNICODE)
            );

            $processedData[$index][] = $response->body->addr->inaddr;
            $processedData[$index][] = $response->body->index->inindex;
            $processedData[$index][] = $response->body->addr->outaddr;
            $processedData[$index][] = $response->body->state;
            $processedData[$index][] = '0';
            $processedData[$index][] = $response->body->addr->accuracy;
            $processedData[$index][] = '0';
            $processedData[$index][] = $response->body->addr->index ?? 0;

            $index++;
            if ($response->body->state == '301') {
                $successCount++;
            }
        }

        $xlsx = \SimpleXLSXGen::fromArray( $processedData );
        $normalizedPath = storage_path('app/n_' . $name);
        $xlsx->saveAs($normalizedPath); // or downloadAs('books.xlsx')

        $record = RegistryRecord::create([
            'source_filename' => $name,
            'out_filename' => 'n_' . $name,
            'rows_count' => $index,
            'rows_success' => $successCount,
            'rows_warning' => $index - $successCount,
            'user_id' => $request->user()->id
        ]);

        return redirect()->back();
    }

    public function reports(Request $request)
    {
        $records = $request->user()->reports()->orderBy('id', 'DESC')->get();

        return view('home_reports', [
            'records' => $records
        ]);
    }

    public function download(Request $request)
    {
        $type = $request->get('type');
        $record = RegistryRecord::where('id', $request->get('record_id'))->first();

        if ($type == 'report') {
            $filename = $record->out_filename;

            if (Storage::disk('local')->exists($filename)) {
                return Storage::disk('local')->download($filename);
            }
        } else {
            $filename = $record->source_filename;

            if (Storage::disk('local')->exists($filename)) {
                return Storage::disk('local')->download($filename);
            }
        }

        return redirect()->back();
    }
}
