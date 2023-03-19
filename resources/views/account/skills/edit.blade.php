@extends('layouts.main')
@section('content')
    <x-account.trainer.menu></x-account.trainer.menu>
    <div class="offset-2 col-8">
        <hr class="featurette-divider">
        <h2>Редактирование навыков</h2>
        <h6 class="text-primary fw-normal mb-4">* Навыки и достижения заполняются сплошным текстом, после каждого навыка или
            достижения
            обязательно ставим точку и пробел.
            На сайте
            текст с навыками и текст с достижениями будет разбит на список в виде отдельных пунктов.</h6>

        @if ($skill === null)
            {

            <h2>Профиль пустой</h2>
            }
        @endif
        <form method="post" action="{{ route('account.skills.update', ['skill' => $skill]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" hidden>
            <div class="form-group">
                <label for="location">Город (где проводятся тренировки)</label>
                <input type="text" class="form-control" name="location" id="location" value="{{ $skill->location }}">
                @error('location')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="education">Образование (Название спортивного ВУЗа)</label>
                <textarea type="text" class="form-control" name="education" id="education">{!! $skill->education !!}</textarea>
                @error('education')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="experience">Опыт (полных лет)</label>
                <input type="number" class="form-control" name="experience" id="experience"
                    value="{!! $skill->experience !!}">
                @error('experience')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="achievements">Достижения (звания, награды, премии...)</label>
                <textarea type="text" class="form-control" name="achievements" id="achievements">{!! $skill->achievements !!}</textarea>
                @error('achievements')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="skills_list">Список навыков (практикуемые вами методики тренировок, спортивные
                    направления...)</label>
                <textarea type="text" class="form-control" name="skills_list" id="skills_list">{!! $skill->skills_list !!}</textarea>
                @error('skills_list')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <div class="form-group">
                <label for="description">О себе (краткое описание, текст в виде тезисов)</label>
                <textarea type="text" class="form-control" name="description" id="description">{!! $skill->description !!}</textarea>
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
