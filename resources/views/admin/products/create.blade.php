@extends('layouts.admin')
@section('title')
    {{ $title }} материала @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }} материала</h1>

    </div>
@endsection
@section('content')
    <form method="post" action="{{ route('admin.products.' . $method, [$param]) }}" enctype="multipart/form-data">
    @csrf
        @if($method == 'update')
            @method('put')
        @endif
        <div class="form-group">
            @foreach ($fields as  $key => $item)
                @error($key)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                <label for="{{ $key }}"><p>{!! $item !!}:</p></label>
            @if($key === 'brand_id')
                    <select name="{{ $key }}" id="{{ $key }}" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" @if(isset($product) && $product->brand->title === $brand->title) selected @endif>{{ Str::upper($brand->title) }}</option>
                        @endforeach
                    </select>
                    @continue
                @endif
                @if($key === 'catalog_id')
                    <select name="{{ $key }}" id="{{ $key }}" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        @foreach($catalogs as $catalog)
                            <option value="{{ $catalog->id }}" @if(isset($product) && $product->catalog->title === $catalog->title) selected @endif>{{ $catalog->title }}</option>
                        @endforeach
                    </select>
                    @continue
                @endif
                @if($key === 'description')
                    <textarea rows="3" cols="5" class="form-control" id="{{ $key }}" name="{{ $key }}">@if(isset($product)){{$product->$key}}@else{{old($key)}}@endif</textarea>
                    @continue
                @endif
                @if($key === 'tolerance')
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="{{$key}}" name="{{$key}}" @if(isset($product) && $product->tolerance === 1) checked @endif>
                    </div>
                    @continue
                @endif
                <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" value="@if(isset($product)){{$product->$key}}@else{{old($key)}}@endif">
            @endforeach
            @foreach ($linkedFields as  $key => $item)
                    @error($key)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                    <label for="{{$key}}"><p>{{$item}}:</p></label>
                    <select multiple name = "{{$key}}[]" id = "{{$key}}" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        @foreach($$key as $value)

                            <option @if(isset($product) && $product->$key->contains('title', $value->title)) selected @endif value="{{$value->id}}">{{Str::ucfirst($value->title)}}</option>
                        @endforeach
                    </select>
                @endforeach

        </div>
        <button type="submit"  class="btn btn-success">{{$button}}</button>
    </form>
@endsection

