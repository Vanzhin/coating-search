<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Поиск ЛКМ по параметра, поиск краски по параметрам, поиск защитных покрытий по параметрам">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('/safari-pinned-tab.svg') }}" color="#424361">
    <meta name="msapplication-TileColor" content="#424361">
    <meta name="theme-color" content="#ffffff">
    <title>@section('title') - Панель управления @show</title>


    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fixedtable.css') }}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link href="{{ asset('css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">

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
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
</head>

@component('components.admin.header')
@endcomponent


<div class="container-fluid">
    <div class="row">
        @component('components.admin.sidebar')
        @endcomponent
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            @yield('header')
            <div class="justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                @yield('content')
            </div>
        </main>
    </div>
</div>


<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/feather.min.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>

<script src="{{ asset('js/jquery.min.js') }}"></script>

{{--<!-- Latest compiled and minified JavaScript -->--}}
<script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>

@stack('js')
</html>


