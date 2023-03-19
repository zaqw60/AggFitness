@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Создать профиль</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.profiles.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($users))
            <div class="form-group">
                <label for="userId">Пользователь : id : роль</label>
                <select class="form-control" name="user_id" id="userId">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} : {{ $user->role_id }} : {{ $roles[$user->role_id - 1]->role }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="form-group">
                <label for="lastName">Фамилия</label>
                <input type="text" class="form-control" name="last_name" id="lastName" value="{{ old('last_name') }}">
            </div>
            <div class="form-group">
                <label for="firstName">Имя</label>
                <input type="text" class="form-control" name="first_name" id="firstName" value="{{ old('first_name') }}">
            </div>
            <div class="form-group">
                <label for="fatherName">Отчество</label>
                <input type="text" class="form-control" name="father_name" id="fatherName" value="{{ old('father_name') }}">
            </div>
            <div class="form-group">
                <label for="age">Возраст</label>
                <input type="text" class="form-control" name="age" id="age" value="{{ old('age') }}">
            </div>
            <div class="form-group">
                <label for="gender">Пол</label>
                <select class="form-control" name="gender" id="gender">
                    <option selected value="male">Муж</option>
                    <option value="female">Жен</option>
                </select>
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="image">Аватар</label>--}}
                {{--<input type="text" class="form-control" name="image" id="image" value="{{ old('image') }}">--}}
            {{--</div>--}}
            <div class="form-group">
                <label for="image">Аватар</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
@endpush
