@extends('layouts.main')
@section('title')
    @parent Покрытия {{$param ?? null}}
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">
            Все покрытия
            {!! $param ?? null !!}
        </h1>
    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light min-vh-100">
        <div class="container">
{{--            @include('inc.message')--}}
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @forelse($products as $product)
                    <x-products.card :product="$product" :likes="$likes" :compareProduct="$compareProduct"/>
                @empty
                    <h2>Записей нет</h2>
                @endforelse
            </div>
            <div class="mt-2">
                {{ $products->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection


