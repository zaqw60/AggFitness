@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Добавить клиента</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.characteristics.store') }}">
            @csrf
            <div class="form-group">
                <label for="user_id">Идентификатор клиента</label>
                <input type="text" class="form-control" name="user_id" id="user_id" value="{{ old('user_id') }}">
            </div>
            <div class="form-group">
                <label for="location">Город</label>
                <input type="text" class="form-control" name="location" id="location" value="{{ old('location') }}">
            </div>
            <div class="form-group">
                <label for="height">Рост</label>
                <input type="text" class="form-control" name="height" id="height" value="{{ old('height') }}">
            </div>
            <div class="form-group">
                <label for="weight">Вес</label>
                <input type="text" class="form-control" name="weight" id="weight" value="{{ old('weight') }}">
            </div>
            <div class="form-group">
                <label for="health">Группа здоровья</label>
                <select class="form-control" name="health" id="health">
                    <option selected value="{{ \App\Models\Characteristic::HEALTH_A }}">A</option>
                    <option value="{{ \App\Models\Characteristic::HEALTH_B }}">B</option>
                    <option value="{{ \App\Models\Characteristic::HEALTH_C }}">C</option>
                    <option value="{{ \App\Models\Characteristic::HEALTH_D }}">D</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <input type="text" class="form-control" name="description" id="description" value="{{ old('description') }}">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')

@endpush
