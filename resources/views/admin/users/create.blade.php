@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Добавить пользователя</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.users.store') }}">
            @csrf
            {{-- <div class="form-group"> --}}
            {{-- <label for="last_name">Фамилия</label> --}}
            {{-- <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name') }}"> --}}
            {{-- </div> --}}
            {{-- <div class="form-group"> --}}
            {{-- <label for="first_name">Имя</label> --}}
            {{-- <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name') }}"> --}}
            {{-- </div> --}}
            {{-- <div class="form-group"> --}}
            {{-- <label for="father_name">Отчество</label> --}}
            {{-- <input type="text" class="form-control" name="father_name" id="father_name" value="{{ old('father_name') }}"> --}}
            {{-- </div> --}}
            <div class="form-group">
                <label for="name">Никнейм</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label for="phone_mask">Телефон</label>
                <input id="phone_mask" class="form-control" type="text" name="phone" placeholder="+7 (900) 123-45-67"
                    value="{{ old('phone') }}">
            </div>
            <div class="form-group">
                <label for="role_id">Роль</label>
                <select class="form-control" name="role_id" id="role_id">
                    @foreach ($roles as $key => $role)
                        <option selected value="{{ $role->id }}">{{ $role->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" name="password" id="password" value="">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Пароль еще раз</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" value="">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
    <!-- Скрипты для маски телефона в поле input, указываем для поля input id="phone_mask" -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/mask/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/mask/main_mask.js') }}"></script>
@endpush
