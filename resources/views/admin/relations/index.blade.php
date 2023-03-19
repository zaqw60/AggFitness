@extends('layouts.admin')
@section('content')
    <h2>Управление тегами у тренеров</h2>
    <div style="display: flex; justify-content: right;">
        {{--<a href="#" class="btn btn-primary">Добавить тег</a>--}}
    </div><br>
    <div class="alert-message"></div><br>
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Тренер</th>
                <th scope="col">Теги</th>
                <th scope="col">Дата добавления</th>
                <th scope="col">Управление</th>
            </tr>
            </thead>
            <tbody>
            @forelse($trainers as $trainer)
                <tr id="row-{{ $trainer->id }}">
                    <td>{{ $trainer->id }}</td>
                    <td>{{ $trainer->name }}</td>
                    <td>
                    @if($trainer->tags)
                        @foreach($trainer->tags as $item)
                            {{ $item->tag }}
                            <br>
                        @endforeach
                    @endif
                    </td>
                    <td>{{ $trainer->created_at }}</td>
                    <td>
                        <div style="">
                            <a href="{{ route('admin.relations.edit', ['trainer' => $trainer]) }}">Ред.</a>&nbsp;
                            {{--<a href="javascript:;" class="delete" rel="{{ $trainer->id }}"--}}
                               {{--style="color: red;">Уд.</a>--}}
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Записей не найдено</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        {{ $trainers->links() }}
    </div>
@endsection

@push('js')
@endpush
