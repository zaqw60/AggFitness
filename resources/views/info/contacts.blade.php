@extends('layouts.main') @section('title')
    Контакты @parent
    @endsection @section('content')
    <div class="container marketing">
        <hr class="featurette-divider">
        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="fw-normal lh-1 ms-4 mb-4">{{ $main['title'] }}</h2>
                <table class="table p-4">
                    <thead>
                        <tr>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($main['list'] as $key => $item)
                            <tr>
                                <th class="fs-5"><span class="text-success">&#10004;</span></th>
                                <th class="fs-5 contacts_hide">{{ $key }}</th>
                                <td class="fs-5">{{ $item }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex w-25 rounded-3 ms-4 mb-4">
                    @foreach ($main['hrefList'] as $key => $item)
                        <a class="rounded-circle me-4 social_dark" href="{{ $item['url'] }}" target="blank">
                            <img src="{{ asset($item['img']) }}" alt="{{ $item['alt'] }}">
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="col-md-5 p-2 shadow-lg">
                <script type="text/javascript" charset="utf-8" async
                    src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Af55e622a7248aed8a59efc1a244ac5de15a823389363dc310a959719e7a8669c&amp;width=100%25&amp;height=500&amp;lang=ru_RU&amp;scroll=true">
                </script>
            </div>
        </div>
        <hr class="featurette-divider">
    </div>
    <hr class="featurette-divider">
    </div>
@endsection
