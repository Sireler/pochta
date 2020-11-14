@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div style="background-color: rgb(0, 85, 166)" class="card-header text-white">Сервис валидации почтовых адресов</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif


                                @include('home_navbar')
                            </div>
                            <div class="col-md-9">
                                <table class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th scope="col">Обработано строк</th>
                                        <th scope="col">Успешно</th>
                                        <th scope="col">Ошибок</th>
                                        <th scope="col">Дата</th>
                                        <th scope="col">Статус обработки</th>
                                        <th scope="col">Управление</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($records as $record)
                                        <tr>
                                            <td>
                                                <div class="alert alert-primary">
                                                    {{ $record->rows_count ?? 'Подождите, файл обрабатывается' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="alert alert-success">
                                                    {{ $record->rows_success }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="alert alert-warning">
                                                    {{ $record->rows_warning }}
                                                </div>
                                            </td>
                                            <td>
                                                {{ date($record->created_at->format('d.m.Y H:i')) }}
                                            </td>
                                            <td>
                                                <div class="progress">
                                                    <div id="progress-{{ $record->id }}" class="progress-bar" role="progressbar" style="width: {{ $record->progress * 100 }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                                        {{ $record->progress * 100 }}%
                                                    </div>
                                                </div>
                                            </td>
                                            <td>

                                                <div class="dropdown">
                                                    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Управление
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <form action="{{ route('home.download') }}">
                                                            @csrf
                                                            <input type="text" name="record_id" value="{{ $record->id }}" hidden>
                                                            <input type="text" name="type" value="source" hidden>
                                                            <button class="dropdown-item btn btn-success mb-2">Исходный файл</button>
                                                        </form>
                                                        <form action="{{ route('home.download') }}">
                                                            @csrf
                                                            <input type="text" name="record_id" value="{{ $record->id }}" hidden>
                                                            <input type="text" name="type" value="report" hidden>
                                                            <button class="dropdown-item btn btn-success">Скачать отчет</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $( document ).ready(function() {

            $.get('/home/workProgress', function(data) {
                for (let i = 0; i < data.length; i++) {
                    let el = $('#progress-' + data[i].record);

                    el.css('width', data[i].progress * 100 + '%');
                    el.html(data[i].progress * 100 + '%');
                }
            });

            setInterval(function(){


                $.get('/home/workProgress', function(data) {
                    for (let i = 0; i < data.length; i++) {
                        let el = $('#progress-' + data[i].record);

                        el.css('width', data[i].progress * 100 + '%');
                        el.html(data[i].progress * 100 + '%');
                    }
                });
            }, 2000);
        });
    </script>
@endsection
