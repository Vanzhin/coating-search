@extends('layouts.main')
@section('title')
    @parent Комментарий
@endsection
@section('content')
    <div class="position-relative overflow-hidden p-3 p-md-5 text-center bg-light vh-100">
        <div class="card w-100">
            <div class="card-header">
                {{$comment->id}}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{$comment->sender_name}} оставил(а) комментарий</h5>
                <p class="card-text">{{ $comment->message }}</p>
            </div>
            <div class="card-footer text-muted">
                {{ $comment->created_at }}
            </div>
        </div>
    </div>
@endsection
