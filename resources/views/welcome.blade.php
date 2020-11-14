@extends('layouts.app')

@section('content')

        <div class="section">
            <div class="container my-3">
                <div class="row">
                    <div class="col border-right">
                        <a href="#">
                            <img src="img/banner-main.png" alt="services" width="600px">
                        </a>
                    </div>

                    <div class="col mt-4">
                        <a class="btn-link-main" style="font-size: 32px" href="{{route('home')}}">
                            <h4>Сервис валидации почтовых адресов</h4>
                            <span>Мы позаботились о Ваших адресных базах. Теперь вы можете не переживать за то, что ваши посылки прийдут на ошибочный адрес, или с задержкой!
                           <br> Сервис валидации почтовых адресов поможет нормализовать и устранить все ошибки в Ваших адресных базах.</span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row border-top border-bottom">
                <div class="container">
                    <div class="row justify-content-around" style="padding: 16px;">
                        <div class="col-auto">
                            <a class="btn-link-main" style="font-size: 18px" href="#">Письма</a>
                        </div>
                        <div class="col-auto">
                            <a class="btn-link-main" style="font-size: 18px" href="#">Отправить посылку</a>
                        </div>
                        <div class="col-auto">
                            <a class="btn-link-main" style="font-size: 18px" href="#">Вызвать курьера</a>
                        </div>
                        <div class="col-auto">
                            <a class="btn-link-main" style="font-size: 18px" href="#">Платежи и переводы</a>
                        </div>
                        <div class="col-auto">
                            <a class="btn-link-main" style="font-size: 18px" href="#">Отделения</a>
                        </div>
                        <div class="col-auto">
                            <a class="btn-link-main" style="font-size: 18px" href="#">Другие сервисы</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    <div class="section" style="background-color: #f7f7f7">
        <div class="container">
            <div class="row pt-4 justify-content-around">
                <div class="col-auto border footer-cards" style="width: 300px">
                    <a href="#" style="text-decoration: none; color: gray; line-height: 1;">
                        <row class="row">
                            <div class="col-3">
                                <img src="img/Эзп%20обновление%20June.png" alt="" style="width: 100%;">
                            </div>
                            <div class="col">
                                <h3 class="btn-link-main" style="font-size: 18px;">Заказные письма</h3>
                                <p style="font-size: 14px;">Бесконтактная онлайн отправка и получение</p>
                            </div>
                        </row>
                    </a>
                </div>
                <div class="col-auto border footer-cards" style="width: 300px">
                    <a href="#" style="text-decoration: none; color: gray; line-height: 1;">
                        <row class="row">
                            <div class="col-3">
                                <img src="img/Эзп%20обновление%20June.png" alt="" style="width: 100%;">
                            </div>
                            <div class="col">
                                <h3 class="btn-link-main" style="font-size: 18px;">Заказные письма</h3>
                                <p style="font-size: 14px;">Бесконтактная онлайн отправка и получение</p>
                            </div>
                        </row>
                    </a>
                </div>
                <div class="col-auto border footer-cards" style="width: 300px">
                    <a href="#" style="text-decoration: none; color: gray; line-height: 1;">
                        <row class="row">
                            <div class="col-3">
                                <img src="img/Эзп%20обновление%20June.png" alt="" style="width: 100%;">
                            </div>
                            <div class="col">
                                <h3 class="btn-link-main" style="font-size: 18px;">Заказные письма</h3>
                                <p style="font-size: 14px;">Бесконтактная онлайн отправка и получение</p>
                            </div>
                        </row>
                    </a>
                </div>
            </div>

            <div class="row pt-4">
                <div class="col-5">
                    <span style="color: gray;">2020 © АО Почта России</span>
                </div>
                <div class="col">
                    <div class="row float-right pr-3" style="color: gray">
                        <div class="col-auto">
                            <i class="fab fa-vk"></i>
                            <i class="fab fa-facebook-f"></i>
                            <i class="fab fa-instagram"></i>
                            <i class="fab fa-odnoklassniki"></i>
                            <i class="fab fa-twitter"></i>
                        </div>
                        <div class="col-auto">
                            <a class="btn-link-footer" href="#">Раскрытие информации</a>
                        </div>
                        <div class="col-auto">
                            <a class="btn-link-footer" href="#">Вакансии</a>
                        </div>
                        <div class="col-auto">
                            <a class="btn-link-footer" href="#">Пресс-центр</a>
                        </div>
                        <div class="col-auto">
                            <a class="btn-link-footer" href="#">О компании</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
