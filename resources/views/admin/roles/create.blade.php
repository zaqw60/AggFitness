@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Добавить роль</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.roles.store') }}">
            @csrf
            <div class="form-group">
                <label for="role">Роль</label>
                <input type="text" class="form-control" name="role" id="role" value="{{ old('role') }}">
            </div>
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <input type="text" class="form-control" name="description" id="description" value="{{ old('description') }}">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
@endpush
