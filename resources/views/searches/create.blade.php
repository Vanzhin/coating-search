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
    <div class="album py-5 bg-light container">
        <div class="mw-100">
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
                            @elseif(isset($search) && array_key_exists($key, $searchData))
                                <option value="{{$value->id}}" {{ in_array($value->id, $searchData[$key]) ? 'selected' : '' }}>{{Str::ucfirst($value->title)}}</option>

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
                                    @elseif(isset($search) && array_key_exists($key, $searchData))
                                        <option value="{{$brand->id}}" {{ in_array($brand->id, $searchData[$key]) ? 'selected' : '' }}>{{Str::upper($brand->title)}}</option>
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
                                    @elseif(isset($search) && array_key_exists($key, $searchData))
                                        <option value="{{$catalog->id}}" {{ in_array($catalog->id, $searchData[$key]) ? 'selected' : '' }}>{{Str::ucfirst($catalog->title)}}</option>
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
                                <div class="form-check form-switch ms-4 mb-2 mt-2">
                                    <input class="form-check-input form-control" type="checkbox" role="switch" id="{{$key}}" name="{{$key}}" @if(isset($search) && array_key_exists($key, $searchData) or old($key)) checked @endif>
                                </div>
                    </div>
                            @continue
                        @endif
                        @if($key === 'title')
                            <label for="{{ $key }}">
                                <h5 class="card-header">{!! $item !!}:</h5>
                            </label>
                            <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" value="@if(isset($search) && array_key_exists($key, $searchData)){{$searchData[$key]}}@else{{old($key)}}@endif">
                            @continue
                        @endif
                        <label for="{{ $key }}">
                            <h5 class="card-header">{!! $item !!}:

                                <span id="rangeval-{{$key}}"><strong>@if(isset($search) && array_key_exists($key, $searchData)){{$searchData[$key]}} @else не выбрано @endif</strong></span>
                                <span>(от {{$selectionData[$key]['min']}} до {{$selectionData[$key]['max']}})</span>
                            </h5>
                        </label>
                        <input value="@if(isset($search) && array_key_exists($key, $searchData)){{$searchData[$key]}} @else{{$selectionData[$key]['min']-1}}@endif" name="{{ $key }}" type="range" class="form-range form-control p-4" id="{{ $key }}" onInput="$('#rangeval-{{$key}}').html($(this).val())"
                               min="{{$selectionData[$key]['min']-1}}" max="{{$selectionData[$key]['max']}}" step="1">
                    </div>
                @endforeach
                </div>
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                    Сортировка
                </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                <div class="accordion-body">
                    <div class="card col">
                        <select  name = "order-by" id = "order-by" class="form-control selectpicker"
                                data-live-search="true"
                                aria-label=".form-select-lg example"
                                title="Выберите параметр сортировки"
                        >
                            @foreach($fieldsToOrderBy as $key => $field)
                                @if(isset($search))
                                    <option value="{{$key}}@asc" @if(isset($searchData['order-by']) && $searchData['order-by'] === $key.'@asc') selected @endif>{{Str::ucfirst($field)}} - по возрастанию</option>
                                    <option value="{{$key}}@desc" @if(isset($searchData['order-by']) && $searchData['order-by'] === $key.'@desc') selected @endif>{{Str::ucfirst($field)}} - по убыванию</option>
                                @else
                                    <option value="{{$key}}@asc">{{Str::ucfirst($field)}} - по возрастанию</option>
                                    <option value="{{$key}}@desc">{{Str::ucfirst($field)}} - по убыванию</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <button type="submit"  class="btn btn-success">{{$button}}</button>

        </form>
    </div>
</div>
@endsection


