@extends('layouts.main')
@section('title')
    @parent {{ Str::upper($product->title) }}
@endsection
@section('content')
    <div class="position-relative overflow-hidden p-3 p-md-5 text-center bg-light">
        <div class="card w-100">
            <h5 class="card-header d-flex justify-content-between align-items-center gap-2 text-secondary">
                <span class="flex-fill text-dark">{{ Str::upper($product->title) }}</span>
                @if($product->pds)
                    <a href="@if(str_starts_with($product->pds, 'http')){{$product->pds}}@else{{Storage::disk('public')->url($product->pds)}}@endif" class="text-secondary" target="_blank">
                        <i class="fa-solid fa-file-pdf"></i>
                    </a>
                @endif
                @auth
                   @if(Auth::user()->role === 'admin')
                       <a href="{{ route('admin.products.edit',['product' => $product]) }}" class="text-warning"><i class="fa-solid fa-gear"></i></a>
                    @endif
                    <span like="{{$product->id}}" onclick="likeHandle(this)">
                    @if(in_array($product->id, $likes))
                            <i class="fa-star fa-solid"></i>
                        @else
                            <i class="fa-star fa-regular"></i>
                        @endif
                </span>
                @endauth
                @if(isset($compareProduct) && in_array($product->id, $compareProduct))
                    <span id="{{$product->id}}" class="text compare add">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bar-chart-fill" viewBox="0 0 16 16">
                        <path d="M1 11a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3zm5-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1V2z"/>
                    </svg>
                </span>
                @else
                    <span id="{{$product->id}}" class="text compare">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bar-chart" viewBox="0 0 16 16">
                        <path d="M4 11H2v3h2v-3zm5-4H7v7h2V7zm5-5v12h-2V2h2zm-2-1a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-2zM6 7a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7zm-5 4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-3z"/>
                    </svg>
                </span>
                @endif
            </h5>
            <div class="card-body">
                <h5 class="card-title">{{Str::ucfirst($product->description)}}</h5>
                <table class="table table-striped align-items-center text-center">
                    <thead>
                    </thead>
                    <tbody>
                    <tr class="align-middle text-center">
                        <td> Бренд </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center flex-column gap-1">
                                <a class="link btn-sm btn-outline-secondary text-decoration-underline" href="{{ route('products.indexBySlug', ['param' => 'brand', 'value' => $brand->slug]) }}" title="Все покрытия {{Str::ucfirst($brand->title)}}">{{Str::upper($brand->title)}}</a>
                            </div>
                        </td>
                    </tr>

                    <tr class="align-middle text-center">
                        <td> Каталог </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center flex-column gap-1">
                                    <a class="link btn-sm btn-outline-secondary text-decoration-underline" href="{{ route('products.indexBySlug', ['param' => 'catalog', 'value' => $catalog->slug]) }}" title="Все покрытия {{Str::ucfirst($catalog->title)}}">{{Str::ucfirst($catalog->title)}}</a>
                            </div>

                        </td>
                    </tr>
                    @foreach($product->propertyToShow as $key => $value)
                        <tr class="align-middle text-center">
                            <td>{!! $value !!}</td>
                            <td>
                                <a class="link btn-sm btn-outline-secondary text-decoration-underline" href="{{ route('products.indexBySlug', ['param' => $key, 'value' => $product->$key ? $product->$key : 0]) }}" title="Все покрытия {{$key}} = {{ $value }}">@if($product->$key === true){{'Да'}}@elseif($product->$key or $product->$key === 0){{$product->$key}}@else {{'Нет'}} @endif</a>
                            </td>
                        </tr>
                    @endforeach

                    @foreach($product->getLinkedFields() as $key => $value)
                    <tr class="align-middle text-center">
                        <td>{!! $value !!}</td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center flex-column gap-1">
                                @foreach($product->$key as $param)
                                    <a class="link btn-sm btn-outline-secondary text-decoration-underline" href="{{ route('products.indexBySlug', ['param' => $key, 'value' => $param->slug]) }}" title="Все покрытия {{Str::ucfirst($param->title)}}">{{Str::ucfirst($param->title)}}</a>
                                @endforeach
                                @if(!count($product->$key))
                                    Нет
                                @endif
                            </div>

                        </td>
                    </tr>
                    @endforeach
{{--                    @dd($product->analogs())--}}
                    <tr class="align-middle text-center">
                        <td> Похожие материалы </td>
                        <td>
                            <div class="d-flex justify-content-center align-items-center flex-column gap-1">
                                @forelse($product->analogs() as $analog)
                                    @if($analog->title === $product->title)
                                        @continue
                                    @endif
                                    <a class="link btn-sm btn-outline-secondary text-decoration-underline" href="{{ route('products.show', $analog) }}" title="{{Str::upper($analog->title)}}">{{Str::upper($analog->title)}}</a>
                                @empty
                                    -
                                @endforelse
                            </div>

                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="col my-3 d-flex justify-content-center align-items-center">
                    <a href="{{ route('search.create', $product) }}" class="btn flex-fill flex-xl-grow-0 d-flex justify-content-center align-items-center btn-outline-success">Искать подобный материал</a>
                </div>

            </div>
        </div>
        <div class="product-device shadow-sm d-none d-md-block"></div>
        <div class="product-device product-device-2 shadow-sm d-none d-md-block"></div>
    </div>
@endsection
@once
    @push('js')
        <script src="{{ asset('js/likeHandle.js')}}"></script>
        <script src="{{ asset('js/compare-general.js')}}"></script>
    @endpush
@endonce
