@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Редактировать роль</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.roles.update', ['role' => $role]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="role">Роль</label>
                <input type="text" class="form-control" name="role" id="role" value="{{ $role->role }}" readonly>
            </div>
            <div class="form-group">
                <label for="title">Название</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ $role->title }}">
            </div>
            <div class="form-group">
                <label for="description">Описание</label>
                <input type="text" class="form-control" name="description" id="description" value="{{ $role->description }}">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
@endpush