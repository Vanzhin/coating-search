@extends('layouts.main')
@section('title')
    @parent Подбор покрытий
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">Подбор покрытий</h1>

    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            @if(isset($method))
                <form method="post" action="{{ route('search.update', [$search]) }}">
                @method('put')
            @else
                <form method="post" action="{{ route('search.store') }}">
            @endif
                @csrf

                @include('inc.message')
                <div class="form-group row-cols-auto">

                    @foreach ($linkedFields as  $key => $item)
                    @error($key)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                <div class="card col">
                    <label for="{{$key}}"><h5 class="card-header">{{$item}}:</h5></label>
                    <select multiple name = "{{$key}}[]" id = "{{$key}}" class="form-control selectpicker"
                            data-live-search="true"
                            aria-label=".form-select-lg example"
                            title="Выберите {{$item}}"
                            >
                    @foreach($$key as $value)

                            @if(old($key))
                                <option value="{{$value->id}}" {{ in_array($value->id, old($key)) ? 'selected' : '' }}>{{Str::ucfirst($value->title)}}</option>
                            @elseif(isset($search) && array_key_exists($key, $dataSearch))
                                <option value="{{$value->id}}" {{ in_array($value->id, $dataSearch[$key]) ? 'selected' : '' }}>{{Str::ucfirst($value->title)}}</option>

                            @else
                                <option value="{{$value->id}}">{{Str::ucfirst($value->title)}}</option>

                            @endif
                        @endforeach
                    </select>
                </div>
                @endforeach
                    @foreach ($fields as  $key => $item)
                    @error($key)
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                    <div class="card col">
                        @if($key === 'brand_id')
                            <label for="{{ $key }}"><h5 class="card-header">{!! $item !!}:
                                </h5>
                            </label>
                            <select  multiple name = "{{$key}}[]" id="{{ $key }}"
                                     class="form-control selectpicker"
                                     aria-label=".form-select-lg example"
                                     title="Выберите {{$item}}"
                            >
                                @foreach($brands as $brand)
                                    @if(old($key))
                                        <option value="{{ $brand->id }}" {{ in_array($brand->id, old($key)) ? 'selected' : '' }}>{{Str::upper($brand->title)}}</option>
                                    @elseif(isset($search) && array_key_exists($key, $dataSearch))
                                        <option value="{{$brand->id}}" {{ in_array($brand->id, $dataSearch[$key]) ? 'selected' : '' }}>{{Str::upper($brand->title)}}</option>
                                    @else
                                        <option value="{{ $brand->id }}" >{{ Str::upper($brand->title) }}</option>
                                    @endif
                                @endforeach
                            </select>
                    </div>

                        @continue
                        @endif
                        @if($key === 'catalog_id')
                            <label for="{{ $key }}"><h5 class="card-header">{!! $item !!}:</h5>
                            </label>
                            <select multiple name = "{{$key}}[]" id="{{ $key }}"
                                    class="form-control selectpicker"
                                    aria-label=".form-select-lg example"
                                    title="Выберите {{$item}}">
                                @foreach($catalogs as $catalog)
                                    @if(old($key))
                                        <option value="{{ $catalog->id }}" {{ in_array($catalog->id, old($key)) ? 'selected' : '' }}>{{Str::ucfirst($catalog->title)}}</option>
                                    @elseif(isset($search) && array_key_exists($key, $dataSearch))
                                        <option value="{{$catalog->id}}" {{ in_array($catalog->id, $dataSearch[$key]) ? 'selected' : '' }}>{{Str::ucfirst($catalog->title)}}</option>
                                    @else
                                        <option value="{{ $catalog->id }}">{{Str::ucfirst($catalog->title)}}</option>
                                    @endif
                                @endforeach
                            </select>
                    </div>
                        @continue
                        @endif
                        @if($key === 'tolerance')
                            <label for="{{ $key }}"><h5 class="card-header">{!! $item !!}:</h5></label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="{{$key}}" name="{{$key}}" @if(isset($search) && array_key_exists($key, $dataSearch) or old($key)) checked @endif>
                                </div>
                    </div>
                            @continue
                        @endif
                        @if($key === 'title')
                            <label for="{{ $key }}">
                                <h5 class="card-header">{!! $item !!}:</h5>
                            </label>
                            <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" value="@if(isset($search) && array_key_exists($key, $dataSearch)){{$dataSearch[$key]}}@else{{old($key)}}@endif">
                            @continue
                        @endif
                        <label for="{{ $key }}">
                            <h5 class="card-header">{!! $item !!}:

                                <span id="rangeval-{{$key}}"><strong>@if(isset($search) && array_key_exists($key, $dataSearch)){{$dataSearch[$key]}} @else не выбрано @endif</strong></span>
                                <span>(от {{$selectionData[$key]['min']}} до {{$selectionData[$key]['max']}})</span>
                            </h5>
                        </label>
                        <input value="@if(isset($search) && array_key_exists($key, $dataSearch)){{$dataSearch[$key]}} @else{{$selectionData[$key]['min']-1}}@endif" name="{{ $key }}" type="range" class="form-range form-control" id="{{ $key }}" onInput="$('#rangeval-{{$key}}').html($(this).val())"
                               min="{{$selectionData[$key]['min']-1}}" max="{{$selectionData[$key]['max']}}" step="1">
                    </div>
                @endforeach
                </div>
    <button type="submit"  class="btn btn-success">{{$button}}</button>

    </form>
    </div>
</div>
@endsection


