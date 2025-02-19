<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Логистика</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                @if (Auth::check())
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Маршруты</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('routes.create') }}">Новый</a></li>
                            <li><a class="dropdown-item" href="{{ route('routes.list') }}">Список</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('routes.archive') }}">Архив</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Заправки</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('refilling.create') }}">Новая</a></li>
                            <li><a class="dropdown-item" href="{{ route('refilling.list') }}">Список</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('refilling.archive') }}">Архив</a></li>
                            <li><a class="dropdown-item" href="{{ route('refilling.fuelsupplier') }}">Поставщики</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Выплаты</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('salary.create') }}">Новая</a></li>
                            <li><a class="dropdown-item" href="{{ route('salary.list') }}">Список</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('salary.archive') }}">Архив</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Расчеты</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profit.list') }}">Текущие</a></li>
                            <li><a class="dropdown-item" href="{{ route('profit.archive') }}">Общая сверка</a></li>
                        </ul>
                    </li>

                    @cannot('is-driver')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Настройки
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            {{-- <li><a class="dropdown-item" href="{{ route('directory.type-trucks') }}">Типы
                            грузовиков</a>
                    </li> --}}
                    {{-- <li><a class="dropdown-item" href="{{ route('directory.cargo') }}">Перевозимые
                    грузы</a>
                    </li> --}}
                    {{-- <li><a class="dropdown-item" href="{{ route('directory.petrol-stations') }}">АЗС</a>
                    </li> --}}
                    {{-- <li><a class="dropdown-item" href="{{ route('directory.payers') }}">Плательщики</a>
                    </li> --}}
                    {{-- <li>
                        <hr class="dropdown-divider">
                    </li> --}}
                    {{-- <li><a class="dropdown-item" href="{{ route('billing.distance') }}">Тарификация по
                    расстоянию</a></li> --}}
                    {{-- <li><a class="dropdown-item" href="{{ route('billing.route') }}">Тарификация по
                    маршруту</a></li> --}}
                    {{-- <li><a class="dropdown-item" href="{{ route('directory.services') }}">Услуги</a></li> --}}
                    {{-- <li>
                        <hr class="dropdown-divider">
                    </li> --}}
                    <li><a class="dropdown-item" href="{{ route('user.list') }}">Пользователи</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.roles') }}">Роли пользователей</a></li>
                </ul>
                </li>
                @endcannot
                </ul>
                <a class="btn btn-link" href="{{ route('user.edit', Auth::user()->id) }}">{{
                    Auth::user()->profile->FullName }}</a>
                <a class="btn btn-outline-light" href="{{ route('user.logout') }}" role="button">Выход</a>
                @else
                <a class="btn btn-outline-light" href="{{ route('user.login') }}" role="button">Вход</a>
                @endif
            </div>
        </div>
    </nav>
</header>
