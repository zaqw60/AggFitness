@extends('layouts.main')
@section('title')
    Тренер: @if (isset($trainer->profile))
        {{ $trainer->profile->first_name }} {{ $trainer->profile->father_name }} {{ $trainer->profile->last_name }}
    @endif
    @parent
@endsection
@section('content')
    <div class="d-flex align-items-center body_back border-top border-1 border-success">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a class="text-white-50 link-success"
                        href="{{ route('trainers.index', ['tag_id' => 0, 'city_id' => $city_id]) }}">Тренеры</a></li>
                <li class="breadcrumb-item text-white-50" aria-current="page"> {{ $trainer->profile->first_name }}
                    {{ $trainer->profile->last_name }}</li>
            </ol>
        </nav>
    </div>
    <div class="container marketing">
        <hr class="featurette-divider">
        @if ($trainer)
            <div class="row featurette">
                <div class="col-md-3">
                    <img class="small_market_image" src="{{ Storage::disk('public')->url($trainer->profile->image) }}"
                        alt="img">
                </div>
                <div class="col-md-7">
                    <h2 class="lh-1">{{ $trainer->profile->first_name }}
                        {{ $trainer->profile->father_name }}
                        {{ $trainer->profile->last_name }}</h2>
                    <div class="d-flex">
                        <h4>Рейтинг: @if (count($trainer->clients))
                                {{ $trainerBuilder->getScore($trainer->clients) }}
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
                    <p class="lead">Город: {{ $trainer->skill->location }}</p>
                    <p class="lead">Телефон: {{ $trainer->phone }}</p>
                    <p class="lead">Email: {{ $trainer->email }}</p>
                    <p class="lead">Возраст: {{ $trainer->profile->age }}
                        {{ $trainerBuilder->getUnitCase($trainer->profile->age) }}</p>
                    <p class="lead">Опыт: {{ $trainer->skill->experience }}
                        {{ $trainerBuilder->getUnitCase($trainer->skill->experience) }}</p>
                    <div class="d-flex flex-wrap align-items-start">
                        @forelse($trainer->tags as $key => $tagItem)
                            <a class="btn btn-secondary mb-2 me-2"
                                href="{{ route('trainers.index', ['tag_id' => $tagItem->id, 'city_id' => $city_id]) }}">
                                {{ $tagItem->tag }}
                            </a>
                        @empty
                            <a class="btn btn-secondary mb-2 me-2"
                                href="{{ route('trainers.index', ['tag_id' => 0, 'city_id' => $city_id]) }}">
                                Профиль тренировок не указан
                            </a>
                        @endforelse
                    </div>
                    <a class="btn btn-outline-danger mt-3 mb-2 me-2"
                        href="{{ route('trainers.index', ['tag_id' => 0, 'city_id' => $city_id]) }}">&#9668; &#9668;
                        &#9668; Назад
                    </a>
                    @if (!Auth::user() || Auth::user()->role_id === 3)
                        <a class="btn btn-outline-success mt-3 mb-2 me-2"
                            href="{{ route('trainerReviews.edit', ['trainerReview' => $trainer->id]) }}">Отзыв &#9650;
                            &#9650;
                            &#9650;</a>
                    @endif
                </div>
            </div>


            <div class="row featurette mt-4">
                <div class="bg-light p-3 ps-4 rounded-1 shadow">
                    <h3>Образование</h3>
                    <p>{{ $trainer->skill->education }}</p>
                    <h3>Навыки</h3>
                    <ul class="lh-4">
                        @foreach (explode('. ', $trainer->skill->skills_list) as $item)
                            <li>{{ rtrim($item, '.') }}</li>
                        @endforeach
                    </ul>
                    <h3>Достижения</h3>
                    <ul class="lh-4">
                        @foreach (explode('. ', $trainer->skill->achievements) as $item)
                            <li>{{ rtrim($item, '.') }}</li>
                        @endforeach
                    </ul>
                    <h3>О себе</h3>
                    <p>{{ $trainer->skill->description }}</p>
                </div>
            </div>
        @else
            <hr class="featurette-divider">
            <h1>Искомый тренер у нас не зарегистрирован...</h1>
            <hr class="featurette-divider">
        @endif
        <div class="container px-4 py-5" id="featured-3">
            <h2 class="text-center">
                @if (count($reviews))
                    Отзывы
                @endif
            </h2>
            <div id="reviews" class="row g-5 py-5 row-cols-1 row-cols-lg-3">
                <!--Карточка отзыва -->
                @forelse($reviews as $review)
                    @foreach ($review->trainers as $trainerR)
                        @if ($trainerR->id === $trainer_id && $trainerR->pivot->status === 'ACTIVE')
                            <div class="feature col">
                                <div class="p-3 bg-light rounded-1 shadow">
                                    <div class="d-flex flex-wrap shadow mb-2 rounded-1">
                                        <img class="m-2 w-25 rounded-2 border border-secondary border-2 border-opacity-10"
                                            src="{{ Storage::disk('public')->url($review->profile->image) }}"
                                            alt="img">
                                        <div class="d-flex flex-column align-self-center p-2">
                                            <h6>{{ $review->profile->first_name }}
                                                {{ $review->profile->last_name }}</h6>
                                            <h6>{{ $review->profile->age }}
                                                {{ $trainerBuilder->getUnitCase($review->profile->age) }}</h6>
                                        </div>
                                    </div>
                                    <h4>{{ mb_substr($trainerR->pivot->title, 0, 18) . '...' }}</h4>
                                    <p>{{ mb_substr($trainerR->pivot->description, 0, 80) . '...' }}</p>
                                    <p>{{ $trainerR->pivot->created_at->format('d.m.Y (H:i)') }}</p>
                                    <a href="{{ route('trainers.review', [
                                        'review_id' => $trainerR->pivot->id,
                                        'client_id' => $review->id,
                                        'trainer_id' => $trainer->id,
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
            @if (count($reviews))
                {{ $reviews->links() }}
            @endif
        </div>
    @endsection
