@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row text-center mt-5">
        <div class="col-3"></div>
        <div class="col-6 border-bottom">
            <span style="font-size: 32px;">Вход</span>
            <form class="mt-4 justify-content-center" method="POST" action="{{ route('login') }}">
                @csrf
                <input class="form-control mb-3 @error('email') is-invalid @enderror" type="text" name="email"  placeholder="Эл. почта или телефон +7-ХХХ-ХХХ-ХХ-ХХ">
                <input class="form-control @error('password') is-invalid @enderror" type="text" placeholder="Пароль" name="password">
                <div class="row justify-content-center mb-4">
                    <div class="col-4">
                        <input class="form-control mt-5" type="submit" value="Войти">
                    </div>
                </div>
            </form>
            <div class="row mb-5">
                <div class="col">
                    <a href="#">Не помню пароль</a>
                </div>
                <div class="col">
                    <a href="#">Зарегистрироваться</a>
                </div>


            </div>
            <div class="row mb-5"></div>
        </div>
        <div class="col-3"></div>
    </div>
</div>


@endsection
