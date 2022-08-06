@extends('layouts.main')

@section('title')
    @parent Подборка {{ $compilation->title ?? null }}
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">
            {{ Str::ucfirst($compilation->title ?? null) }}
            <span class="badge bg-secondary">{{ $compilation->products->count() }}</span>
            @if($compilation->is_private)
                <span data-comp="{{ $compilation->id }}" title="Не доступна для других пользователей"
                      class="text-secondary text-center align-bottom" onclick="PrivateHandle(this)">
                    <i class="fa-solid fa-lock"></i>
                </span>
            @else
                <span data-comp="{{ $compilation->id }}" title="Доступна для других пользователей"
                      class="text-secondary text-center align-bottom" onclick="PrivateHandle(this)">
                    <i class="fa-solid fa-lock-open"></i>
                </span>
            @endif
        </h1>
    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light min-vh-100">
        <div class="container">
            @include('inc.message')
            <h3 class="text-start bg-white rounded-2">{{ Str::ucfirst($compilation->description) }}</h3>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @forelse($compilation->products as $product)
                    <x-products.card :product="$product" :likes="$likes" :compilation="$compilation"/>
                @empty
                    <h2 class="text-center w-100">Записей нет</h2>
                @endforelse
            </div>
            {{--            <div class="mt-2">--}}
            {{--                {{ $compilation->products->onEachSide(0)->links() }}--}}
            {{--            </div>--}}
        </div>
    </div>
@endsection
@once
    @push('js')
        <script src="{{ asset('js/private-handle.js')}}"></script>
    @endpush
@endonce


