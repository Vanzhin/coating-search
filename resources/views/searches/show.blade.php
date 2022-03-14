@extends('layouts.main')
@section('title')
    @parent Подбор покрытий
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">Подбор покрытий</h1>
    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <a href="{{ route('search.edit', ['search' => $search]) }}" class="btn btn-primary btn-lg">Обновить поиск</a>
            <a  href="#"class="btn btn-secondary btn-lg">Мои поиски</a>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                @forelse($products as $product)
                    <div class="card w-100">
                        <h5 class="card-header">{{$product->title}}</h5>
                        <div class="card-body">
                            <h5 class="card-title">{{Str::ucfirst($product->description)}}</h5>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">VS</th>
                                    <th scope="col">На отлип, ч</th>
                                    <th scope="col">Мин Т, &#176;C</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{$product->vs}}</td>
                                    <td>{{$product->dry_to_touch}}</td>
                                    <td>{{$product->min_temp}}</td>
                                </tr>
                                </tbody>
                            </table>
                            <a href="{{route('products.show', $product)}}" class="btn btn-primary">Подробнее</a>
                        </div>
                    </div>
                @empty
                    <h2>Записей нет</h2>
                @endforelse
            </div>
            {{ $products->onEachSide(0)->links() }}
        </div>
    </div>
@endsection




