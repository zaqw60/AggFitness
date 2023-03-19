@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Редактировать изображения</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.gymImages.update', ['gymImage' => $gymImage]) }}"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="gym_id">id фитнес-клуба</label>
                <input type="text" class="form-control" name="gym_id" id="gym_id" value="{{ $gymImage->gym_id }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $gymImage->gym->title }}"
                    readonly>
            </div>
            <div class="form-group">
                <label for="image">Изображение</label>
                <input type="file" class="form-control" name="image" id="image">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
@endpush
