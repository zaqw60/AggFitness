@extends('layouts.main')
@section('title')
    Список фитнес-клубов @parent
@endsection
@section('content')
    <div class="d-flex align-items-center justify-content-center bg-dark">
        <h4 class="m-4"> {{ config('cities')[$city_id] }} </h4>
    </div>
    <div class="container marketing">
        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">Список фитнес-клубов</h2>
                <p class="lead">Здесь можно ознакомиться с рейтингами, отзывами, получить контактные данные и подробную
                    информацию о
                    каждом фитнес-клубе в вашем городе</p>
            </div>
        </div>
        @if (request()->title)
            <h3>Результаты поиска: <span class="fw-lighter">{{ request()->title }}</span></h3>
            <a class="btn btn-outline-danger mt-3 mb-2 me-2" href="{{ route('gyms.index', ['city_id' => $city_id]) }}">&#9668;
                &#9668;
                &#9668; Назад
            </a>
        @endif
        <hr class="featurette-divider">
        <!-- Three columns of text below the carousel -->
        <div class="trainers_box">
            @forelse($gymsList as $key => $gym)
                @if ($gym->user->status === 'ACTIVE')
                    <div class="item_box border border-success border-2">
                        <img src="{{ Storage::disk('public')->url($gym->images[0]->image) }}"
                            class="bd-placeholder-img index_image border border-success border-1 shadow" alt="img">
                        <h5 class="fw-normal trainers_name mt-2">{{ $gym->title }}</h5>
                        <table class="table table-striped-columns mt-3 rounded-1 shadow">
                            <thead>
                                <tr>
                                    <th scope="col">Рейтинг:</th>
                                    <th scope="col">
                                        @if (count($gym->clients))
                                            {{ $gymBuilder->getScore($gym->clients) }}
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
                                    <td>Город:</td>
                                    <td>{{ $gym->addresses[0]->city }}</td>
                                </tr>
                                <tr>

                                    <td>Телефон:</td>
                                    <td>{{ $gym->phone_main }}</td>
                                </tr>
                                <tr>
                                    <td>Телефон:</td>
                                    <td>
                                        @if ($gym->phone_second)
                                            {{ $gym->phone_second }}
                                        @else
                                            {{ $gym->phone_main }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Email:</td>
                                    <td>{{ $gym->email }}</td>
                                </tr>
                                <tr>
                                    <td>Сайт:</td>
                                    <td><a href="{{ $gym->url }}" target="blank">{{ $gym->title }}</a></td>
                                </tr>
                        </table>
                        <h6 class="fw-normal">Описание:</h6>
                        <div class="flex-grow-1">
                            <div class="d-flex flex-wrap align-items-start">
                                <p>
                                    {{ mb_substr($gym->description, 0, 120) . '...' }}
                                </p>
                            </div>
                        </div>
                        <a class="btn btn-outline-success mt-2"
                            href="{{ route('gyms.show', ['id' => $gym->id, 'city_id' => $city_id]) }}">Подробнее
                            &raquo;</a>
                    </div>
                @endif
                <!-- /.col-lg-4 -->
            @empty
                <h2>Список пуст</h2>
            @endforelse
        </div><!-- /.row -->
        @if (request() && count($gymsList))
            {{ $gymsList->appends(['title' => request()->title])->links() }}
        @elseif(!request() && count($gymsList))
            {{ $gymsList->links() }}
        @endif
        <hr class="featurette-divider">
    </div>
@endsection
