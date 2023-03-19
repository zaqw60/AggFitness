@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Редактировать пользователя</h2>

        @include('inc.message')

        <form method="post" action="{{ route('admin.users.update', ['user' => $user]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            {{-- <div class="form-group"> --}}
            {{-- @if (isset($user->profile->last_name)) --}}
            {{-- <label for="last_name">Фамилия</label> --}}
            {{-- <input type="text" class="form-control" readonly name="last_name" id="last_name" --}}
            {{-- value="{{ $user->profile->last_name }}"> --}}
            {{-- @endif --}}
            {{-- </div> --}}
            {{-- <div class="form-group"> --}}
            {{-- @if (isset($user->profile->first_name)) --}}
            {{-- <label for="first_name">Имя</label> --}}
            {{-- <input type="text" class="form-control" readonly name="first_name" id="first_name" --}}
            {{-- value="{{ $user->profile->first_name }}"> --}}
            {{-- @endif --}}
            {{-- </div> --}}
            {{-- <div class="form-group"> --}}
            {{-- @if (isset($user->profile->father_name)) --}}
            {{-- <label for="father_name">Отчество</label> --}}
            {{-- <input type="text" class="form-control" readonly name="father_name" id="father_name" --}}
            {{-- value="{{ $user->profile->father_name }}"> --}}
            {{-- @endif --}}
            {{-- </div> --}}
            <div class="form-group">
                <label for="name">Никнейм</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                <label for="phone_mask">Телефон</label>
                <input type="text" class="form-control" name="phone" id="phone_mask" value="{{ $user->phone }}">
            </div>
            <div class="form-group">
                <label for="role_id">Роль</label>
                <select class="form-control" name="role_id" id="role_id">
                    @foreach ($roles as $key => $role)
                        <option @if ($user->role_id === $role->id) selected @endif value="{{ $role->id }}">
                            {{ $role->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">Статус</label>
                <select class="form-control" name="status" id="status">
                    <option @if ($user->status === \App\Models\User::ACTIVE) selected @endif value="{{ \App\Models\User::ACTIVE }}">
                        Active
                    </option>
                    <option @if ($user->status === \App\Models\User::DRAFT) selected @endif value="{{ \App\Models\User::DRAFT }}">
                        Draft
                    </option>
                    <option @if ($user->status === \App\Models\User::BLOCKED) selected @endif value="{{ \App\Models\User::BLOCKED }}">
                        Blocked
                    </option>
                </select>
            </div>
            <div class="form-group" hidden>
                <label for="password">Пароль</label>
                <input type="password" class="form-control" name="password" id="password" value="0987654321">
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/mask/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/mask/main_mask.js') }}"></script>
@endpush
