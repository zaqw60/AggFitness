@extends('layouts.admin')
@section('content')
    <div class="offset-2 col-8">
        <br>
        <h2>Редактировать подписчика</h2>
        @include('inc.message')
        <form method="post" action="{{ route('admin.subscriptions.update', ['subscription' => $subscription]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="phone_mask">Телефон</label>
                <input type="text" class="form-control" name="phone" id="phone_mask" value="{{ $subscription->phone }}" readonly>
            </div>
            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="text" class="form-control" name="email" id="email" value="{{ $subscription->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="status">Статус</label>
                <select class="form-control" name="status" id="status">
                    <option @if ($subscription->status === \App\Models\Subscription::IS_SUBSCRIBED) selected
                            @endif value="{{ \App\Models\Subscription::IS_SUBSCRIBED }}">
                        Подписать
                    </option>
                    <option @if ($subscription->status === \App\Models\Subscription::IS_UNSUBSCRIBED) selected
                            @endif value="{{ \App\Models\Subscription::IS_UNSUBSCRIBED }}">
                        Отписать
                    </option>
                </select>
            </div>
            <br>
            <button class="btn btn-success" type="submit">Сохранить</button>
        </form>
    </div>
@endsection
@push('js')
    <!-- Скрипты для маски телефона в поле input, указываем для поля input id="phone_mask" -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
            crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/mask/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ asset('assets/js/mask/main_mask.js') }}"></script>
@endpush
