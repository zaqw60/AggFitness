<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AggFitness @section('title') @show
    </title>

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/carousel.css') }}" rel="stylesheet">
    <!-- MAIN CSS -->
    <link href="{{ asset('assets/css/templatemo-style.css') }}" rel="stylesheet">
    <!--ACCOUNT-->
    <link href="{{ asset('assets/css/account.css') }}" rel="stylesheet">
</head>

<body class="bg-dark" id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">
    <!-- PRE LOADER -->
    <section class="preloader">
        <div class="spinner">
            <span class="spinner-rotate"></span>
        </div>
    </section>
    <x-header></x-header>
    <main class="main_back">
        <x-marketing></x-marketing>
        @yield('content')
    </main>
    <x-footer></x-footer>
    <!-- SCRIPTS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/smoothscroll.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <!-- Скрипты для маски телефона в поле input, указываем для поля input id="phone_mask" -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/mask/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/mask/main_mask.js') }}"></script>
    @stack('js')
</body>

</html>
