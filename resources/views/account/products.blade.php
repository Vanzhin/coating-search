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

