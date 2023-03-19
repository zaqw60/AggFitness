@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Редактировать профиль</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.profiles.update', ['profile' => $profile]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="text" name="user_id" id="user_id" value="{{ $profile->user_id }}" hidden>
            <div class="form-group">
                <label for="lastName">Фамилия</label>
                <input type="text" class="form-control" name="last_name" id="lastName"
                    value="{{ $profile->last_name }}">
            </div>
            <div class="form-group">
                <label for="firstName">Имя</label>
                <input type="text" class="form-control" name="first_name" id="firstName"
                    value="{{ $profile->first_name }}">
            </div>
            <div class="form-group">
                <label for="fatherName">Отчество</label>
                <input type="text" class="form-control" name="father_name" id="fatherName"
                    value="{{ $profile->father_name }}">
            </div>
            <div class="form-group">
                <label for="age">Возраст</label>
                <input type="text" class="form-control" name="age" id="age" value="{{ $profile->age }}">
            </div>
            <div class="form-group">
                <label for="gender">Пол</label>
                <select class="form-control" name="gender" id="gender">
                    <option @if ($profile->gender === 'male') selected @endif value="male">Муж</option>
                    <option @if ($profile->gender === 'female') selected @endif value="female">Жен</option>
                </select>
            </div>
            {{--<div class="form-group">--}}
                {{--<label for="image">Аватар</label>--}}
                {{--<input type="text" class="form-control" name="image" id="image" value="{{ $profile->image }}">--}}
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
