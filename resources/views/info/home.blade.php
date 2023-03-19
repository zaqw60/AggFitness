@extends('layouts.main') @section('title')
    Главная @parent
    @endsection @section('content')
    <!--blog-->
    <div class="container mt-5">
        <div class="row mb-5">
            @foreach ($dataHome['fork'] as $key => $item)
                <div class="col-md-6">
                    <div
                        class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static text-bg-light">
                            <strong class="d-inline-block mb-2 text-success">{{ $item['title'] }}</strong>
                            <h3 class="mb-0 text-dark">{{ $item['subtitle'] }}</h3>
                            <div class="mb-1 text-muted">{{ date('Y') }} год</div>
                            <p class="card-text mb-auto">{{ $item['description'] }}</p>
                            <a href="{{ route($item['url']) }}" class="stretched-link">Перейти...</a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg"
                                role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"
                                focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#212529" /><text x="50%" y="50%"
                                    fill="#198754" dy=".3em">AggFitness</text>
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row g-5">
            <div class="col-md-8">
                <!--Metabolism-->
                <div class="bg-light rounded">
                    <h3 class="p-4 text-center text-success bg-dark rounded-top">Расчет метаболизма</h3>
                    <div class="d-flex flex-column flex-wrap p-4">
                        <div class="mb-4">
                            <h5>{{ $dataHome['metabolism']['title'] }}</h5>
                            <p>{{ $dataHome['metabolism']['description'] }}</p>
                            <h5>{{ $dataHome['metabolism']['subtitle'] }}</h5>
                            <p>{{ $dataHome['metabolism']['subdescription'] }}</p>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Результат</th>
                                        <th scope="col">Значение</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataHome['metabolism']['table'] as $key => $item)
                                        <tr>
                                            <th scope="row">&#128293;</th>
                                            <td>{{ $key }}</td>
                                            <td>{{ $item }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-between flex-wrap align-self-stretch">
                            <div class="met_box me-4">
                                <div class="input-group mb-3 met_width">
                                    <span class="input-group-text">Возраст:</span>
                                    <input id="metAge" type="number" class="form-control">
                                    <span class="input-group-text">лет</span>
                                </div>
                                <div class="input-group mb-3 met_width">
                                    <span class="input-group-text">Рост:</span>
                                    <input id="metHeight" type="number" class="form-control">
                                    <span class="input-group-text">см</span>
                                </div>
                                <div class="input-group mb-3 met_width">
                                    <span class="input-group-text">Вес:</span>
                                    <input id="metWeight" type="number" class="form-control">
                                    <span class="input-group-text">кг</span>
                                </div>

                                <div class="input-group mb-3 met_width">
                                    <label class="form-control btn btn-outline-secondary text-dark">Ж:
                                        <input class="form-check-input" id="metFemale" type="radio" name="gender">
                                    </label>
                                    <span class="input-group-text">Пол</span>
                                    <label class="form-control  btn btn-outline-secondary text-dark">М:
                                        <input class="form-check-input" id="metMale" type="radio" name="gender">
                                    </label>
                                </div>
                            </div>
                            <div class="met_box me-4">
                                <div class="input-group mb-3 met_width">
                                    <span class="input-group-text">Рацион:</span>
                                    <span id="metTotalCals" class="input-group-text bg-light">0000</span>
                                    <span class="input-group-text">ккал/сут</span>
                                </div>
                                <div class="input-group mb-3 met_width">
                                    <span class="input-group-text">ИМТ:</span>
                                    <span id="metBMI" class="input-group-text bg-light">00.0</span>
                                    <span class="input-group-text">ед</span>
                                </div>
                                <div class="scale">
                                    <img class="scale_image" src="{{ asset('assets/images/scale.png') }}" alt="img">
                                    <p id="metSelector" class="text-dark scale_selector">&#9650;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="my-5 text-success">

                <!--Science-->
                <h2 class="pb-4 mb-4 fst-italic text-success">
                    Спорт и наука
                </h2>
                <article class="blog-post">
                    @foreach ($dataHome['articles'] as $key => $item)
                        <div class="shadow-lg p-4 mb-4 rounded-1 bg-light">
                            <h4 class="blog-post-title">{{ $item['title'] }}</h4>
                            <p class="fw-bold">Ключевые слова: {{ $item['keys'] }}</p>
                            <p>{{ $item['description'] }}</p>
                            <p class="fw-bold">Авторы: {{ $item['authors'] }}</p>
                            <hr>
                            <a class="btn btn-outline-success" href="{{ $item['url'] }}" target="blank">Источник...</a>
                        </div>
                    @endforeach
                    <hr class="my-5 text-success">

                    <!--News-->
                    <div class="rounded shadow-lg">
                        <div class="p-4 bg-dark rounded-top">
                            <h2 class="fst-italic text-success">
                                {{ $dataHome['news']['title'] }}
                            </h2>
                            <p class="fw-bold text-secondary">{{ $dataHome['news']['description'] }}</p>
                        </div>
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner news_height">
                                @foreach ($dataHome['news']['newsList'] as $key => $list)
                                    <div class="carousel-item @if ($key === 0) active @endif">
                                        <div class="d-flex justify-content-between flex-wrap p-4">
                                            @foreach ($list as $item)
                                                <div class="pb-2">
                                                    <a href="{{ asset($item['url']) }}" target="blank">
                                                        <img class="news_image shadow rounded"
                                                            src="{{ asset($item['img']) }}" class="d-block w-100"
                                                            alt="img">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex flex-wrap bg-light rounded-bottom p-4">
                            @foreach ($tags as $item)
                                <a href="{{ route('trainers.index', ['tag_id' => $item->id, 'city_id' => 0]) }}"
                                    class="btn btn-sm btn-outline-success mb-2 me-4">{{ $item->tag }}</a>
                            @endforeach
                        </div>
                    </div>
                    <hr class="my-5 text-success">

                    <!--TOP-->
                    <div class="rounded shadow-lg bg-light pb-4">
                        <div class="bg-dark px-4 py-3 mb-4 rounded-top">
                            <h2 class="fst-italic text-success">Топ 10 фактов из мира спорта</h2>
                        </div>
                        <div id="carouselExampleIndicators"
                            class="carousel slide shadow-lg rounded border border-2 border-success m-4"
                            data-bs-ride="true">
                            <div class="carousel-indicators">
                                @foreach ($dataHome['facts'] as $key => $item)
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="{{ $key }}"
                                        @if ($key === 0) class="active" aria-current="true" @endif
                                        aria-label="Slide {{ $key + 1 }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner rounded">
                                @foreach ($dataHome['facts'] as $key => $item)
                                    <div class="carousel-item @if ($key === 0) active @endif p-4"
                                        style="background-image: url({{ asset('assets/images/fact_' . $key + 1 . '.jpg') }}); background-size: cover">
                                        <div class="d-flex flex-column justify-content-between h-100">
                                            <div class="bg-dark px-4 py-2 rounded-4 align-self-start">
                                                <h1 class="text-success">{{ $key + 1 }}</h1>
                                            </div>
                                            <div class="bg-dark p-3 rounded">
                                                <h6 class="text-secondary">{{ $item }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Предыдущий</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Следующий</span>
                            </button>
                        </div>
                    </div>
                    <hr class="my-5 text-success">

                    <!--Start-->
                    <div class="rounded shadow-lg p-4 bg-light">
                        <h2 class="fst-italic text-success mb-4">{{ $dataHome['start']['title'] }}</h2>
                        <h6>{{ $dataHome['start']['description'] }}</h6>
                        <h3 class="fst-italic text-success mb-4">{{ $dataHome['start']['subtitle'] }}</h3>
                        <ol>
                            @foreach ($dataHome['start']['startList'] as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ol>
                    </div>
                    <hr class="my-5 text-success">
                    <div class="rounded shadow-lg p-4">
                        <h4 class="fst-italic text-success">Путешествие в тысячу миль начинается с одного шага!
                        </h4>
                        <h6 class="fst-italic text-success">( Лао-цзы )</h6>
                    </div>
            </div>
            <!--Right panel-->
            <div class="col-md-4">
                <div class="position-sticky" style="top: 6rem;">
                    <div id="carouselExampleSlidesOnly" class="carousel slide rounded mb-4" data-bs-ride="carousel">
                        <div class="carousel-inner px-4 py-3 bg-light rounded about_height">
                            @foreach ($dataHome['about'] as $key => $item)
                                <div class="carousel-item @if ($key === 0) active @endif">
                                    <h5 class="fst-italic text-success mb-2">{{ $item['title'] }}</h5>
                                    <p class="mb-0">{{ $item['description'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-light rounded p-0">
                        <div class="px-4 py-3 rounded-top bg-dark">
                            <h4 class="fst-italic text-success">Наши партнеры</h4>
                        </div>
                        <ol class="list-unstyled mb-0 px-4 py-3 lh-4 partners_scroll">
                            @foreach ($dataHome['partners'] as $key => $item)
                                <li><a href="{{ $item['url'] }}" target="blank">{{ $item['title'] }}</a></li>
                            @endforeach
                        </ol>
                    </div>

                    <div class="mt-4 rounded bg-light social_network">
                        <div class="px-4 py-2 rounded-top bg-dark">
                            <h4 class="fst-italic text-success">Соцсети</h4>
                        </div>
                        <ol class="list-unstyled px-3 py-1 social_network_scroll">
                            @foreach ($contacts as $key => $item)
                                <li><a href="{{ $item['url'] }}" target="blank">{{ $item['title'] }}</a></li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <hr class="featurette-divider">
@endsection
@push('js')
    <script src="{{ asset('assets/js/metabolism.js') }}"></script>
@endpush
