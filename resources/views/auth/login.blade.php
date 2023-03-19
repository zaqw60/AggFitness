@extends('layouts.main')
@section('title')
    Вход
    @parent
@endsection
@section('content')
    <hr class="featurette-divider">

    <div class="container">

        <div class="card">
            <div class="card-header">
                {{ __('Авторизация') }}
            </div>
            <div class="card-body d-flex align-items-start flex-wrap">
                <img class="w-25 me-4 align-self-center" src="{{ asset('assets/images/reg.jpg') }}" alt="img">
                <form class="flex-grow-1" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email адрес') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Запомнить меня') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-outline-success mb-1">
                                {{ __('Войти') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Забыли пароль?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
                <div class="d-flex flex-column p-3 me-3 shadow rounded-2">
                    <a class="social_blue rounded-circle mb-3"
                        href="{{ route('social.auth.redirect', ['driver' => 'mailru']) }}"><img
                            src="{{ asset('assets/images/mailru.png') }}" alt="img"></a>
                    <a class="social_dark rounded-circle mb-3"
                        href="{{ route('social.auth.redirect', ['driver' => 'github']) }}"><img
                            src="{{ asset('assets/images/git.png') }}" alt="img"></a>
                    <a class="social_blue rounded-1 mb-3"
                        href="{{ route('social.auth.redirect', ['driver' => 'vkontakte']) }}"><img
                            src="{{ asset('assets/images/vk.png') }}" alt="img"></a>
                    <a class="social_red rounded-1 mb-0"
                        href="{{ route('social.auth.redirect', ['driver' => 'yandex']) }}"><img
                            src="{{ asset('assets/images/ya.png') }}" alt="img"></a>
                </div>
            </div>
        </div>
    </div>


    <hr class="featurette-divider">
@endsection
