@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Редактировать навыки</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.skills.update', ['skill' => $skill]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="text" name="user_id" id="user_id" value="{{ $skill->user_id }}" hidden>
            <div class="form-group">
                <label for="last_name">Фамилия</label>
                <input type="text" class="form-control" readonly name="last_name" id="last_name"
                    value="{{ $skill->profile->last_name ?? 'none' }}">
            </div>
            <div class="form-group">
                <label for="first_name">Имя</label>
                <input type="text" class="form-control" readonly name="first_name" id="first_name"
                    value="{{ $skill->profile->first_name ?? 'none' }}">
            </div>
            <div class="form-group">
                <label for="father_name">Отчество</label>
                <input type="text" class="form-control" readonly name="father_name" id="father_name"
                    value="{{ $skill->profile->father_name ?? 'none' }}">
            </div>
            <div class="form-group">
                <label for="location">Расположение</label>
                <input type="text" class="form-control" name="location" id="location"
                    value="{{ $skill->location ?? 'none' }}">
            </div>
            <div class="form-group">
                <label for="education">Образоваие</label>
                <input type="text" class="form-control" name="education" id="education"
                    value="{{ $skill->education ?? 'none' }}">
            </div>
            <div class="form-group">
                <label for="experience">Опыт</label>
                <input type="number" class="form-control" name="experience" id="experience"
                    value="{{ $skill->experience ?? 'none' }}">
            </div>
            <div class="form-group">
                <label for="achievements">Достижения</label>
                <textarea class="form-control" name="achievements" id="achievements">{{ $skill->achievements ?? 'none' }}</textarea>
            </div>
            <div class="form-group">
                <label for="skillList">Список навыков</label>
                <textarea class="form-control" name="skills_list" id="skillList">{{ $skill->skills_list ?? 'none' }}</textarea>
            </div>
            <div class="form-group">
                <label for="desciption">Описание</label>
                <textarea class="form-control" name="description" id="description">{{ $skill->description ?? 'none' }}</textarea>
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
@endpush
