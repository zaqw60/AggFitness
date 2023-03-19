@extends('layouts.main')
@section('title')
    Восстановление пароля: новый пароль
    @parent
@endsection
@section('content')
    <hr class="featurette-divider">

    <div class="container">
        <div class="card">
            <div class="card-header">
                {{ __('Создайте новый пароль') }}
            </div>
            <div class="card-body d-flex align-items-start flex-wrap">
                <img class="w-25 me-4 align-self-center" src="{{ asset('assets/images/reg.jpg') }}" alt="img">
                <form class="flex-grow-1" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email адрес') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email', $request->email) }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Пароль') }}</label>
                        <div class="col-md-6">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div class="row mb-3">
                        <label for="password_confirmation"
                            class="col-md-4 col-form-label text-md-end">{{ __('Подтвердить пароль') }}</label>
                        <div class="col-md-6">
                            <input id="password_confirmation" type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation" required>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-outline-success">
                                {{ __('Сменить пароль') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <hr class="featurette-divider">
@endsection
