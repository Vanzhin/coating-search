<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.index')) active @endif" aria-current="page" href="{{ route('admin.index') }}">
                    <span data-feather="home"></span>
                    Главная
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.products*')) active @endif" href="{{ route('admin.products') }}">
                    <span data-feather="layers"></span>
                    Покрытия
                    <span class="badge bg-secondary">{{$links['products']}}</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.users*')) active @endif" href="{{ route('admin.users') }}">
                    <span data-feather="users"></span>
                    Пользователи
                    <span class="badge bg-secondary">{{$links['users']}}</span>

                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.binders*')) active @endif" href="{{ route('admin.binders') }}">
                    <span data-feather="file-text"></span>
                    Основания
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.brands*')) active @endif" href="{{ route('admin.brands') }}">
                    <span data-feather="file-text"></span>
                    Производители
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.catalogs*')) active @endif" href="{{ route('admin.catalogs') }}">
                    <span data-feather="file-text"></span>
                    Сегменты
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.additives*')) active @endif" href="{{ route('admin.additives') }}">
                    <span data-feather="file-text"></span>
                    Добавки
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.environments*')) active @endif" href="{{ route('admin.environments') }}">
                    <span data-feather="file-text"></span>
                    Среда эксплуатации
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.numbers*')) active @endif" href="{{ route('admin.numbers') }}">
                    <span data-feather="file-text"></span>
                    Слои
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.substrates*')) active @endif" href="{{ route('admin.substrates') }}">
                    <span data-feather="file-text"></span>
                    Подложки
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link @if(request()->routeIs('admin.resistances*')) active @endif" href="{{ route('admin.resistances') }}">
                    <span data-feather="file-text"></span>
                    Стойкость
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link @if(request()->routeIs('admin.users*')) active @endif" href="{{ route('admin.users') }}">--}}
{{--                    <span data-feather="users"></span>--}}
{{--                    Пользователи--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link @if(request()->routeIs('admin.resources*')) active @endif" href="{{ route('admin.resources') }}">--}}
{{--                    <span data-feather="file"></span>--}}
{{--                    Источники--}}
{{--                </a>--}}
{{--            </li>--}}
        </ul>
    </div>
</nav>
