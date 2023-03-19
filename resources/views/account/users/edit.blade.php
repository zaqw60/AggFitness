@extends('layouts.main')
@section('content')
    @if (Auth::user()->role_id === 2)
        <x-account.trainer.menu></x-account.trainer.menu>
    @elseif(Auth::user()->role_id === 3)
        <x-account.client.menu></x-account.client.menu>
    @elseif(Auth::user()->role_id === 4)
        <x-account.gym.menu></x-account.gym.menu>
    @endif
    <div class="offset-2 col-8">
        <hr class="featurette-divider">
        <h2>Редактирование пользователя</h2>



        <form method="post" action="{{ route('account.users.update', ['user' => $user]) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Никнейм</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                @error('name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="email">Email адрес</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
                @error('name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="tel" name="phone" class="mask-phone form-control" data-format="+7 (ddd) ddd-dd-dd"
                    value="{{ $user->phone }}">
                @error('phone')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" name="password" id="password" value="">
                @error('password')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="row mb-3">
                <div class="col-md-6">
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">Сменить
                        пароль
                    </button>
                </div>
            </div>
            <div class="collapse" id="collapseExample">
                <div class="form-group">
                    <label for="newPassword">Новый пароль</label>
                    <input type="password" class="form-control" name="newPassword" id="newPassword" value="">
                    @error('newPassword')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="newPassword-confirm">Повторите пароль</label>
                    <input id="newPassword-confirm" class="form-control" type="password" name="newPassword_confirmation"
                        autocomplete="newPassword">
                    @error('newPassword')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <br>
            <button class="btn btn-outline-success" type="submit">Сохранить</button>
        </form>
    </div>
    <hr class="featurette-divider">
@endsection

@push('js')
    <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/jquery.maskedinput.min.js') }}" type="text/javascript"></script>
    <script>
        jQuery(function($) {
            $('.mask-phone').mask('+7 (999) 999-99-99');
        });
    </script>
@endpush
