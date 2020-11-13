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
                            <form action="{{ route('home.processUpload') }}">
                                @csrf
                                <div class="custom-file my-3">
                                    <input name="file" type="file" class="custom-file-input" id="validatedCustomFile" required>
                                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл</label>
                                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                                </div>

                                <button type="submit" class="btn btn-primary">Отправить</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
