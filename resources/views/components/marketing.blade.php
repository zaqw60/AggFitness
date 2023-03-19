<!-- HOME -->
@if (request()->routeIs('info.home'))
    <div id="myCarousel" class="carousel slide mb-0 border-top border-1 border-success" data-bs-ride="carousel">
        <div class="carousel-indicators promo_info">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            @forelse(config('promo.home.promoList') as $key => $promoItem)
                <div class="carousel-item @if ($key === 0) active @endif">
                    <div class="dark_glass">
                        <img src="{{ asset('assets/images/slider-image' . $key + 1 . '.jpg') }}" alt="img"
                            class="promo_image">
                    </div>
                    <svg class="bd-placeholder-img" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect fill="#777" />
                    </svg>

                    <div class="container promo_info">
                        <div class="carousel-caption text-start">
                            <h1>{{ $promoItem['title'] }}</h1>
                            <p>{{ $promoItem['description'] }}</p>
                            <a class="btn btn-lg btn-outline-success" href="{{ $promoItem['url'] }}">Подробнее
                                &raquo;</a>
                        </div>
                    </div>
                </div>
            @empty
                <h2>Записей нет</h2>
            @endforelse

        </div>
        <button class="carousel-control-prev promo_info" type="button" data-bs-target="#myCarousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next promo_info" type="button" data-bs-target="#myCarousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endif
<!--Custom Cards-->
<div class="w-100 bg-dark border-top border-1 border-success">
    <div class="container pt-4" id="custom-cards">
        <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4 pt-4 pb-5">
            @forelse(config('promo.home.marketList') as $keyMain => $marketItemMain)
                <div id="carouselExampleSlidesOnly" class="col carousel slide m-0 pb-2" data-bs-ride="carousel">
                    <div class="carousel-inner rounded-4 marketing_height">
                        @forelse($marketItemMain as $key => $marketItem)
                            <div class="border border-success border-black carousel-item card card-cover h-100 overflow-hidden text-bg-dark rounded-4 shadow-lg @if ($key === 0) active @endif"
                                style="background-image: url({{ asset('assets/images/market_' . $keyMain + 1 . '_' . $key + 1 . '.jpg') }}); background-size: cover">
                                <div class="glass rounded-4 h-100">
                                    <div class="d-flex flex-column h-100 p-3 text-white text-shadow-1 rounded-4">
                                        <h5 class="lh-1 fw-bold text-success">{{ $marketItem['title'] }}</h5>
                                        <h6 class="lh-2 fw-normal text-white">{{ $marketItem['description'] }}
                                        </h6>
                                        <ul class="d-flex justify-content-between list-unstyled mt-auto">
                                            <li class="d-flex align-items-center">
                                                <a class="btn btn-sm btn-outline-success"
                                                    href="{{ $marketItem['url'] }}" target="blank">Подробнее &raquo;</a>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <img width="48" src="{{ asset('assets/images/favicon.png') }}"
                                                    alt="img">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h2>Записей нет</h2>
                        @endforelse
                    </div>
                </div>
            @empty
                <h2>Записей нет</h2>
            @endforelse
        </div>
    </div>
</div>
