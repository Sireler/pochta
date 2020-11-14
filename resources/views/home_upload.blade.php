@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div style="background-color: rgb(0, 85, 166)" class="card-header text-white">Сервис валидации почтовых адресов</div>

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
                            <div class="font-weight-bold">
                                Выберите файл для загрузки в формате xlsx или csv
                            </div>

                            <form enctype="multipart/form-data" method="POST" action="{{ route('home.processUpload') }}">
                                @csrf
                                <div class="custom-file my-3">
                                    <input onchange="changeFile()" name="file" type="file" class="custom-file-input" id="validatedCustomFile" required>
                                    <label class="custom-file-label" for="validatedCustomFile">Выберите файл</label>
                                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                                    <span id="filename" class="font-weight-bold font-italic text-primary"></span>
                                </div>
                                <button onclick="sendFile()" id="submit-registry" type="submit" class="btn btn-primary">Отправить</button>

                            </form>
                            <div id="spinner" class="fa-3x text-primary" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function changeFile() {
        let fileInput = document.querySelector('#validatedCustomFile');
        if (fileInput.files.length > 0) {
            document.querySelector('#filename').innerHTML = fileInput.files[0].name;
        }
    }

    function sendFile() {
        let fileInput = document.querySelector('#validatedCustomFile');
        if (fileInput.files.length > 0) {
            let x = document.getElementById("submit-registry");
            x.style.display = "none";

            let y = document.getElementById("spinner");
            y.style.display = "block";
        }
    }
</script>
@endsection
