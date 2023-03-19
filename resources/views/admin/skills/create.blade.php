@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Добавить навыки</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.skills.store') }}">
            @csrf
            @if (isset($users))
                <div class="form-group">
                    <label for="userId">Пользователь : роль</label>
                    <select class="form-control" name="user_id" id="userId">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} : {{ $roles[$user->role_id - 1]->role }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div class="form-group">
                <label for="location">Расположение</label>
                <input type="text" class="form-control" name="location" id="location" value="{{ old('location') }}">
            </div>
            <div class="form-group">
                <label for="education">Образоваие</label>
                <input type="text" class="form-control" name="education" id="education" value="{{ old('education') }}">
            </div>
            <div class="form-group">
                <label for="experience">Опыт</label>
                <input type="number" class="form-control" name="experience" id="experience"
                    value="{{ old('experience') }}">
            </div>
            <div class="form-group">
                <label for="achievements">Достижения</label>
                <textarea class="form-control" name="achievements" id="achievements">{{ old('achievements') }}</textarea>
            </div>
            <div class="form-group">
                <label for="skillList">Список навыков</label>
                <textarea class="form-control" name="skills_list" id="skillList">{{ old('skills_list') }}</textarea>
            </div>
            <div class="form-group">
                <label for="desciption">Описание</label>
                <textarea class="form-control" name="description" id="description">{{ old('description') }}</textarea>
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
@endpush
