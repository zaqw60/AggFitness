@extends('layouts.main')
@section('title')
    Восстановление пароля
    @parent
@endsection
@section('content')
    <hr class="featurette-divider">

    <div class="container">
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="card">
            <div class="card-header">
                {{ __('Забыли свой пароль? Просто сообщите нам свой email, и мы вышлем вам по электронной почте ссылку для сброса старого пароля и выбора нового.') }}
            </div>
            <div class="card-body d-flex align-items-start flex-wrap">
                <img class="w-25 me-4 align-self-center" src="{{ asset('assets/images/reg.jpg') }}" alt="img">
                <form class="flex-grow-1" method="POST" action="{{ route('password.email') }}">
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


                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-outline-success">
                                {{ __('Получить новый пароль') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <hr class="featurette-divider">
@endsection
