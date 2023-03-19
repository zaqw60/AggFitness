@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Редактировать фитнес-клуб</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.gyms.update', ['gym' => $gym]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="user_id">id пользоват</label>
                <input type="text" class="form-control" name="user_id" id="user_id" value="{{ $gym->user_id }}" readonly>
            </div>
            <div class="form-group">
                <label for="userName">Владелец</label>
                <input type="text" class="form-control" name="userName" id="userName" value="{{ $gym->user->name }}">
            </div>
            <div class="form-group">
                <label for="title">Организация</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $gym->title }}">
            </div>
            <div class="form-group">
                <label for="phone_mask">Телефон</label>
                <input type="text" class="form-control" name="phone_main" id="phone_mask"
                    placeholder="+7 (900) 123-45-67" value="{{ $gym->phone_main }}">
            </div>
            <div class="form-group">
                <label for="phone_mask1">Дополнительный телефон</label>
                <input type="text" class="form-control" name="phone_second" id="phone_mask1"
                    placeholder="+7 (900) 123-45-67" value="{{ $gym->phone_second }}">
            </div>
            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ $gym->email }}">
            </div>
            <div class="form-group">
                <label for="url">Ссылка на оригинальный сайт</label>
                <input type="text" class="form-control" name="url" id="url" value="{{ $gym->url }}">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <input type="text" class="form-control" name="description" id="description"
                    value="{{ $gym->description }}">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/mask/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/mask/main_mask.js') }}"></script>
@endpush
