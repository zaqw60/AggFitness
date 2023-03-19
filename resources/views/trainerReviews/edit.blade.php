@extends('layouts.main')
@section('title')
    Новый отзыв - {{ $trainer->profile->first_name }} {{ $trainer->profile->last_name }}
    @parent
@endsection
@section('content')
    <div class="d-flex align-items-center body_back border-top border-1 border-success">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb m-3">
                <li class="breadcrumb-item"><a class="text-white-50 link-success"
                        href="{{ route('trainers.index', ['tag_id' => 0, 'city_id' => 0]) }}">Тренеры</a></li>
                <li class="breadcrumb-item"><a class="text-white-50 link-success"
                        href="{{ route('trainers.show', ['id' => $trainer->id, 'city_id' => 0]) }}">{{ $trainer->profile->first_name }}
                        {{ $trainer->profile->last_name }}</a></li>
                <li class="breadcrumb-item text-white-50" aria-current="page">Новый отзыв</li>
            </ol>
        </nav>
    </div>
    <hr class="featurette-divider">
    <div class="container">
        <div class="card">
            <div class="d-flex justify-content-between card-header">
                <a class="btn btn-outline-danger m-2"
                    href="{{ route('trainers.show', ['id' => $trainer->id, 'city_id' => 0]) }}">&#9668; &#9668;
                    &#9668; Назад
                </a>
                <h5 class="m-2">{{ __('Новый отзыв') }}</h5>
            </div>
            <div class="card-body d-flex flex-column justify-content-center align-items-stretch flex-wrap">
                <div class="d-flex align-items-start justify-content-center text-center w-100 mt-3 mb-4 flex-wrap">
                    <img class="shadow-lg rounded-start review_image mb-4"
                        src="{{ Storage::disk('public')->url($trainer->profile->image) }}" alt="img">
                    <table class="table table-striped-columns rounded-end shadow w-25">
                        <thead>
                            <tr>
                                <th scope="col">&#10004;</th>
                                <th scope="col" class="text-nowrap">{{ $trainer->profile->first_name }}</th>
                                <th scope="col" class="text-nowrap">
                                    {{ $trainer->profile->last_name }}</th>
                            </tr>
                        </thead>
                        <tbody>
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
                                <td class="text-nowrap">{{ $trainer->skill->location }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <form class="w-100" method="POST"
                    action="{{ route('trainerReviews.update', ['trainerReview' => $trainer->id]) }}">
                    @csrf
                    @method('put')
                    <div class="d-flex flex-column justify-content-center align-items-center">
                        <input id="client_id" type="number" name="client_id" value="0" required hidden>
                        <input id="trainer_id" type="number" name="trainer_id" value="0" required hidden>
                        <input id="status" type="text" name="status" value="BLOCKED" required hidden>

                        <div class="w-75 mb-4">
                            <label for="score" class="mb-2">{{ __('Поставить оценку от 1 до 5') }} <svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#daa520"
                                    class="bi bi-star mt-1 ms-1" viewBox="0 0 16 16">
                                    <path fill="#daa520"
                                        d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z" />
                                </svg></label>
                            <input id="score" type="number"
                                class="form-control review_number @error('score') is-invalid @enderror" name="score"
                                value="{{ old('score') }}" required autocomplete="score" autofocus min="1"
                                max="5">

                            @error('score')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="w-75 mb-4">
                            <label for="title" class="mb-2">{{ __('Тема отзыва') }}</label>
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') }}" required autocomplete="title">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="w-75 mb-4">
                            <label for="description" class="mb-2">{{ __('Текст отзыва') }}</label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" required
                                autocomplete="description" rows="8">{{ old('description') }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-outline-success">
                                {{ __('Отправить') }}
                            </button>
                        </div>
                </form>
                <p class="w-75 p-3 mb-4 shadow rounded-1">* Проверьте, всё ли вы написали, о чем хотели поделиться. После
                    отправки отзыва на модерацию текст отзыва уже нельзя будет изменить или дополнить.</p>
                <p class="w-75 p-3 mb-4 shadow rounded-1">* Отзыв должен быть написан на русском языке, в тексте не должно
                    быть
                    грубых
                    орфографических и
                    синтаксических ошибок. Текст не должен содержать грубых, оскорбительных и нелитературных слов и
                    выражений, признаков разжигания ненависти, экстремизма и необоснованной клеветы, а также рекламы, или
                    сторонней информации, не связанной с деятельностью фитнес-тренера.</p>
            </div>
        </div>
    </div>
    <hr class="featurette-divider">
@endsection
