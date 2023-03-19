@extends('layouts.main')
@section('content')
    <x-account.trainer.menu></x-account.trainer.menu>
    <div class="offset-2 col-8">
        <hr class="featurette-divider">
        <h2>Редактировать набор тегов</h2>

        <form method="post" action="{{ route('account.tags.update', ['tag' => Auth::user()->id]) }}">
            @csrf
            @method('put')
            <div class="form-group">
                @forelse($tags as $tagItem)
                    <div class="form-check">

                        <input class="form-check-input" type="checkbox"
                            @foreach ($tagsCheked as $item)
                               @if ($tagItem->id === $item->id) checked @endif @endforeach
                            name="tags[]" value="{{ $tagItem->id }}" id="tag">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{ $tagItem->tag }}
                        </label>
                    </div>
                @empty
                    <a class="btn btn-secondary mb-2 me-2"
                        href="{{ route('account.tags.create', ['tag' => Auth::user()->id]) }}">
                        Профили отсутствуют
                    </a>
                @endforelse
            </div>
            <br>
            <button class="btn btn-outline-success" type="submit">Редактировать</button>
        </form>
    </div>
    <hr class="featurette-divider">
@endsection
@push('js')
@endpush
