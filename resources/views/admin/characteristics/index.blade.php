@extends('layouts.admin')
@section('content')
    <h2>Профили пользователей</h2>
    <div style="display: flex; justify-content: right;">
        {{-- <a href="{{ route('admin.characteristics.create') }}" class="btn btn-primary">Добавить профиль клиента</a> --}}
    </div><br>
    <div class="alert-message"></div><br>
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">user_id</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Отчество</th>
                    <th scope="col">Город</th>
                    <th scope="col">Рост</th>
                    <th scope="col">Вес</th>
                    <th scope="col">Группа здоровья</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Дата добавления</th>
                    <th scope="col">Дата обновления</th>
                    <th scope="col">Управление</th>
                </tr>
            </thead>
            <tbody>
                @forelse($characteristics as $characteristic)
                    <tr id="row-{{ $characteristic->id }}">
                        <td>{{ $characteristic->id }}</td>
                        <td>{{ $characteristic->user_id }}</td>
                        <td>{{ $characteristic->profile->last_name }}</td>
                        <td>{{ $characteristic->profile->first_name }}</td>
                        <td>{{ $characteristic->profile->father_name }}</td>
                        <td>{{ $characteristic->location }}</td>
                        <td>{{ $characteristic->height }}</td>
                        <td>{{ $characteristic->weight }}</td>
                        <td>{{ $characteristic->health }}</td>
                        <td>{{ $characteristic->description }}</td>
                        <td>{{ $characteristic->created_at }}</td>
                        <td>{{ $characteristic->updated_at }}</td>
                        <td>
                            <div style="">
                                <a
                                    href="{{ route('admin.characteristics.edit', ['characteristic' => $characteristic]) }}">Ред.</a>&nbsp;
                                {{-- <a href="javascript:;" class="delete" rel="{{ $characteristic->id }}" --}}
                                {{-- style="color: red;">Уд.</a> --}}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="13">Записей не найдено</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $characteristics->links() }}
    </div>
@endsection

@push('js')
@endpush
