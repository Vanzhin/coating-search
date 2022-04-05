<nav class="navbar navbar-dark bg-dark sticky-md-top" aria-label="Fifth navbar example">
    <div class="container">
        <a class="navbar-brand col" href="{{ route('home') }}">{{env('APP_NAME')}}</a>
        <a class="col btn btn-outline-secondary text-reset text-decoration-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"
        style="max-width: 50px;">
            <span class="navbar-toggler-icon"></span>
        </a>
        <div class="col offset d-flex justify-content-end align-items-center flex-nowrap" id="navbarsExample05" style="">

            <form class="mx-2">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
            </form>
            @if(Auth::guest())
                <div class="text-end navbar-brand">
                    <a href="{{ route('login') }}"  class="btn btn-outline-primary me-auto">Вход</a>
                </div>
            @else

                <div class="dropdown">
                    <a href="{{ route('account.index') }}" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="@if(Auth::user()->avatar){!!Auth::user()->avatar!!}@else{!!Storage::disk('public')->url('images/users/default.png')!!}@endif" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small dropdown-menu dropdown-menu-dark shadow">
                        <li><a class="dropdown-item" href="{{ route('account.index') }}">Профиль</a></li>
                        <li><a class="dropdown-item" href="#">Настройки</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Выйти</a></li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</nav>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">{{env('APP_NAME')}}</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="link-secondary nav-link @if(request()->routeIs('products*')) link-dark text-decoration-underline @endif" href="{{ route('products.index') }}">Покрытия</a>
                </li>
                <li class="nav-item">
                    <a class="link-secondary nav-link  @if(request()->routeIs('search*')) link-dark text-decoration-underline @endif" href="{{ route('search') }}">Подбор</a>
                </li>
                <li class="nav-item">
                    <a class="link-secondary nav-link disabled" href="#" >Вопросы</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="link-secondary nav-link dropdown-toggle disabled" href="#" id="dropdown05" data-bs-toggle="dropdown" aria-expanded="false">Типовые решения</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdown05">
                        <li><a class="dropdown-item" href="#">Погружение</a></li>
                        <li><a class="dropdown-item" href="#">Атмосфера</a></li>
                        <li><a class="dropdown-item" href="#">Химстойкость</a></li>
                    </ul>
                </li>
                @if(Auth::user() && Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a class="nav-link link-success" href="{{ route('admin.index') }}">Панель управления</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>

