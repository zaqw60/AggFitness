@extends('layouts.main')
@section('title')
    Список тренеров @parent
@endsection
@section('content')
    <div class="d-flex align-items-center justify-content-center bg-dark">
        <div class="dropdown p-3 d-flex justify-content-center flex-grow-1">
            <button class="btn btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                @if ($tag_id !== 0)
                    {{ $tags[$tag_id - 1]->tag }}
                @else
                    Категории тренировок
                @endif
            </button>
            <div class="tags_box body_back dropdown-menu">
                <div class="container">
                    <div class="body_back p-4">
                        @if (!request()->is("*/0/$city_id"))
                            <a class="mb-2 me-1 btn btn-outline-success"
                                href="{{ route('trainers.index', ['tag_id' => 0, 'city_id' => $city_id]) }}">
                                Все категории
                            </a>
                        @endif
                        @foreach ($tags as $tag)
                            <a class="mb-2 me-1 btn btn-outline-secondary @if (request()->is("*/$tag->id/$city_id")) active @endif"
                                href="{{ route('trainers.index', ['tag_id' => $tag->id, 'city_id' => $city_id]) }}">
                                {{ $tag->tag }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <h4 class="me-4"> {{ config('cities')[$city_id] }} </h4>
    </div>
    <div class="container marketing">
        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">Список фитнес-тренеров</h2>
                <p class="lead">Здесь можно ознакомиться с анкетами, получить контактные данные и подробную информацию о
                    каждом фитнес-тренере</p>
            </div>
        </div>
        @if (request()->firstName || request()->lastName)
            <h3>Результаты поиска: <span class="fw-lighter">{{ request()->firstName }}
                    {{ request()->lastName }}</span></h3>
            <a class="btn btn-outline-danger mt-3 mb-2 me-2"
                href="{{ route('trainers.index', ['tag_id' => $tag_id, 'city_id' => $city_id]) }}">&#9668; &#9668;
                &#9668; Назад
            </a>
        @endif
        <hr class="featurette-divider">
        <!-- Three columns of text below the carousel -->
        <div class="trainers_box">
            @forelse($trainersList as $key => $trainer)
                <div class="item_box border border-success border-2">
                    <img src="{{ Storage::disk('public')->url($trainer->profile->image) }}"
                        class="bd-placeholder-img index_image border border-success border-1 shadow" alt="img">
                    <h3 class="fw-normal trainers_name">{{ $trainer->profile->first_name }}
                        {{ $trainer->profile->last_name }}</h3>
                    <table class="table table-striped-columns mt-3 rounded-1 shadow">
                        <thead>
                            <tr>
                                <th scope="col">&#10004;</th>
                                <th scope="col">Рейтинг:</th>
                                <th scope="col">
                                    @if (count($trainer->clients))
                                        {{ $trainerBuilder->getScore($trainer->clients) }}
                                    @else
                                        Нет оценки
                                    @endif
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#daa520"
                                        class="bi bi-star mt-1 ms-1" viewBox="0 0 16 16">
                                        <path fill="#daa520"
                                            d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                    </svg>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">&#10004;</th>
                                <td>Возраст:</td>
                                <td>{{ $trainer->profile->age }}
                                    {{ $trainerBuilder->getUnitCase($trainer->profile->age) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">&#10004;</th>
                                <td>Опыт:</td>
                                <td>{{ $trainer->skill->experience }}
                                    {{ $trainerBuilder->getUnitCase($trainer->skill->experience) }}</td>
                            </tr>
                            <tr>
                                <th scope="row">&#10004;</th>
                                <td>Город:</td>
                                <td>{{ $trainer->skill->location }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <h6 class="fw-normal">Категории тренировок:</h6>
                    <div class="flex-grow-1">
                        <div class="d-flex flex-wrap align-items-start">
                            @forelse($trainer->tags as $key => $tagItem)
                                <p class="btn btn-secondary btn-sm disabled m-1 me-2 pt-0 pb-0 ps-1 pe-1">
                                    {{ $tagItem->tag }}
                                </p>
                            @empty
                                <p class="btn btn-secondary btn-sm disabled me-2 pt-0 pb-0 ps-1 pe-1">
                                    Профиль тренировок не указан
                                </p>
                            @endforelse
                        </div>
                    </div>
                    <a class="btn btn-outline-success mt-2"
                        href="{{ route('trainers.show', ['id' => $trainer->id, 'city_id' => $city_id]) }}">Подробнее
                        &raquo;</a>
                </div>
                <!-- /.col-lg-4 -->
            @empty
                <h2>Список пуст</h2>
            @endforelse
        </div><!-- /.row -->
        @if (request() && count($trainersList))
            {{ $trainersList->appends(['firstName' => request()->firstName, 'lastName' => request()->lastName])->links() }}
        @elseif(!request() && count($trainersList))
            {{ $trainersList->links() }}
        @endif
        <hr class="featurette-divider">
    </div>
@endsection
