@extends('layouts.main')
@section('title')
    @parent Сравнение покрытий
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">Сравнение покрытий</h1>

    </section>
@endsection
@section('content')
    <div class="container-fluid overflow-auto">
        <div class="row flex-nowrap text-light">
            @foreach($products as $product)
            <div class="col bg-secondary" style="min-width: 50%;">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$product->title}}</h5>
                        </div>
            </div>
            @endforeach
        </div>
        @foreach($product->propertyToShow as $key => $value)
            @if($key === 'title')
                @continue
            @endif
            <div class="row">
                <h5 class="col card-title text-center">{!! $value !!}</h5>
            </div>
                <div class="row flex-nowrap">
                    @foreach($products as $product)
                        <div class="col bg-light" style="min-width: 50%;">
                            <div class="card-body">
                                    <h5 class="card-title text-center">{{$product->$key}}</h5>
                            </div>
                        </div>
                    @endforeach
                </div>

        @endforeach
        @foreach($linkedFields as $key => $value)
            <div class="row">
                <h5 class="col card-title text-center">{!! $value !!}</h5>
            </div>
            <div class="row flex-nowrap">
                @foreach($products as $product)
                    <div class="col bg-light" style="min-width: 50%;">
                            <div class="card-body ">
                                @foreach($product->$key as $item)
                                    <span>{{Str::ucfirst($item->title)}}</span><br>
                                @endforeach
                            </div>
                    </div>
                @endforeach

            </div>
        @endforeach
    </div>
@endsection


