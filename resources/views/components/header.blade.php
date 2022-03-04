<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-md-top" aria-label="Fifth navbar example">
    <div class="container d-flex flex-wrap align-items-center justify-content-around justify-content-lg-start">
        <a class="navbar-brand" href="{{ route('home') }}">{{env('APP_NAME')}}</a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarsExample05" style="">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('products*')) active @endif" href="{{ route('products.index') }}">Покрытия</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Подбор</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Вопросы</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdown05" data-bs-toggle="dropdown" aria-expanded="false">Типовые решения</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown05">
                        <li><a class="dropdown-item" href="#">Погружение</a></li>
                        <li><a class="dropdown-item" href="#">Атмосфера</a></li>
                        <li><a class="dropdown-item" href="#">Химстойкость</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.index') }}">Панель управления</a>
                </li>
            </ul>

            <form>
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </form>
            <div class="dropdown text-end">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item" href="#">Профиль</a></li>
                    <li><a class="dropdown-item" href="#">Настройки</a></li>
{{--                    <li><a class="dropdown-item" href="#">Profile</a></li>--}}
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Выйти</a></li>
                </ul>
            </div>
        </div>
        </div>
</nav>
