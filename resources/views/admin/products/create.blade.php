@extends('layouts.admin')
@section('title')
    Добавление материала @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавление материала</h1>

    </div>
@endsection
@section('content')

    <form method="post" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
    @csrf
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
                            <option value="{{ $brand->title }}">{{ Str::upper($brand->title) }}</option>
                        @endforeach
                    </select>
                    @continue
                @endif
                @if($key === 'catalog_id')
                    <select name="{{ $key }}" id="{{ $key }}" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        @foreach($catalogs as $catalog)
                            <option value="{{ $catalog->title }}">{{ $catalog->title }}</option>
                        @endforeach
                    </select>
                    @continue
                @endif
                @if($key === 'description')
                    <textarea rows="3" cols="5" class="form-control" id="{{ $key }}" name="{{ $key }}" >{{old($key)}}</textarea>
                    @continue
                @endif
                @if($key === 'tolerance')
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="{{$key}}">
                    </div>
                    @continue
                @endif
                <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{old($key)}}">
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
                        @foreach($$key as $item)
                            <option value="{{$item->id}}">{{Str::ucfirst($item->title)}}</option>
                        @endforeach
                    </select>
                @endforeach

        </div>
        <button type="submit"  class="btn btn-success">Добавить</button>
    </form>
@endsection

