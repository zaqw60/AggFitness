@extends('layouts.admin')
@section('content')
    <h2>Модерировать анкету</h2>
    <div style="display: flex; justify-content: right;">
        {{-- <a href="{{ route('admin.profiles.create') }}" class="btn btn-primary">Добавить профиль</a> --}}
    </div>
    <div class="alert-message"></div>
    <div class="">
        <h4>Фильтровать по:</h4>
    </div>
    <form action="{{ route('admin.moderatings.index') }} ">
        <div class="row">
            <div class="col-md-3">
                <label class="form-label" for="moderation-status">Статусу анкеты</label>
                <select class="form-control" name="ms" id="moderation-status">
                    @foreach ($moderatingStatuses as $key => $status)
                        <option {{ (int)request()->ms === $key ? 'selected' : '' }} value="{{ $key }}">
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="role-status">Роли пользователя</label>
                <select class="form-control" name="ur" id="role-status">
                    @foreach ($userRoles as $key => $role)
                        <option {{ (int)request()->ur === $key + 1 ? 'selected' : '' }} value="{{ $key + 1 }}">
                            {{ $role['role'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="user-status">Статусу пользователя</label>
                <select class="form-control" name="us" id="user-status">
                    @foreach ($userStatuses as $key => $status)
                        <option {{ (int)request()->us === $key ? 'selected' : '' }} value="{{ $key }}">
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mt-4">Фильтровать</button>
            </div>
        </div>
    </form>
    <br>
    <div class="table-responsive">
        @include('inc.message')
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Фамилия</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Отчество</th>
                    <th scope="col">Идентификатор пользователя</th>
                    <th scope="col">Роль пользователя</th>
                    <th scope="col">Статус пользователя</th>
                    <th scope="col">Статус</th>
                    <th scope="col">Управление</th>
                </tr>
            </thead>
            <tbody>
                @forelse($moderatings as $key => $moderating)
                    <tr id="row-{{ $moderating->id }}">
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if (isset($moderating->profile->last_name))
                                {{ $moderating->profile->last_name }}
                            @endif
                        </td>
                        <td>
                            @if (isset($moderating->profile->first_name))
                                {{ $moderating->profile->first_name }}
                            @endif
                        </td>
                        <td>
                            @if (isset($moderating->profile->father_name))
                                {{ $moderating->profile->father_name }}
                            @endif
                        </td>
                        <td>{{ $moderating->user_id }}</td>
                        <td>{!! !empty($moderating->user->role_id) ? $userRoles[$moderating->user->role_id - 1]['role'] : '' !!}</td>
                        <td>{!! !empty($moderating->user->status) ? $moderating->user->status : '' !!}</td>
                        <td>{{ $moderating->status }}</td>
                        <td>
                            <div style="">
                                <a
                                    href="{{ route('admin.moderatings.edit', ['moderating' => $moderating]) }}">Модерировать</a>&nbsp;
                                {{-- <a href="javascript:;" class="delete" rel="{{ $profile->id }}" --}}
                                {{-- style="color: red;">Уд.</a> --}}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">Записей не найдено</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $moderatings->appends(request()->input())->links() }}
    </div>
@endsection

@push('js')
@endpush
