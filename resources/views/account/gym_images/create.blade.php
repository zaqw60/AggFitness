@extends('layouts.main')
@section('content')
    <x-account.gym.menu></x-account.gym.menu>
    <div class="offset-2 col-8">
        <hr class="featurette-divider">
        <h2>Добавление фото</h2>
        <form method="post" action="{{ route('account.gym_images.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="text" name="gym_id" id="gym_id" value="{{ Auth::user()->gym->id }}" hidden>
            <div class="form-group">
                <label for="image">Изображение</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <br>
            <button class="btn btn-outline-success" type="submit">Сохранить</button>
        </form>
        <div class="p-4 my-4 shadow rounded">
            <h6>Изображение должно иметь соотношение сторон 1:1,6, иметь размеры не более 832х522 и не менее 416х261
                пикселей, не более 240 КБ по объему памяти.</h6>
        </div>
    </div>
    <hr class="featurette-divider">
@endsection
