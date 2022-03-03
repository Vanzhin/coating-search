@extends('layouts.main')
@section('title')
    @parent Новости категории {{ $category->title }}
@endsection
@section('header')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Все новости категории &nbsp;{{ $category->title }}</h1>
            </div>
        </div>
    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @forelse($newsList as $news)
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-img" style="position: relative">
                                <img src="@if($news->image){{ Storage::disk('public')->url($news->image) }}@else{{ Storage::disk('public')->url('images/news/default.png') }}@endif" class="card-img-top" alt="{{ $news->title }}">
                                <strong>
                                    <p class="card-text " style="position: absolute; top: 50%;left: 15%;width: 80%; color: white; text-align: center; font-size: large">{{  $news->title }}</p>
                                </strong>

                            </div>                            <div class="card-body">
                                <p class="card-text">{!! $news->description !!}</p>
                                <p class="card-text"> Автор: {{ $news->author }}</p>
                                <p class="card-text"> Добавлено: {{ $news->created_at }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('news.show',['news' => $news->id]) }}" type="button" class="btn btn-sm btn-outline-secondary">Подробнее</a>
                                    </div>
                                    <small class="text-muted">9 mins</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h2>Записей нет</h2>
                @endforelse
            </div>
            {{ $newsList->onEachSide(0)->links() }}
        </div>
    </div>
@endsection

