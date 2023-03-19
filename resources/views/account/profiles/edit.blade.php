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
        <h2>Редактирование профиля</h2>
        @if ($profile === null)
            {

            <h2>Профиль пустой</h2>
            }
        @endif
        <form method="post" action="{{ route('account.profiles.update', ['profile' => $profile]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" hidden>
            <img src="@if ($profile->image) {{ Storage::disk('public')->url($profile->image) }} @else /assets/images/user.jpg @endif"
                class="avatar_mini">
            <br>
            <br>
            <div class="form-group">
                <label for="first_name">Имя</label>
                <input type="text" class="form-control" name="first_name" id="first_name"
                    value="{{ $profile->first_name }}">
                @error('first_name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="father_name">Отчество</label>
                <input type="text" class="form-control" name="father_name" id="father_name"
                    value="{{ $profile->father_name }}">
                @error('father_name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="last_name">Фамилия (Если нет отчества, ставим ...)</label>
                <input type="text" class="form-control" name="last_name" id="last_name"
                    value="{{ $profile->last_name }}">
                @error('last_name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="age">Возраст</label>
                <input type="number" class="form-control" name="age" id="age" value="{{ $profile->age }}">
                @error('age')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="gender" @error('gender') style="color:red" @enderror>Пол</label>
                <select class="form-control" name="gender" id="gender">
                    <option value="0">Выбрать</option>
                    <option value="male" @if ($profile->gender === 'male') selected @endif>Мужской</option>
                    <option value="female" @if ($profile->gender === 'female') selected @endif>Женский</option>
                </select>
                @error('gender')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="image">Аватар</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <br>
            <button class="btn btn-outline-success" type="submit">Сохранить</button>
        </form>
        <div class="p-4 my-4 shadow rounded">
            <h6>Изображение должно быть квадратным, иметь размеры не более 600х600 и не менее 400х400 пикселей, не более
                200 КБ по объему памяти, быть в профиль и на уровне плеч.</h6>
        </div>
    </div>
    <hr class="featurette-divider">
@endsection
