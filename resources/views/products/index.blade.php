@extends('layouts.main')
@section('title')
    @parent | Покрытия
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">Все покрытия</h1>

    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light min-vh-100">
        <div class="container">
{{--            @include('inc.message')--}}

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @forelse($products as $product)
                    <div class="col card-group">
                        <div class="card">
                            <h5 class="card-header d-flex flex-nowrap justify-content-between align-items-center">
                                <span>{{$product->title}}</span>
                                @if(Auth::check())
                                    <span like="{{$product->id}}" onclick="likeHandle(this)">
                                        @if(in_array($product->id, $likes))
                                            <i class="fa-star fa-solid"></i>
                                        @else
                                            <i class="fa-star fa-regular"></i>
                                        @endif
                                    </span>
                                @endif
                            </h5>

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
                    </div>
                @empty
                    <h2>Записей нет</h2>
                @endforelse
            </div>
            {{ $products->onEachSide(0)->links() }}
        </div>
    </div>
@endsection
@push('js')
    <script>function likeHandle(like) {
            const id = like.getAttribute('like');
            like.style.pointerEvents='none';
            like.firstElementChild.remove();
            like.innerHTML = '<i class="fa-regular fa-clock"></i>';
            send('/like/' + id).then((result) => {
                like.firstElementChild.remove();
                if(result === 'dislike'){
                    like.innerHTML = '<i class="fa-solid fa-star"></i>';

                } else{
                    like.innerHTML = '<i class="fa-regular fa-star"></i>';
                }
                like.style.pointerEvents='auto';
            })

        }
        async function send(url){

            let response = await fetch(url, {
                method: 'GET',
            });
            return await response.json();
        }
    </script>
@endpush

