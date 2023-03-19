@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Добавить изображение</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.gymImages.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="gym_id">id фитнес-клуба : название</label>
                <select class="form-control" name="gym_id" id="gym_id">
                    @foreach ($gyms as $gym)
                        <option value="{{ $gym->id }}">{{ $gym->id }} : {{ $gym->title }}</option>
                    @endforeach
                </select>
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
