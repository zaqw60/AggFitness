@extends('layouts.main')
@section('content')
    <x-account.client.menu></x-account.client.menu>
    <br>
    <div class="container marketing">
        <h3 class="text-center">Отзывы на тренеров</h3>
        <hr class="featurette-divider">
        @if ($user)
            @if (count($user->trainers) > 0)
                <div class="w-100 p-4 mb-4 shadow rounded-1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="row">#</th>
                                <th scope="row">Ник тренера</th>
                                <th scope="row">Тема отзыва</th>
                                <th scope="row">Описание</th>
                                <th scope="row">Дата</th>
                                <th scope="row">Статус</th>
                                <th scope="row">Подробнее</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user->trainers as $key => $review)
                                <tr>
                                    <th scope="row">{{ $key + 1 }}</th>
                                    <td>{{ $review->name }}</td>
                                    <td>{{ mb_substr($review->pivot->title, 0, 26) . '...' }}</td>
                                    <td>{{ mb_substr($review->pivot->description, 0, 45) . '...' }}</td>
                                    <td>{{ $review->pivot->created_at->format('d.m.Y') }}</td>
                                    <td>
                                        @if ($review->pivot->status === 'ACTIVE')
                                            Активен
                                        @elseif ($review->pivot->status === 'DRAFT')
                                            На модерации
                                        @else
                                            Заблокирован
                                        @endif
                                    </td>
                                    <td>
                                        @if ($review->pivot->status === 'ACTIVE')
                                            <a class="btn btn-outline-success btn-sm"
                                                href="{{ route('trainers.review', [
                                                    'review_id' => $review->pivot->id,
                                                    'client_id' => $user->id,
                                                    'trainer_id' => $review->id,
                                                    'city_id' => 0,
                                                ]) }}">&#10004;</a>
                                        @elseif ($review->pivot->status === 'DRAFT')
                                            <a class="btn btn-outline-primary btn-sm"
                                                href="{{ route('trainers.review', [
                                                    'review_id' => $review->pivot->id,
                                                    'client_id' => $user->id,
                                                    'trainer_id' => $review->id,
                                                    'city_id' => 0,
                                                ]) }}">&#128736;</a>
                                        @else
                                            <a class="btn btn-outline-danger btn-sm ps-2 pe-2"
                                                href="{{ route('trainers.review', [
                                                    'review_id' => $review->pivot->id,
                                                    'client_id' => $user->id,
                                                    'trainer_id' => $review->id,
                                                    'city_id' => 0,
                                                ]) }}">??</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <hr class="featurette-divider">
            @endif
        @else
            <hr class="featurette-divider">
            <h1>Искомый клиент у нас не зарегистрирован...</h1>
            <hr class="featurette-divider">
        @endif
    </div>
    <hr class="featurette-divider">
@endsection
