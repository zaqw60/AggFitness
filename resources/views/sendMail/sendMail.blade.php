@extends('layouts.admin')
@section('title')
    Рассылка сообщений @parent
@endsection
@section('content')
    <style>
        .sendDiv {
            min-height: 750px;
            padding: 150px 0px;
        }

        .sendarea {
            padding: 15px 0px;
        }
    </style>

    <div class="container marketing sendDiv">
        @if (Session::has('time'))
            <div class="bg-dark p-4 col-md-5 text-center mb-3 shadow rounded-2">
                <p class="text-success m-0">Время выполнения: <span class="text-light">{{ Session::get('time') }}</span> сек.
                </p>
            </div>
        @endif
        <div class="accordion shadow rounded-2" id="accordionExample">

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h3>Рассылка электронной почты</h3>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form method="post" action="{{ route('admin.send.send') }}">
                            @csrf
                            <input type="hidden" name="email" value="true">
                            <div class="form-group sendarea" placeholder="Кому">
                                <select class="form-control" name="addressee">
                                    <option class="form-group">Администраторам</option>
                                    <option class="form-group" selected>Тренерам</option>
                                    <option class="form-group">Представителям фитнес-клуба</option>
                                    <option class="form-group">Клиентам сайта</option>
                                    <option class="form-group">Подписавшимся</option>
                                    <option class="form-group">Тестовый адрес</option>
                                </select>
                            </div>
                            <div class="form-group sendarea">
                                <textarea class="form-control" name="message" placeholder="Ваше сообщение" required maxlength="500" rows="3">{{ old('message') ?? '' }}</textarea>
                            </div>
                            <div class="form-group sendarea">
                                <button type="submit" class="btn btn-outline-success">Отправить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h3>Рассылка в телеграмм</h3>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form method="post" action="{{ route('admin.send.send') }}">
                            @csrf
                            <input type="hidden" name="telegramm" value="true">
                            <div class="form-group sendarea">
                                <textarea class="form-control" name="message" placeholder="Ваше сообщение" required maxlength="500" rows="3">{{ old('message') ?? '' }}</textarea>
                            </div>
                            <div class="form-group sendarea">
                                <button type="submit" class="btn btn-outline-success">Отправить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
