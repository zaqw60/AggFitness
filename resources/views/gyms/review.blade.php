@extends('layouts.main')
@section('title')
    Отзыв на фитнес-клуб: @if (isset($gym->title))
        {{ $gym->title }}
    @endif
    @parent
@endsection
@section('content')
    <div class="d-flex align-items-center body_back border-top border-1 border-success">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a class="text-white-50 link-success"
                        href="{{ route('gyms.index', ['city_id' => $city_id]) }}">Фитнес-клубы</a></li>
                <li class="breadcrumb-item"><a class="text-white-50 link-success"
                        href="{{ route('gyms.show', ['id' => $gym->id, 'city_id' => $city_id]) }}">{{ $gym->title }}
                    </a></li>
                <li class="breadcrumb-item text-white-50" aria-current="page">Отзыв</li>
            </ol>
        </nav>
    </div>
    <div class="container marketing">
        <hr class="featurette-divider">
        @if ($gym && $client)
            <div class="row featurette">
                <div class="col-md-5 mb-2">
                    <img class="w-100" src="{{ Storage::disk('public')->url($gym->images[0]->image) }}" alt="img">
                </div>
                <div class="col-md-7">
                    <h2 class="fw-normal lh-1">{{ $gym->title }} </h2>
                    <div class="d-flex">
                        <h4>Рейтинг: @if (count($gym->clients))
                                {{ $gymBuilder->getScore($gym->clients) }}
                            @else
                                Нет оценки
                            @endif
                        </h4>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#daa520"
                            class="bi bi-star mt-1 ms-2" viewBox="0 0 16 16">
                            <path fill="#daa520"
                                d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                        </svg>
                    </div>
                    <p class="lead">Телефон: {{ $gym->phone_main }}</p>
                    <p class="lead">Телефон: @if ($gym->phone_second)
                            {{ $gym->phone_second }}
                        @else
                            {{ $gym->phone_main }}
                        @endif
                    </p>
                    <p class="lead">Email: {{ $gym->email }}</p>

                    <a class="btn btn-outline-danger mt-3 mb-2 me-2"
                        href="{{ route('gyms.show', ['id' => $gym->id, 'city_id' => $city_id]) }}">&#9668; &#9668;
                        &#9668; Назад
                    </a>
                    @if (!Auth::user() || Auth::user()->role_id === 3)
                        <a class="btn btn-outline-success mt-3 mb-2 me-2"
                            href="{{ route('gymReviews.edit', ['gymReview' => $gym->id]) }}">Отзыв &#9650; &#9650;
                            &#9650;</a>
                    @endif
                    <a class="btn btn-outline-primary mt-3 mb-2 me-2" href="{{ $gym->url }}" target="blank"> На сайт
                        &#9658; &#9658;
                        &#9658;
                    </a>
                </div>
            </div>

            <hr class="featurette-divider">



            <!--Отзыв-->
            @foreach ($client->gyms as $review)
                @if ($review->pivot->id === $review_id)
                    @if ($review->pivot->status === 'ACTIVE')
                        <div class="row featurette mt-4">
                            <div class="bg-light p-3 ps-4 rounded-1 shadow">
                                <h3>Тема отзыва</h3>
                                <h4 class="fw-normal">{{ $review->pivot->title }}</h4>
                                <h3>Описание</h3>
                                <h5 class="fw-normal">{{ $review->pivot->description }}</h5>
                                <p class="fw-bold">{{ $review->pivot->created_at->format('d.m.Y (H:i)') }}</p>
                                <div class="d-flex flex-wrap shadow mb-2 rounded-1 w-50">
                                    <img class="m-2 w-25 rounded-2 border border-secondary border-2 border-opacity-10"
                                        src="{{ Storage::disk('public')->url($client->profile->image) }}" alt="img">
                                    <div class="d-flex flex-grow-1 align-self-center justify-content-center p-2">
                                        <h5 class="fw-semibold">{{ $client->profile->first_name }}
                                            {{ $client->profile->last_name }},
                                            {{ $client->profile->age }}
                                            {{ $gymBuilder->getUnitCase($client->profile->age) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($review->pivot->status === 'DRAFT')
                        <div class="row featurette mt-4">
                            <div class="bg-light p-3 ps-4 rounded-1 shadow border border-primary border-3">
                                <h3 class="text-primary">Отзыв на модерации</h3>
                                <h3>Тема отзыва</h3>
                                <h4 class="fw-normal">{{ $review->pivot->title }}</h4>
                                <h3>Описание</h3>
                                <h5 class="fw-normal">{{ $review->pivot->description }}</h5>
                                <p class="fw-bold">{{ $review->pivot->created_at->format('d.m.Y (H:i)') }}</p>
                                <div class="d-flex flex-wrap shadow mb-2 rounded-1 w-50">
                                    <img class="m-2 w-25 rounded-2 border border-secondary border-2 border-opacity-10"
                                        src="{{ Storage::disk('public')->url($client->profile->image) }}" alt="img">
                                    <div class="d-flex flex-grow-1 align-self-center justify-content-center p-2">
                                        <h5 class="fw-semibold">{{ $client->profile->first_name }}
                                            {{ $client->profile->last_name }},
                                            {{ $client->profile->age }}
                                            {{ $gymBuilder->getUnitCase($client->profile->age) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif ($review->pivot->status === 'BLOCKED')
                        <div class="row featurette mt-4">
                            <div class="bg-light p-3 ps-4 rounded-1 shadow border border-danger border-3">
                                <h3 class="text-danger">Отзыв заблокирован модераторами сайта</h3>
                                <h3>Тема отзыва</h3>
                                <h4 class="fw-normal">{{ $review->pivot->title }}</h4>
                                <h3>Описание</h3>
                                <h5 class="fw-normal">{{ $review->pivot->description }}</h5>
                                <p class="fw-bold">{{ $review->pivot->created_at->format('d.m.Y (H:i)') }}</p>
                                <div class="d-flex flex-wrap shadow mb-2 rounded-1 w-50">
                                    <img class="m-2 w-25 rounded-2 border border-secondary border-2 border-opacity-10"
                                        src="{{ Storage::disk('public')->url($client->profile->image) }}" alt="img">
                                    <div class="d-flex flex-grow-1 align-self-center justify-content-center p-2">
                                        <h5 class="fw-semibold">{{ $client->profile->first_name }}
                                            {{ $client->profile->last_name }},
                                            {{ $client->profile->age }}
                                            {{ $gymBuilder->getUnitCase($client->profile->age) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        @else
            <hr class="featurette-divider">
            <h1>Искомый отзыв у нас не зарегистрирован...</h1>
            <hr class="featurette-divider">
        @endif
        <hr class="featurette-divider">
    @endsection
