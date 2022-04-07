<header class="p-3 bg-dark text-white">
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-2">
            <p class="col-md-4 mb-0 text-muted">© {{date('Y')}} {{env('APP_NAME')}}</p>

            <a href="/" class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link px-2 text-muted">Покрытия</a></li>
                <li class="nav-item"><a href="{{ route('search') }}" class="nav-link px-2 text-muted">Подбор</a></li>
{{--                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted disabled">Вопросы</a></li>--}}
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link px-2 text-muted">О проекте</a></li>
            </ul>
        </footer>
    </div>
</header>
