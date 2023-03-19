@extends('layouts.main')
@section('title')
    Личный кабинет@parent
@endsection
@section('content')
    <x-account.client.menu></x-account.client.menu>
    <br>
    <div class="container marketing">
        @if (Auth::user()->status === 'BLOCKED')
            <h3 class="text-center text-danger mb-4">Личный кабинет заблокирован по решению администрации сайта</h3>
        @elseif(Auth::user()->status === 'DRAFT')
            <div class="d-flex flex-column align-items-center p-3 shadow rounded-1 mb-4">
                @if ($user->moderating and $user->moderating->status === 'IS_PENDING')
                    <h6 class="text-center text-secondary">Новые данные отправлены на модерацию и ожидают проверки...</h6>
                @else
                    <h6 class="text-center text-secondary"><span class="text-danger">Ваш профиль еще не активирован!</span>
                        Заполните поля с данными профиля,
                        анкеты в разделе "Инструменты", при регистрации вам было
                        отправлено письмо на ваш email. Пройдите по ссылке
                        в письме, чтобы подтвердить ваш email...
                        Как всё будет готово, появится кнопка "Активировать", нажмите ее, наш
                        администратор проверит вашу анкету и выполнит активацию.</h6>
                @endif
                @if ($user->profile && $user->characteristic && Auth::user()->email_verified_at)
                    <a class="btn btn-outline-success btn-sm @if ($user->moderating and $user->moderating->status === 'IS_PENDING') disabled @endif"
                        href="{{ route('account.moderating', ['user_id' => $user->id]) }}">
                        @if ($user->moderating and $user->moderating->status === 'IS_PENDING')
                            Отправлено на модерацию&nbsp;&nbsp;&#9203;
                        @else
                            Активировать&nbsp;&nbsp;&#10004;
                        @endif
                    </a>
                @endif
                @if (!Auth::user()->email_verified_at)
                    <p class="text-success">Отправить письмо повторно?</p>
                    <form action="{{ route('verification.send') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-success btn-sm">
                            Отправить&nbsp;&nbsp;&#9993;
                        </button>
                    </form>
                @endif
            </div>
        @endif
        <hr class="featurette-divider">
        @if ($user)
            <div class="d-flex flex-wrap shadow mb-4 rounded-1 p-4">
                <img class="m-2 rounded-2 border border-secondary border-2 border-opacity-10 avatar"
                    src="@if (isset($user->profile->image)) {{ Storage::disk('public')->url($user->profile->image) }} @else /assets/images/user.jpg @endif"
                    alt="img">
                <!--Блок с личными данными-->
                <div class="d-flex flex-column flex-grow-1 p-4">
                    <div class="d-flex flex-wrap">
                        <h5 class="fw-bold">
                            @if ($user->profile && isset($user->moderating->status) && $user->moderating->status === 'IS_APPROVED')
                                {{ $user->profile->first_name }}
                                {{ $user->profile->father_name }}
                                {{ $user->profile->last_name }}
                            @else
                                {{ $user->name }}
                            @endif
                        </h5>
                        <div class="d-flex">
                            <img class="mt-1 ms-3 me-3 indicator @if (Auth::user()->status === 'ACTIVE') indicator_green @else indicator_red @endif"
                                src="@if (Auth::user()->status === 'ACTIVE') /assets/images/yes.jpg @else /assets/images/no.jpg @endif"
                                alt="img">
                            <img class="mt-1 ms-0 me-3 indicator @if (Auth::user()->email_verified_at) indicator_green @else indicator_red @endif"
                                src="@if (Auth::user()->email_verified_at) /assets/images/yes.jpg @else /assets/images/no.jpg @endif"
                                alt="img">
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>

                            </tr>
                        </thead>
                        <tbody>
                            @if ($user->profile && isset($user->moderating->status) && $user->moderating->status === 'IS_APPROVED')
                                <tr>
                                    <th scope="row">Возраст:</th>
                                    <td>{{ $user->profile->age }}
                                        {{ $trainerBuilder->getUnitCase($user->profile->age) }}
                                    </td>
                                </tr>
                            @endif
                            @if ($user->characteristic && isset($user->moderating->status) && $user->moderating->status === 'IS_APPROVED')
                                <tr>
                                    <th scope="row">Город:</th>
                                    <td>{{ $user->characteristic->location }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Рост:</th>
                                    <td>{{ $user->characteristic->height }} см</td>
                                </tr>
                                <tr>
                                    <th scope="row">Вес:</th>
                                    <td>{{ $user->characteristic->weight }} кг</td>
                                </tr>
                                <tr>
                                    <th scope="row">Группа здоровья:</th>
                                    <td>{{ $user->characteristic->health }}</td>
                                </tr>
                            @endif
                            <tr>
                                <th scope="row">Телефон:</th>
                                <td class="text-nowrap">{{ $user->phone }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Email:</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($user->characteristic && isset($user->moderating->status) && $user->moderating->status === 'IS_APPROVED')
                <div class="p-4 mb-4 shadow rounded-1">
                    <table class="table">
                        <thead>
                            <tr>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="about_self">О себе:</th>
                                <td>{{ $user->characteristic->description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="p-3 mb-4 shadow rounded-1">
                <h6>Группы здоровья</h6>
                <p>А – Возможны занятия физической культурой без ограничений и участие в соревнованиях.</p>
                <p>B – Возможны занятия физической культурой с незначительными ограничениями физических нагрузок
                    без
                    участия в соревнованиях.</p>
                <p>C - Возможны занятия физической культурой со значительными ограничениями физических нагрузок.
                </p>
                <p>D – Возможны занятия только лечебной физкультурой.</p>
            </div>
        @else
            <hr class="featurette-divider">
            <h1>Искомый клиент у нас не зарегистрирован...</h1>
            <hr class="featurette-divider">
        @endif
        <hr class="featurette-divider">
    </div>
    <hr class="featurette-divider">
@endsection
