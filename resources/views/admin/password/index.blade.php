@extends('layouts.admin')
@section('content')
    @include('inc.message')
    @php $message = "Test message"; @endphp
    <h2>Сменить пароль у пользователя: {{ Auth::user()->name }}</h2>
    <br>
    <form method="post" action="{{ route('admin.updatePassword') }}">
        @csrf
        <div class="form-group">
            <label for="old_password">Старый пароль</label>
            <input type="password" class="form-control" name="old_password" id="old_password"
                   value="">
        </div>
        <br>
        <div class="form-group">
            <label for="new_password">Новый пароль</label>
            <input type="password" class="form-control" name="new_password" id="new_password"
                   value="">
        </div>
        <br>
        <div class="form-group">
            <label for="new_password_confirmation">Повторить пароль</label>
            <input type="password" class="form-control" name="confirmPassword" id="new_password_confirmation"
                   value="">
        </div>
        <br>
        <button class="btn btn-success" type="submit">Сохранить</button>
    </form>
@endsection