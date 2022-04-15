<!doctype html>
<html lang="en" class="h-100">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Поиск ЛКМ по параметрам, поиск краски по параметрам, поиск промышленных защитных покрытий по параметрам">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('/safari-pinned-tab.svg') }}" color="#424361">
    <meta name="msapplication-TileColor" content="#424361">
    <meta name="theme-color" content="#ffffff">
    <title>{{env('APP_NAME')}} | Приветствие</title>


    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="{{ asset('css/cover.css') }}" rel="stylesheet">

</head>
<body class="d-flex h-100 text-center text-white bg-dark">

<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
        <div>
            <h3 class="float-md-start mb-0">Coating Search</h3>
            <nav class="nav nav-masthead justify-content-center float-md-end">
                @if(Auth::check())
                    <a class="nav-link" href="{{ route('account.index') }}">Мой профиль</a>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Вход</a>
                    <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                @endif

            </nav>
        </div>
    </header>

    <main class="px-3">
        <h1>Поиск покрытий</h1>
        <p class="lead">Подбор покрытий по параметрам</p>
        <p class="lead">
            <a href="{{ route('home') }}" class="btn btn-lg btn-secondary fw-bold border-white bg-white">Вперед</a>
        </p>
    </main>

    <footer class="mt-auto text-white-50">
        <p>Проект создан <a href="mailto:vanzhin@outlook.com" class="text-white">NV</a> в 2022.</p>
    </footer>
</div>



</body>
</html>
