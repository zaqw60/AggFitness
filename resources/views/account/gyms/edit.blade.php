@extends('layouts.main')
@section('content')
    <x-account.gym.menu></x-account.gym.menu>
    <div class="offset-2 col-8">
        <hr class="featurette-divider">
        <h2>Редактирование данных фитнес-клуба</h2>
        @if ($gym === null)
            {
            <h2>Данные фитнес-клуба пусты</h2>
            }
        @endif
        <form method="post" action="{{ route('account.gyms.update', ['gym' => $gym]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" hidden>
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $gym->title }}">
                @error('title')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="phone_main">Телефон</label>
                <input type="tel" name="phone_main" class="mask-phone form-control" data-format="+7 (ddd) ddd-dd-dd"
                    value="{{ $gym->phone_main }}">
                @error('phone_main')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="phone_second">Телефон</label>
                <input type="tel" name="phone_second" class="mask-phone form-control" data-format="+7 (ddd) ddd-dd-dd"
                    value="{{ $gym->phone_second }}">
                @error('phone_second')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="email">Email адрес</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ $gym->email }}">
                @error('name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="url">Ссылка на оригинальный сайт</label>
                <input type="url" class="form-control" name="url" id="url" value="{{ $gym->url }}">
                @error('url')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="description">Описание</label>
                <input type="text" class="form-control" name="description" id="description"
                    value="{{ $gym->description }}">
                @error('description')
                    <span style="color: red">{{ $message }}</span>
                @enderror
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
