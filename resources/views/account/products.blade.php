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
    <div class="album py-5 bg-light">
        <div class="container vh-100">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @forelse($products as $product)
                    <div id="{{$product->id}}" class="col card-group">
                        <div class="card">
                            <h5 class="card-header d-flex flex-nowrap justify-content-between align-items-center">
                                <span>{{ Str::upper($product->title) }}</span>
                                    <span like="{{$product->id}}" onclick="likeRemove(this)">
                                        <i class="fa-xmark fa-solid fa-xl disabled"></i>
                                    </span>
                            </h5>
                            <div class="card-body d-flex flex-column flex-nowrap justify-content-between align-content-between">
                                <h5 class="card-title flex-fill">{{Str::ucfirst($product->description)}}</h5>
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
                    <h2 class="text-center w-100 vh-100">Записей нет</h2>
                @endforelse
            </div>
            {{ $products->onEachSide(0)->links() }}
        </div>
    </div>
@endsection
@push('js')
    <script>function likeRemove(like) {
            const id = like.getAttribute('like');
            const card = document.getElementById(id);
            console.log(card);
            card.style.pointerEvents='none';
            card.style.opacity='0.5';
            like.innerHTML = '<i class="fa-regular fa-clock"></i>';
            likeSend('/like/' + id).then((result) => {
                if(result === 'dislike'){
                    like.innerHTML = '<i class="fa-duotone fa-triangle-exclamation"></i>';
                } else{
                    card.remove();
                }
            })

        }
        async function likeSend(url){

            let response = await fetch(url, {
                method: 'GET',
            });
            return await response.json();
        }
    </script>
@endpush

