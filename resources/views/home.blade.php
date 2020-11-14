@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Сервис валидации почтовых адресов</div>

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
                                <h2 class="text-secondary">Здравствуйте, {{ Auth::user()->name }}</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="text-center alert alert-primary font-weight-bold">
                                            <h3>Загружено файлов:</h3>
                                            <div class="display-4">
                                                {{ $filesUploaded ?? 0 }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="text-center alert alert-primary font-weight-bold">
                                            <h3>Обработано строк:</h3>
                                            <div class="display-4">
                                                {{ $rowsProcessed ?? 0 }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="offset-md-4"></div>
                                    <div class="col-md-4">
                                        <div class="text-center alert alert-success font-weight-bold">
                                            <h3>Успешно:</h3>
                                            <div class="display-4">
                                                {{ $successRowsProcessed ?? 0 }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="text-center alert alert-warning font-weight-bold">
                                            <h3>Ошибка:</h3>
                                            <div class="display-4">
                                                {{ $warningRowsProcessed ?? 0 }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
