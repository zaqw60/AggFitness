@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Редактировать адреса</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.gymAddresses.update', ['gymAddress' => $gymAddress]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="gym_id">id фитнес-клуба</label>
                <input type="text" class="form-control" name="gym_id" id="gym_id" value="{{ $gymAddress->gym_id }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="title">Название фитнес-клуба</label>
                <input type="text" class="form-control" name="title" id="title"
                    value="{{ $gymAddress->gym->title }}" readonly>
            </div>
            <div class="form-group">
                <label for="index">Индекс</label>
                <input type="text" class="form-control" name="index" id="index" value="{{ $gymAddress->index }}">
            </div>
            <div class="form-group">
                <label for="country">Страна</label>
                <input type="text" class="form-control" name="country" id="country" value="{{ $gymAddress->country }}">
            </div>
            <div class="form-group">
                <label for="city">Город</label>
                <input type="text" class="form-control" name="city" id="city" value="{{ $gymAddress->city }}">
            </div>
            <div class="form-group">
                <label for="street">Улица</label>
                <input type="text" class="form-control" name="street" id="street" value="{{ $gymAddress->street }}">
            </div>
            <div class="form-group">
                <label for="house_number">Дом</label>
                <input type="text" class="form-control" name="house_number" id="house_number"
                    value="{{ $gymAddress->house_number }}">
            </div>
            <div class="form-group">
                <label for="building">Строение</label>
                <input type="text" class="form-control" name="building" id="building"
                    value="{{ $gymAddress->building }}">
            </div>
            <div class="form-group">
                <label for="floor">Этаж</label>
                <input type="text" class="form-control" name="floor" id="floor" value="{{ $gymAddress->floor }}">
            </div>
            <div class="form-group">
                <label for="apartment">Квартира</label>
                <input type="text" class="form-control" name="apartment" id="apartment"
                    value="{{ $gymAddress->apartment }}">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
@endpush
