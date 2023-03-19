@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Редактировать клиента</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.characteristics.update', ['characteristic' => $characteristic]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="user_id">Идентификатор клиента</label>
                <input readonly type="text" class="form-control" name="user_id" id="user_id"
                    value="{{ $characteristic->user_id }}">
            </div>
            <div class="form-group">
                <label for="last_name">Фамилия</label>
                <input readonly type="text" class="form-control" name="last_name" id="last_name"
                    value="{{ $characteristic->profile->last_name }}">
            </div>
            <div class="form-group">
                <label for="first_name">Имя</label>
                <input readonly type="text" class="form-control" name="first_name" id="first_name"
                    value="{{ $characteristic->profile->first_name }}">
            </div>
            <div class="form-group">
                <label for="father_name">Отчество</label>
                <input readonly type="text" class="form-control" name="father_name" id="father_name"
                    value="{{ $characteristic->profile->father_name }}">
            </div>
            <div class="form-group">
                <label for="location">Город</label>
                <input type="text" class="form-control" name="location" id="location"
                    value="{{ $characteristic->location }}">
            </div>
            <div class="form-group">
                <label for="height">Рост</label>
                <input type="text" class="form-control" name="height" id="height"
                    value="{{ $characteristic->height }}">
            </div>
            <div class="form-group">
                <label for="weight">Вес</label>
                <input type="text" class="form-control" name="weight" id="weight"
                    value="{{ $characteristic->weight }}">
            </div>
            <div class="form-group">
                <label for="health">Группа здоровья</label>
                <select class="form-control" name="health" id="health">
                    <option @if ($characteristic->health === \App\Models\Characteristic::HEALTH_A) selected @endif
                        value="{{ \App\Models\Characteristic::HEALTH_A }}">{{ \App\Models\Characteristic::HEALTH_A }}
                    </option>
                    <option @if ($characteristic->health === \App\Models\Characteristic::HEALTH_B) selected @endif
                        value="{{ \App\Models\Characteristic::HEALTH_B }}">{{ \App\Models\Characteristic::HEALTH_B }}
                    </option>
                    <option @if ($characteristic->health === \App\Models\Characteristic::HEALTH_C) selected @endif
                        value="{{ \App\Models\Characteristic::HEALTH_C }}">{{ \App\Models\Characteristic::HEALTH_C }}
                    </option>
                    <option @if ($characteristic->health === \App\Models\Characteristic::HEALTH_D) selected @endif
                        value="{{ \App\Models\Characteristic::HEALTH_D }}">{{ \App\Models\Characteristic::HEALTH_D }}
                    </option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <input type="text" class="form-control" name="description" id="description"
                    value="{{ $characteristic->description }}">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
@endpush
