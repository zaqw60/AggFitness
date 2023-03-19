<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/carousel.css') }}" rel="stylesheet">
    <!-- MAIN CSS -->
    <link href="{{ asset('assets/css/templatemo-style.css') }}" rel="stylesheet">
    <!--ACCOUNT-->
    <link href="{{ asset('assets/css/account.css') }}" rel="stylesheet">
</head>

<body>
    <div class="bg-dark w-100 rounded-1" style="margin: 0px auto;">
        <div class="p-4 text-center">
            <h5 class="text-success">Спасибо, что остаетесь с нами!</h5>
        </div>
        <div class="border-top border-2 border-success p-4">
            <div class="d-flex justify-content-between flex-wrap">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a class="link-light text-white-50" href="{{ route('info.home') }}"
                            class="nav-link p-0 text-muted" target="blank">Главная</a>
                    </li>
                    <li class="nav-item mb-2"><a class="link-light text-white-50"
                            href="{{ route('trainers.index', ['tag_id' => 0, 'city_id' => 0]) }}"
                            class="nav-link p-0 text-muted" target="blank">Тренеры</a></li>
                    <li class="nav-item mb-2"><a class="link-light text-white-50"
                            href="{{ route('gyms.index', ['city_id' => 0]) }}" class="nav-link p-0 text-muted"
                            target="blank">Фитнес-клубы</a>
                    </li>
                </ul>
                <img class="logo_image" src="{{ asset('assets/images/logo.png') }}" alt="logo">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a class="link-light text-white-50" href="{{ route('info.about') }}"
                            class="nav-link p-0 text-muted" target="blank">О проекте</a></li>
                    <li class="nav-item mb-2"><a class="link-light text-white-50" href="{{ route('info.contacts') }}"
                            class="nav-link p-0 text-muted" target="blank">Контакты</a>
                    </li>
                    <li class="nav-item mb-2"><a class="link-light text-white-50" href="{{ route('info.developers') }}"
                            class="nav-link p-0 text-muted" target="blank">Разработчики</a>
                    </li>
                </ul>
            </div>
            <div class="bg-light px-3 py-2 mx-1 my-4 rounded-2">
                {!! $data->message !!}
            </div>
            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
                <p>&copy; {{ date('Y') }} AggFitness, частное приложение. Все права защищены</p>
            </div>
        </div>
    </div>
</body>

</html>
