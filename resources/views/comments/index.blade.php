@extends('layouts.main')
@section('title')
    @parent Комментарии
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">Мои комментарии</h1>
    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light min-vh-100 ">
        <div class="container d-flex flex-column rounded-2">
            @include('inc.message')
            @if(Auth::user())
                @forelse($comments as $comment)
                    <div id ="{{$comment->id}}" class="list-group m-1 mw-100">
                        <div  class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                            <p>{{$comment->message}}</p>
                        </div>
                    </div>
                @empty
                    <h2>Записей нет</h2>
                @endforelse
                    {{ $comments->onEachSide(0)->links() }}
            @else
                <h2 class="text-center">Комментариев нет</h2>
            @endif
        </div>
    </div>
@endsection



