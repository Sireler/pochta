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
                                <h2 class="text-secondary">Здравствуйте, {{ Auth::user()->name }}</h2>
                                <div class="text-primary font-weight-bold"><h4 class="ml-4">Общая статистика:</h4></div>
                                <div class="row justify-content-center">

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

                                    <!--
                                <div class="col-10 ">
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="row">
                                                <div class="col list-unstyled">
                                                    <ul class="alert-info cabinet-info-desk list-unstyled">
                                                        <li>
                                                            <span>Всего загружено фалов: {{ $filesUploaded ?? 0 }}</span>
                                                        </li>
                                                        <li>
                                                            <span>Всего обработано строк: {{ $rowsProcessed ?? 0 }}</span>
                                                        </li>
                                                        <li>
                                                            <span class="alert-success">Всего успешно обработанных строк: {{ $successRowsProcessed ?? 0 }}</span>
                                                        </li>
                                                        <li>
                                                            <span class="alert-warning">Всего исправлено файлов: {{ $warningRowsProcessed ?? 0 }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                      -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
