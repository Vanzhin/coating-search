@extends('layouts.main')
@section('title')
    @parent {{ $product->title }}
@endsection
@section('content')
{{--    @dd($binders[0])--}}
    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
        <div class="card w-100">
            <h5 class="card-header">{{$product->title}}
                <a href="{{ route('products.brand', $brand->title) }}" class="badge bg-secondary">{{Str::upper($brand->title)}}</a>
                <span class="badge bg-secondary">{{Str::ucfirst($catalog->title)}}</span>
                <a href="{{$product->pds}}" class="badge bg-secondary">PDS</a>


            </h5>
            <div class="card-body">
                <h5 class="card-title">{{Str::ucfirst($product->description)}}</h5>
                <table class="table table-striped">
                    <thead>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Основа</td>
                        <td>
                            @foreach($binders as $binder)
                                <span>{{Str::ucfirst($binder->title)}}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Среда применения</td>
                        <td>
                            @foreach($environments as $environment)
                                <a class="link" href="{{route('products.environment', $environment)}}">{{Str::ucfirst($environment->title)}}</a><br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Применяется в качестве</td>
                        <td>
                            @foreach($numbers as $number)
                                <span>{{Str::ucfirst($number->title)}}</span><br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Стойкость</td>
                        <td>
                            @foreach($resistances as $resistance)
                                <span>{{Str::ucfirst($resistance->title)}}</span><br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Подложка</td>
                        <td>
                            @foreach($substrates as $substrate)
                                <span>{{Str::ucfirst($substrate->title)}}</span><br>
                            @endforeach
                        </td>
                    </tr>
                    @foreach($product->propertyToShow as $key => $value)
                        @if(isset($product->$key))
                            <tr>
                                <td>{!! $value !!}</td>
                                <td>@if($product->$key){{Str::ucfirst($product->$key)}}@else {{'нет'}} @endif</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
@endsection
