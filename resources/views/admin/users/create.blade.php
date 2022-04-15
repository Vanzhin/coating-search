@extends('layouts.admin')
@section('title')
    {{ $title }} пользователя @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }} пользователя</h1>

    </div>
@endsection
@section('content')
    <form method="post" action="{{ route('admin.users.' . $method, [$param]) }}">
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
            @if($key === 'role')
                    <select name="{{ $key }}" id="{{ $key }}" class="form-control selectpicker" data-live-search="true" aria-label=".form-select-lg example">
                        <option value="user" @if(isset($user) && $user->role === 'user') selected @endif>{{ Str::upper('user') }}</option>
                        <option value="admin" @if(isset($user) && $user->role === 'admin') selected @endif>{{ Str::upper('admin') }}</option>
                    </select>
                    @continue
                @endif
                @if($key === 'status')
                    <select name="{{ $key }}" id="{{ $key }}" class="form-control selectpicker" data-live-search="true" aria-label=".form-select-lg example">
                        @foreach($statuses as $status)
                            <option value="{{ $status }}" @if(isset($user) && $user->status === $status) selected @endif>{{ Str::upper($status) }}</option>
                        @endforeach
                        </select>
                    @continue
                @endif
                <input type="text" class="form-control" id="{{ $key }}" name="{{ $key }}" value="@if(isset($user)){{$user->$key}}@else{{old($key)}}@endif">
            @endforeach
        </div>
        <button type="submit"  class="btn btn-success">{{$button}}</button>
    </form>
@endsection


