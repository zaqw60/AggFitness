<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="{{ route('info.home') }}">
        <img class="logo_image_header me-1" src="{{ asset('assets/images/favicon.png') }}" alt="logo">
        AggFitness
    </a>

    @if (request()->routeIs('admin.users.*') || request()->routeIs('admin.subscriptions.index'))
        <input id="tableSearchText" class="form-control form-control-dark w-100 rounded-0 border-0" type="text"
            placeholder="Поиск" aria-label="Search">
    @else
        <div class="form-control form-control-dark w-100 rounded-0 border-0" style="padding: 1.45rem 1rem;"></div>
    @endif

    <div class="navbar-nav">
        <div class="d-flex nav-item text-nowrap">
            <!--Ссылка на главную страницу для мобильных устройств, при малом разрешении боковое меню скрыто-->
            <a class="nav-link px-3" href="{{ route('admin.index') }}"><svg xmlns="http://www.w3.org/2000/svg"
                    width="16" height="16" fill="currentColor" class="bi bi-boombox" viewBox="0 0 16 16">
                    <path
                        d="M2.5 5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Zm2 0a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Zm7.5-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Zm1.5.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1Zm-7-1a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3Zm5.5 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z" />
                    <path
                        d="M11.5 13a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Zm0-1a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3ZM5 10.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z" />
                    <path d="M7 10.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-1 0a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                    <path
                        d="M14 0a.5.5 0 0 1 .5.5V2h.5a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h12.5V.5A.5.5 0 0 1 14 0ZM1 3v3h14V3H1Zm14 4H1v7h14V7Z" />
                </svg></a>
            <a class="nav-link px-3" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Выход') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</header>
