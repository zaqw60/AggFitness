@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Редактировать тег</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.tags.update', ['tag' => $tag]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="tag">Тэг</label>
                <input type="text" class="form-control" name="tag" id="tag" value="{{ $tag->tag }}">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
@endpush
