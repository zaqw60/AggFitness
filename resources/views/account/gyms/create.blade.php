@extends('layouts.main')
@section('content')
    <x-account.gym.menu></x-account.gym.menu>

    <div class="offset-2 col-8">
        <hr class="featurette-divider">
        @if (Auth::user()->gym == null)
        <h2>Заполнение данных фитнес-клуба</h2>
        <form method="post" action="{{ route('account.gyms.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" hidden>
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
                @error('title')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="phone_main">Телефон</label>
                <input type="tel" class="form-control mask-phone" name="phone_main" id="phone_main"
                    data-format="+7 (ddd) ddd-dd-dd" value="{{ old('phone_main') }}">
                @error('phone_main')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="phone_second">Телефон</label>
                <input type="tel" class="form-control mask-phone" name="phone_second" id="phone_second"
                    data-format="+7 (ddd) ddd-dd-dd" value="{{ old('phone_second') }}">
                @error('phone_second')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="email">Email адрес</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="url">Ссылка на оригинальный сайт</label>
                <input type="url" class="form-control" name="url" id="url" value="{{ old('url') }}">
                @error('url')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="description">Описание</label>
                <textarea type="text" class="form-control" name="description" id="description">
                       {{ old('description') }}
                    </textarea>
                @error('description')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <button class="btn btn-outline-success" type="submit">Сохранить</button>
        </form>
        @else
            <h2>Данные фитнес-клуба уже заполнены, дождитесь активации учетной записи</h2>
        @endif
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
