@extends('layouts.main')
@section('content')
        <x-account.gym.menu></x-account.gym.menu>
        <div class="offset-2 col-8">
            <hr class="featurette-divider">
            <h2>Изменение адреса</h2>
            @if ($gym_address === null)
                {
                <h2>Адрес не существует</h2>
                }
            @endif
            <form method="post" action="{{ route('account.gym_addresses.update', ['gym_address' => $gym_address]) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                <input type="text" name="gym_id" id="gym_id" value="{{ $gym_address->gym_id }}" hidden>
                <div class="form-group">
                    <label for="index">Индекс</label>
                    <input type="number" class="form-control" name="index" id="index"
                           value="{{ $gym_address->index }}">
                    @error('index')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="country">Страна</label>
                    <input type="text" class="form-control" name="country" id="country" value="{{ $gym_address->country }}">
                    @error('country')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="city">Город</label>
                    <input type="text" class="form-control" name="city" id="city" value="{{ $gym_address->city }}">
                    @error('city')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="street">Улица</label>
                    <input type="text" class="form-control" name="street" id="street" value="{{ $gym_address->street }}">
                    @error('street')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="house_number">Номер дома</label>
                    <input type="number" class="form-control" name="house_number" id="house_number" value="{{ $gym_address->house_number }}">
                    @error('house_number')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="building">Строение</label>
                    <input type="number" class="form-control" name="building" id="building" value="{{ $gym_address->building }}">
                    @error('building')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="floor">Этаж</label>
                    <input type="number" class="form-control" name="floor" id="floor" value="{{ $gym_address->floor }}">
                    @error('floor')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="apartment">Офис</label>
                    <input type="number" class="form-control" name="apartment" id="apartment" value="{{ $gym_address->apartment }}">
                    @error('apartment')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <br>
                <button class="btn btn-outline-success" type="submit">Сохранить</button>
            </form>
        </div>
        <hr class="featurette-divider">e-divider">
@endsection

