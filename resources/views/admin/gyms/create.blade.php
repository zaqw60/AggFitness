@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Создать фитнес-клуб</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.gyms.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="user_id">id пользователя : Владелец : Роль</label>
                <select class="form-control" name="user_id" id="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->id }} : {{ $user->name }} :
                            {{ $roles[$user->role_id - 1]->role }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="title">Организация</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="phone_mask">Телефон</label>
                <input type="text" class="form-control" name="phone_main" id="phone_mask"
                    placeholder="+7 (900) 123-45-67" value="{{ old('phone_main') }}">
            </div>
            <div class="form-group">
                <label for="phone_mask1">Дополнительный телефон</label>
                <input type="text" class="form-control" name="phone_second" id="phone_mask1"
                    placeholder="+7 (900) 123-45-67" value="{{ old('phone_second') }}">
            </div>
            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="url">Ссылка на оригинальный сайт</label>
                <input type="text" class="form-control" name="url" id="url" value="{{ old('url') }}">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <input type="text" class="form-control" name="description" id="description"
                    value="{{ old('description') }}">
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
