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
                    <select name="{{ $key }}" id="{{ $key }}" class="form-control selectpicker" data-live-search="true" aria-label=".form-select-lg example">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}" @if(isset($product) && $product->brand->title === $brand->title) selected @endif>{{ Str::upper($brand->title) }}</option>
                        @endforeach
                    </select>
                    @continue
                @endif
                @if($key === 'catalog_id')
                    <select name="{{ $key }}" id="{{ $key }}" class="form-control selectpicker" data-live-search="true" aria-label=".form-select-lg example">
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
                @if($key === 'pds')
                    <div class=" d-flex flex-column">
                        <input type="file" class="form-control" id="{{ $key }}-local" name="{{ $key }}-local" value="@if(isset($product)){{$product->$key}}@else{{old('pds-local')}}@endif" aria-label="Upload">
                        <p>или укажите ссылку:</p>
                        <input type="text" class="form-control" id="{{ $key }}-link" name="{{ $key }}-link" value="@if(isset($product) && str_starts_with($product->pds, !'http')){{$product->$key}}@else{{old('pds-link')}}@endif">
                    </div>
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
                        <select multiple name = "{{$key}}[]" id = "{{$key}}" class="form-control selectpicker" data-live-search="true" aria-label=".form-select-lg example">
                            @foreach($$key as $value)
                                @if(old($key))
                                    <option value="{{$value->id}}" {{ in_array($value->id, old($key)) ? 'selected' : '' }}>{{Str::ucfirst($value->title)}}</option>
                                @else
                                    <option @if(isset($product) && $product->$key->contains('title', $value->title)) selected @endif value="{{$value->id}}">{{Str::ucfirst($value->title)}}</option>

                                @endif
                            @endforeach
                        </select>

                @endforeach

        </div>
        <button type="submit"  class="btn btn-success">{{$button}}</button>
    </form>
@endsection


