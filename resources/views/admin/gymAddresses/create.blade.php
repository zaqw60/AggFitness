@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Добавить адрес</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.gymAddresses.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="gym_id">id фитнес-клуба : название</label>
                <select class="form-control" name="gym_id" id="gym_id">
                    @foreach ($gyms as $gym)
                        <option value="{{ $gym->id }}">{{ $gym->id }} : {{ $gym->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="index">Индекс</label>
                <input type="text" class="form-control" name="index" id="index" value="{{ old('index') }}">
            </div>
            <div class="form-group">
                <label for="country">Страна</label>
                <input type="text" class="form-control" name="country" id="country" value="{{ old('country') }}">
            </div>
            <div class="form-group">
                <label for="city">Город</label>
                <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}">
            </div>
            <div class="form-group">
                <label for="street">Улица</label>
                <input type="text" class="form-control" name="street" id="street" value="{{ old('street') }}">
            </div>
            <div class="form-group">
                <label for="house_number">Дом</label>
                <input type="text" class="form-control" name="house_number" id="house_number"
                    value="{{ old('house_number') }}">
            </div>
            <div class="form-group">
                <label for="building">Строение</label>
                <input type="text" class="form-control" name="building" id="building" value="{{ old('building') }}">
            </div>
            <div class="form-group">
                <label for="floor">Этаж</label>
                <input type="text" class="form-control" name="floor" id="floor" value="{{ old('floor') }}">
            </div>
            <div class="form-group">
                <label for="apartment">Квартира</label>
                <input type="text" class="form-control" name="apartment" id="apartment" value="{{ old('apartment') }}">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
@endpush
