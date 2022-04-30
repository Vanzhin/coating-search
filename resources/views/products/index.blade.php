@extends('layouts.main')
@section('title')
    @parent Покрытия {{$param ?? null}}
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">
            Все покрытия
            {{$param ?? null}}
        </h1>
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
                                <span>{{ Str::upper($product->title) }}</span>
                                @if(Auth::check())
                                    <span like="{{$product->id}}" onclick="likeHandle(this)">
                                        @if(in_array($product->id, $likes))
                                            <i class="fa-star fa-solid"></i>
                                        @else
                                            <i class="fa-star fa-regular"></i>
                                        @endif
                                    </span>
                                @endif

                                    <span id="{{$product->id}}" class="text compare">
                                        @if(isset($compareProduct) && in_array($product->id, $compareProduct))
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bar-chart-fill" viewBox="0 0 16 16">
                                                <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
                                                <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
                                            </svg>
                                        @endif
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
                    <h2>Записей нет</h2>
                @endforelse
            </div>
            <div class="mt-2">
                {{ $products->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('js/likeHandle.js')}}"></script>
    <script src="{{ asset('js/compare-general.js')}}"></script>

@endpush

