<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessRecord;
use App\RegistryRecord;
use Carbon\Carbon;
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

        $record = RegistryRecord::create([
            'source_filename' => $name,
            'user_id' => $request->user()->id
        ]);

        $job = (new ProcessRecord($record))
            ->delay(Carbon::now()->addSecond(2));

        dispatch($job);

        return redirect()->route('home.reports');
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

    private function getAccuracyString($accuracy) {
        $text = '';

        switch ($accuracy[0]) {
            case '0':
                $text .= 'Индекс определен по дому / квартире.';
                break;
            case '1':
                $text .= 'Индекс определен по улице.';
                break;
            case '2':
                $text .= 'Индекс определен по нас. пункту';
                break;
            case '3':
                $text .= 'Индекс не определен';
                break;
        }

        switch ($accuracy[1]) {
            case '0':
                $text .= ' Дом найден в ФИАС.';
                break;
            case '1':
                $text .= ' Дом определен из запроса.';
                break;
            case '2':
                $text .= ' Дом не определен.';
                break;
        }

        switch ($accuracy[2]) {
            case '0':
                $text .= ' Квартира найдена в ФИАС.';
                break;
            case '1':
                $text .= ' Квартира определена из запроса.';
                break;
            case '2':
                $text .= ' Квартира не определена';
                break;
        }

        return $text;
    }

    private function getElementContent($char, $elements) {
        foreach ($elements as $el) {
            if ($char == $el->content) {
                return $el->val ?? '';
            }
        }

        return '';
    }
}
