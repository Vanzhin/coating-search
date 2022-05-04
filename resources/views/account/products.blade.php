@extends('layouts.main')
@section('title')
    @parent Мои покрытия
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">Мои покрытия</h1>
    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light min-vh-100">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @forelse($products as $product)
                    <x-products.card :product="$product" :likes="$likes" :compareProduct="$compareProduct"/>

                @empty
                    <h2 class="text-center w-100 vh-100">Записей нет</h2>
                @endforelse
            </div>
            {{ $products->onEachSide(0)->links() }}
        </div>
    </div>
@endsection


