@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Добавить теги</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.tags.store') }}">
            @csrf
            <div class="form-group">
                <label for="tag">Тег</label>
                <input type="text" class="form-control" name="tag" id="tag" value="{{ old('tag') }}">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
@endpush