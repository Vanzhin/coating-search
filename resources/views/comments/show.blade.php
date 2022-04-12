@extends('layouts.main')
@section('title')
    @parent Комментарий
@endsection
@section('content')
    <div class="position-relative overflow-hidden p-3 p-md-5 text-center bg-light">
        <div class="card w-100">
            <h5 class="card-header">{{$comment->id}}
            </h5>
            <div class="card-body">
                <h5 class="card-title">{{$comment->message}}</h5>
            </div>
        </div>
    </div>
@endsection
