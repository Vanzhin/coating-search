<nav class="navbar navbar-dark bg-dark sticky-top" aria-label="Fifth navbar example">
    <div class="container">
        <a class="navbar-brand col" href="{{ route('home') }}">
            <i class="fa-solid fa-layer-group"></i>
            {{env('APP_NAME')}}
        </a>
        <a class="col btn btn-outline-secondary text-reset text-decoration-none" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample"
        style="max-width: 50px;">
            <span class="navbar-toggler-icon"></span>
        </a>
        <div class="col offset d-flex justify-content-end align-items-center flex-nowrap" id="navbarsExample05" style="">
            <!-- Button trigger modal -->
            <button class="btn btn-outline-secondary mx-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span class="d-none d-md-inline-flex">Поиск</span>
            </button>
            @if(Auth::guest())
                <div class="text-center">
                    <a href="{{ route('login') }}"  class="btn btn-outline-primary me-auto">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        <span class="d-none d-md-inline-flex">Вход</span>
                    </a>
                </div>
            @else
                <div class="dropdown">
                    <a href="{{ route('account.index') }}" class="d-block link-dark text-warning text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="true">
                        <img src="@if(Auth::user()->avatar){!!Auth::user()->avatar!!}@else{!!Storage::disk('public')->url('images/users/default.png')!!}@endif" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu text-small shadow text-small dropdown-menu-dark" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 34px, 0px);">
                        <li><a class="dropdown-item" href="{{ route('account.index') }}">Профиль</a></li>
                        <li>
                            <a class="d-flex justify-content-between align-items-center dropdown-item" href="{{ route('search') }}">
                                <span>Мои поиски</span>
                                <span class="badge bg-light text-dark ms-1">{{ $counts['userSearches']  ?? null}}</span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex justify-content-between align-items-center dropdown-item" href="{{ route('account.my') }}">
                                <span>Мои покрытия</span>
                                <span class="badge bg-light text-dark ms-1">{{ $counts['userProducts']  ?? null}}</span>
                            </a>
                        </li>
                        <li><a class="dropdown-item disabled" href="#">Настройки</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('logout') }}">
                                <span>Выйти</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
    </div>
</nav>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">
            <i class="fa-solid fa-layer-group"></i>
            {{env('APP_NAME')}}
        </h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="d-flex justify-content-between link-secondary nav-link @if(request()->routeIs('products*')) navbar-brand @endif" href="{{ route('products.index') }}">
                        Покрытия
                        <span class="badge bg-light text-secondary">{{$counts['products']}}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="link-secondary nav-link  @if(request()->routeIs('search*')) navbar-brand @endif" href="{{ route('search') }}">Подбор</a>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    Поиск по названию
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" oninput="quickSearch(this)">
                    <label for="floatingInput">Поиск</label>
                </div>
                <div id="products" class="text-center">
                    <p class="text-center">Начните вводить запрос для получения результата</p>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        function quickSearch(content) {
            const input = content.value;
            const products = document.getElementById('products');
            products.innerHTML = '<div class="spinner-border" role="status"></div>';
            let search = { text : content.value }
            if (input){
                sendPost('/search/quick', search).then((result) => {
                    console.log(result)
                    let links ='';
                    result.forEach(function(item) {
                        links = links + '<a href="https://coatsearch.ru/products/' + item.id + '\"' + ' class="btn btn-outline-secondary col-12 col-md-5 m-1">' + item.title + '</a>';
                    })
                    if(links){
                        products.innerHTML = links;
                    }else {
                        products.innerHTML = '<p class="col" >Кажется, ничего не найдено ;(</p>' + '<a href="https://coatsearch.ru/search/create" class="btn col-12 btn-secondary btn-lg mb-4">Начать поиск по параметрам</a>';
                    }
                });
            } else {
                products.innerHTML = '<p class="col">Похоже, задан пустой запрос</p>' + '<a href="https://coatsearch.ru/search/create" class="btn col-12 btn-secondary btn-lg mb-4">Начать поиск по параметрам</a>';
            }
        }
        async function sendPost(url, data){

            let response = await fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                    'Content-Type': 'application/json; charset=utf-8',
                },
                body: JSON.stringify(data)
            });
            return await response.json();
        }
    </script>
@endpush

