@extends('layouts.admin')
@section('title')
    {{ $title }} среды эксплуатации @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }} среды эксплуатации</h1>

    </div>
@endsection
@section('content')
    <form method="post" action="{{ route('admin.environments.' . $method, [$param]) }}">
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
                <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" value="@if(isset($environment)){{$environment->$key}}@else{{old($key)}}@endif">
            @endforeach
        </div>
        <button type="submit"  class="btn btn-success">{{$button}}</button>
    </form>
@endsection

