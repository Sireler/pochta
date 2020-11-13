@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Сервис валидации почтовых адресов</div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-auto">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif


                                @include('home_navbar')
                            </div>
                            <div class="col-auto">
                                Content
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
