@extends('layouts.main')
@section('content')
    <x-account.client.menu></x-account.client.menu>
    <div class="offset-2 col-8">
        <hr class="featurette-divider">
        <h2>Заполнение данных анкеты</h2>
        <p class="text-primary">* Выбор группы здоровья имеет информативный характер и предназначен для предварительного
            подбора тренировок фитнес-тренером, окончательное
            заключение по допустимым типам тренировок, показания и противопоказания может дать только спортивный врач.</p>

        <form method="post" action="{{ route('account.characteristics.store') }}">
            @csrf
            <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" hidden>
            <div class="form-group">
                <label for="location">Город</label>
                <input type="text" class="form-control" name="location" id="location" value="{{ old('location') }}">
                @error('location')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="height">Рост (см)</label>
                <input type="number" class="form-control" name="height" id="height" value="{{ old('height') }}">
                @error('height')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="weight">Вес (кг)</label>
                <input type="number" class="form-control" name="weight" id="weight" value="{{ old('weight') }}">
                @error('weight')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="health" @error('health') style="color:red" @enderror>Группа здоровья</label>
                <select class="form-control" name="health" id="health">
                    <option value="0">Выбрать</option>
                    <option value="A" @if (old('health') === 'A') selected @endif>А – Возможны занятия физической
                        культурой без ограничений и участие в соревнованиях.</option>
                    <option value="B" @if (old('health') === 'B') selected @endif>B – Возможны занятия физической
                        культурой с незначительными ограничениями физических нагрузок без
                        участия в соревнованиях.</option>
                    <option value="C" @if (old('health') === 'C') selected @endif>C - Возможны занятия физической
                        культурой со значительными ограничениями физических нагрузок.</option>
                    <option value="D" @if (old('health') === 'D') selected @endif>D – Возможны занятия только
                        лечебной физкультурой.</option>
                </select>
                @error('health')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="description">О себе (краткое описание своего спортивного опыта, желаемые цели)</label>
                <textarea type="text" class="form-control" name="description" id="description" rows=6>{{ old('description') }}</textarea>
                @error('description')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <button class="btn btn-outline-success mb-4" type="submit">Сохранить</button>
        </form>
    </div>
    <hr class="featurette-divider">
@endsection
