@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Редактировать теги у тренеров</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.relations.update', ['trainer' => $trainer, 'tags' => $tags]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="name">Ник тренера</label>
                <input class="form-control" type="text" readonly name="name" id="name" value="{{ $trainer->name }}">
                <br>
            </div>

            @php
            $inputs = [];

            if (isset($tags)) {
                foreach ($tags->toArray() as $item) {
                    $inputs[] = [
                        'id' => $item['id'],
                        'tag' => $item['tag'],
                        'checked' => false
                    ];
                }

                if (isset($trainer->tags)) {
                    foreach($trainer->tags as $item) {
                        $inputs[$item->id - 1]['checked'] = true;
                    }
                }
            }
            @endphp

            @forelse($inputs as $tag)
                <div class="form-group">
                    <span>{{ $tag['id'] }}</span>&nbsp;
                    <input class="form-check-input" type="checkbox" name="tags[]" id="tag-{{ $tag['id'] }}"
                    @if($tag['checked'] === true)
                        checked
                    @endif
                    value="{{ $tag['id'] }}">
                    <label class="form-check-label" for="tag-{{ $tag['id'] }}">{{ $tag['tag'] }}</label>
                </div>
            @empty
                <div class="form-group">
                    <span>Записей не найдено</span>
                </div>
            @endforelse
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
@endpush