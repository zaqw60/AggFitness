@extends('layouts.main')
@section('title')
    Личный кабинет@parent
@endsection
@section('content')
    <x-account.trainer.menu>
    </x-account.trainer.menu>
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
                @if ($user->profile && $user->skill && Auth::user()->email_verified_at)
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
                            <tr>
                                <th scope="row">Рейтинг:</th>
                                @if (count($user->clients))
                                    <td>{{ $trainerBuilder->getScore($user->clients) }} <svg
                                            xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#daa520"
                                            class="bi bi-star mt-1 ms-1" viewBox="0 0 16 16">
                                            <path fill="#daa520"
                                                d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                        </svg></td>
                                @else
                                    <td>Нет оценки</td>
                                @endif
                            </tr>
                            @if ($user->skill && isset($user->moderating->status) && $user->moderating->status === 'IS_APPROVED')
                                <tr>
                                    <th scope="row">Город:</th>
                                    <td>{{ $user->skill->location }}</td>
                                </tr>
                            @endif
                            @if ($user->profile && isset($user->moderating->status) && $user->moderating->status === 'IS_APPROVED')
                                <tr>
                                    <th scope="row">Возраст:</th>
                                    <td>{{ $user->profile->age }} {{ $trainerBuilder->getUnitCase($user->profile->age) }}
                                    </td>
                                </tr>
                            @endif
                            @if ($user->skill && isset($user->moderating->status) && $user->moderating->status === 'IS_APPROVED')
                                <tr>
                                    <th scope="row">Опыт:</th>
                                    <td>{{ $user->skill->experience }}
                                        {{ $trainerBuilder->getUnitCase($user->skill->experience) }}</td>
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
                    <div class="d-flex flex-wrap align-items-start mb-4">
                        @forelse($user->tags as $key => $tagItem)
                            <a class="btn btn-secondary btn-sm mb-2 me-2"
                                href="{{ route('trainers.index', ['tag_id' => $tagItem->id, 'city_id' => 0]) }}">
                                {{ $tagItem->tag }}
                            </a>
                        @empty
                            <a class="btn btn-secondary btn-sm mb-2 me-2"
                                href="{{ route('account.tags.edit', ['tag' => Auth::user()->id]) }}">
                                Профиль тренировок не указан
                            </a>
                        @endforelse
                    </div>
                </div>
            </div>
            @if ($user->skill && isset($user->moderating->status) && $user->moderating->status === 'IS_APPROVED')
                <div class="shadow skill_bottom p-4 rounded">
                    <div class="mb-4">
                        <h6 class="me-4">Образование:</h6>
                        <h6 class="fw-normal">{{ $user->skill->education }}</h6>
                    </div>
                    <div class="mb-4">
                        <h6 class="me-4">О себе:</h6>
                        <h6 class="fw-normal">{{ $user->skill->description }}</h6>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <h6 class="me-4">Достижения:</h6>
                            <h6 class="fw-normal">
                                @foreach (explode('. ', $user->skill->achievements) as $item)
                                    <div>&bull; {{ rtrim($item, '.') }}</div>
                                @endforeach
                            </h6>
                        </div>
                        <div class="col-md-6 mb-4">
                            <h6 class="me-4">Навыки:</h6>
                            <h6 class="fw-normal">
                                @foreach (explode('. ', $user->skill->skills_list) as $item)
                                    <div>&bull; {{ rtrim($item, '.') }}</div>
                                @endforeach
                            </h6>
                        </div>
                    </div>
                </div>
            @else
                <hr class="featurette-divider">
            @endif
        @else
            <hr class="featurette-divider">
            <h1>Искомый тренер у нас не зарегистрирован...</h1>
            <hr class="featurette-divider">
        @endif
    </div>
    <hr class="featurette-divider">
@endsection
