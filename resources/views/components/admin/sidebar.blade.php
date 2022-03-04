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
                </a>
            </li>
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link @if(request()->routeIs('admin.categories*')) active @endif" href="{{ route('admin.categories') }}">--}}
{{--                    <span data-feather="file"></span>--}}
{{--                    Категории--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="nav-item">--}}
{{--                <a class="nav-link @if(request()->routeIs('admin.feedbacks*')) active @endif" href="{{ route('admin.feedbacks') }}">--}}
{{--                    <span data-feather="file-text"></span>--}}
{{--                    Отзывы--}}
{{--                </a>--}}
{{--            </li>--}}
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
