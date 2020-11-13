<?php

namespace App\Http\Controllers;

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
    public function index()
    {

//        $query = array(
//            "version" => "ce2bedf1-f31c-45ed-b3a8-b67ac3d26b23",
//            'fio' => 'Иванов Петр Васильевич',
//            'addr' => [
//                [
//                    'val' => 'Российская федерация красногорск п. Новый д. 12',
//                ],
//            ],
//        );
//
//        $response = UnirestRequest::post(
//            'https://address.pochta.ru/validate/api/v7_1',
//            $this->requestHeaders,
//            json_encode($query, JSON_UNESCAPED_UNICODE)
//        );
//
//
//        dd($response);
//        $response->code;        // HTTP Status code
//        $response->headers;     // Headers
//        dd($response->body);        // Parsed body
//        $response->raw_body;    // Unparsed body
//
//
//
//
//        dd();
        return view('home');
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
        $processedData[0] = ['Исходный адрес', 'Полученный адрес'];
        $index = 1;
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
            $processedData[$index][] = $response->body->addr->outaddr;

            $index++;
        }

        $xlsx = \SimpleXLSXGen::fromArray( $processedData );
        $xlsx->downloadAs('normalized.xlsx'); // or downloadAs('books.xlsx')
    }
}
