@extends('layouts.main')
@section('title')
    @parent Главная
@endsection
@section('header')
    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" ></button>
{{--            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>--}}
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" ></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item bg-secondary position-relative active">
{{--                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"></rect></svg>--}}
                <picture class="container d-flex align-items-end position-absolute" style="height: 32rem;">
                    <source srcset="{!!Storage::disk('public')->url('images/pages/carousel_1_min.png')!!}" media="(max-width: 720px)">
                    <img  src="{!!Storage::disk('public')->url('images/pages/carousel_1.png')!!}" alt="info">
                </picture>
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>О проекте</h1>
                        <p>Краткий обзор и основные сведения, необходимые для работы</p>
                        <p><a class="btn btn-lg btn-primary" href="{{ route('about') }}">Подробнее</a></p>
                    </div>
                </div>
            </div>
{{--            <div class="carousel-item">--}}
{{--                <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"></rect></svg>--}}

{{--                <div class="container">--}}
{{--                    <div class="carousel-caption">--}}
{{--                        <h1>Another example headline.</h1>--}}
{{--                        <p>Some representative placeholder content for the second slide of the carousel.</p>--}}
{{--                        <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="carousel-item carousel-item bg-secondary position-relative">
                <picture class="container d-flex align-items-end position-absolute">
                    <source srcset="{!!Storage::disk('public')->url('images/pages/carousel_2_min.png')!!}" media="(max-width: 720px)">
                    <img  src="{!!Storage::disk('public')->url('images/pages/carousel_2.png')!!}" alt="info"
                    style="width: 100vw;">
                </picture>
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>В планах</h1>
                        <p>Основные пункты для обновления.</p>
                        <p><a class="btn btn-lg btn-primary" href="{{ route('info') }}">Подробнее</a></p>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
@endsection
@section('content')
    <div class="container marketing">
        <!-- Three columns of text below the carousel -->
        <div class="row card-group">
            @forelse($products as $product)
                <div class="col-lg-4 d-md-flex d-block flex-column align-items-center justify-content-between">
                    <svg xmlns="http://www.w3.org/2000/svg" width="140" height="140" fill="currentColor" class="bi bi-paint-bucket rounded-circle bg-secondary" viewBox="0 -1 13 18">
                        <path d="M6.192 2.78c-.458-.677-.927-1.248-1.35-1.643a2.972 2.972 0 0 0-.71-.515c-.217-.104-.56-.205-.882-.02-.367.213-.427.63-.43.896-.003.304.064.664.173 1.044.196.687.556 1.528 1.035 2.402L.752 8.22c-.277.277-.269.656-.218.918.055.283.187.593.36.903.348.627.92 1.361 1.626 2.068.707.707 1.441 1.278 2.068 1.626.31.173.62.305.903.36.262.05.64.059.918-.218l5.615-5.615c.118.257.092.512.05.939-.03.292-.068.665-.073 1.176v.123h.003a1 1 0 0 0 1.993 0H14v-.057a1.01 1.01 0 0 0-.004-.117c-.055-1.25-.7-2.738-1.86-3.494a4.322 4.322 0 0 0-.211-.434c-.349-.626-.92-1.36-1.627-2.067-.707-.707-1.441-1.279-2.068-1.627-.31-.172-.62-.304-.903-.36-.262-.05-.64-.058-.918.219l-.217.216zM4.16 1.867c.381.356.844.922 1.311 1.632l-.704.705c-.382-.727-.66-1.402-.813-1.938a3.283 3.283 0 0 1-.131-.673c.091.061.204.15.337.274zm.394 3.965c.54.852 1.107 1.567 1.607 2.033a.5.5 0 1 0 .682-.732c-.453-.422-1.017-1.136-1.564-2.027l1.088-1.088c.054.12.115.243.183.365.349.627.92 1.361 1.627 2.068.706.707 1.44 1.278 2.068 1.626.122.068.244.13.365.183l-4.861 4.862a.571.571 0 0 1-.068-.01c-.137-.027-.342-.104-.608-.252-.524-.292-1.186-.8-1.846-1.46-.66-.66-1.168-1.32-1.46-1.846-.147-.265-.225-.47-.251-.607a.573.573 0 0 1-.01-.068l3.048-3.047zm2.87-1.935a2.44 2.44 0 0 1-.241-.561c.135.033.324.11.562.241.524.292 1.186.8 1.846 1.46.45.45.83.901 1.118 1.31a3.497 3.497 0 0 0-1.066.091 11.27 11.27 0 0 1-.76-.694c-.66-.66-1.167-1.322-1.458-1.847z"/>
                    </svg>
                    <h2>{{ Str::upper($product->title) }}</h2>
                    <p>{{ $product->description }}</p>
                    <p class="w-100"><a class="btn btn-secondary" href="{{ route('products.show', $product) }}">Подробнее »</a></p>
                </div><!-- /.col-lg-4 -->
            @empty
                <h2>Записей нет</h2>
            @endforelse


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette text-center text-lg-start m-auto m-md-0">
            <div class="col-md-7">
                <h2 class="featurette-heading m-0">Быстрый поиск по названию.</h2>
                <span class="featurette-heading text-muted">Ищет также и на кириллице</span>
                <p class="lead">Быстро найдет материал, если он есть в базе. Просто начните вводить в текстовое поле.</p>
            </div>
            <div class="col-md-5">
                <picture class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto">
                    <source  srcset="{!!Storage::disk('public')->url('images/pages/feature_1_min.png')!!}" media="(max-width: 720px)">
                    <img width="100%" height="100%" src="{!!Storage::disk('public')->url('images/pages/feature_1.png')!!}" alt="info">
                </picture>
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette text-center text-lg-start m-auto m-md-0">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading m-0">Расширенный поиск материалов.</h2>
                <span class="featurette-heading text-muted">Найдите материал, который подходит именно Вам.</span>
                <p class="lead">Станьте авторизованным пользователем и пользуйтесь функцией по сохранению поиска.</p>
            </div>
            <div class="col-md-5 order-md-1 d-flex align-items-center justify-content-center">
                <picture class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto">
                    <source  srcset="{!!Storage::disk('public')->url('images/pages/feature_2_min.png')!!}" media="(max-width: 720px)">
                    <img width="100%"  src="{!!Storage::disk('public')->url('images/pages/feature_2.png')!!}" alt="info">
                </picture>
            </div>
        </div>

        <hr class="featurette-divider">

                <div class="row featurette text-center text-lg-start m-auto m-md-0">
                    <div class="col-md-7">
                        <h2 class="featurette-heading m-0">Авторизуйтесь.</h2>
                        <span class="featurette-heading text-muted">Сохраняйте поиски, чтобы посмотреть их в будущем.</span>
                        <p class="lead">Для сохраненных поисков доступен весь функционал.</p>
                    </div>
                    <div class="col-md-5">
                        <picture class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto">
                            <source  srcset="{!!Storage::disk('public')->url('images/pages/feature_3_min.png')!!}" media="(max-width: 720px)">
                            <img width="100%" height="100%" src="{!!Storage::disk('public')->url('images/pages/feature_3.png')!!}" alt="info">
                        </picture>
                    </div>
                </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

    </div>
@endsection
