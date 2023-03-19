@extends('layouts.main')
@section('title')
    Фитнес-клуб: @if (isset($gym->title))
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
                <li class="breadcrumb-item text-white-50" aria-current="page"> {{ $gym->title }} </li>
            </ol>
        </nav>
    </div>
    <div class="container marketing">
        <hr class="featurette-divider">
        @if ($gym)
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
                        href="{{ route('gyms.index', ['city_id' => $city_id]) }}">&#9668; &#9668;
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
            <!--Слайдер-->
            <div class="row featurette">
                <div class="bg-light p-3 ps-4 rounded-1 shadow">
                    <h3 class="mb-2">О клубе</h3>
                    <h6 class="fw-normal mb-3">{{ $gym->description }}</h6>
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                        <div class="carousel-indicators">
                            @foreach ($gym->images as $key => $image)
                                <button type="button" data-bs-target="#carouselExampleIndicators"
                                    data-bs-slide-to="{{ $key }}"
                                    class="bg-dark @if ($key === 0) active @endif"
                                    @if ($key === 0) aria-current="true" @endif
                                    aria-label="Slide {{ $key + 1 }}"></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($gym->images as $key => $image)
                                <div class="carousel-item @if ($key === 0) active @endif">
                                    <img src="{{ Storage::disk('public')->url($image->image) }}" class="d-block w-100"
                                        alt="image">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon bg-dark rounded-2" aria-hidden="true"></span>
                            <span class="visually-hidden">Предыдущий</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon bg-dark rounded-2" aria-hidden="true"></span>
                            <span class="visually-hidden">Следующий</span>
                        </button>
                    </div>
                    <div class="w-100 p-3 mb-4 shadow rounded-1">
                        <h5 class="text-center mb-4">Адреса филиалов</h5>
                        <table class="table addresses_hide">
                            <thead>
                                <tr>
                                    <th scope="row">#</th>
                                    <th scope="row">Страна</th>
                                    <th scope="row">Индекс</th>
                                    <th scope="row">Город</th>
                                    <th scope="row">Улица</th>
                                    <th scope="row">Дом</th>
                                    <th scope="row">Строение</th>
                                    <th scope="row">Этаж</th>
                                    <th scope="row">Офис</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($gym->addresses[0]))
                                    @foreach ($gym->addresses as $key => $address)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $address->country }}</td>
                                            <td>{{ $address->index }}</td>
                                            <td>{{ $address->city }}</td>
                                            <td>{{ $address->street }}</td>
                                            <td>{{ $address->house_number }}</td>
                                            <td>{{ $address->building }}</td>
                                            <td>{{ $address->floor }}</td>
                                            <td>{{ $address->apartment }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <ul class="list-group addresses_show">
                            @if (isset($gym->addresses[0]))
                                @foreach ($gym->addresses as $key => $address)
                                    <li class="list-group-item">
                                        {{ $key + 1 }}.
                                        {{ $address->country }},
                                        {{ $address->index }},
                                        г.{{ $address->city }},
                                        ул.{{ $address->street }},
                                        д.{{ $address->house_number }},
                                        @if ($address->building)
                                            корп.{{ $address->building }},
                                        @endif
                                        эт.{{ $address->floor }},
                                        @if ($address->apartment)
                                            офис {{ $address->apartment }}
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @else
            <hr class="featurette-divider">
            <h1>Искомый клуб у нас не зарегистрирован...</h1>
            <hr class="featurette-divider">
        @endif

        <div class="container px-4 py-5" id="featured-3">
            <h2 class="text-center">
                @if (count($reviewers))
                    Отзывы
                @endif
            </h2>
            <div id="reviews" class="row g-5 py-5 row-cols-1 row-cols-lg-3">
                <!--Карточка отзыва -->
                @forelse($reviewers as $reviewer)
                    @foreach ($reviewer->gyms as $gymReview)
                        @if ($gymReview->id === $gym_id && $gymReview->pivot->status === 'ACTIVE')
                            <div class="feature col">
                                <div class="p-3 bg-light rounded-1 shadow">
                                    <div class="d-flex flex-wrap shadow mb-2 rounded-1">
                                        <img class="m-2 w-25 rounded-2 border border-secondary border-2 border-opacity-10"
                                            src="{{ Storage::disk('public')->url($reviewer->profile->image) }}"
                                            alt="img">
                                        <div class="d-flex flex-column align-self-center p-2">
                                            <h6>{{ $reviewer->profile->first_name }}
                                                {{ $reviewer->profile->last_name }}</h6>
                                            <h6>{{ $reviewer->profile->age }}
                                                {{ $gymBuilder->getUnitCase($reviewer->profile->age) }}</h6>
                                        </div>
                                    </div>
                                    <h4>{{ mb_substr($gymReview->pivot->title, 0, 18) . '...' }}</h4>
                                    <p>{{ mb_substr($gymReview->pivot->description, 0, 80) . '...' }}</p>
                                    <p>{{ $gymReview->pivot->created_at->format('d.m.Y (H:i)') }}</p>
                                    <a href="{{ route('gyms.review', [
                                        'review_id' => $gymReview->pivot->id,
                                        'client_id' => $reviewer->id,
                                        'gym_id' => $gym->id,
                                        'city_id' => $city_id,
                                    ]) }}"
                                        class="btn btn-outline-secondary align-items-center">
                                        Подробнее &raquo;
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @empty
                    <h2>Пока нет отзывов</h2>
                @endforelse
            </div>
            @if (count($reviewers))
                {{ $reviewers->links() }}
            @endif
        </div>
    @endsection
