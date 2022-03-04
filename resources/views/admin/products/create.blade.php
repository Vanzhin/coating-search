@extends('layouts.admin')
@section('title')
    Добавление новости @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Добавление новости</h1>

    </div>
@endsection
@section('content')

    <form method="post" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            @foreach ($newsFields as  $key => $item)
                @error($key)
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                <label for="{{ $key }}"><p>Поле для : {{ $item }}</p></label>
            @if($key === 'status')
                    <select name="status" id="status" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        <option value="draft" selected>draft</option>
                        <option value="active">active</option>
                        <option value="blocked">blocked</option>
                    </select>
                    @continue
                @endif
                @if($key === 'description')
                    <textarea rows="3" cols="5" class="form-control" id="{{ $key }}" name="{{ $key }}" >{{old($key)}}</textarea>
                    @continue
                @endif
                @if($key === 'image')
                    <div class="input-group">
                        <input type="file" class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{old($key)}}" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    </div>
                    @continue
                @endif
                <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" value="{{old($key)}}">
            @endforeach
                @error('categories')
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ $message }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @enderror
                <label for="categories"><p>Выбрать категорию(и)</p></label>
                <select multiple name = "categories[]" id = "categories" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>

        </div>
        <button type="submit"  class="btn btn-success">Добавить</button>
    </form>
@endsection

