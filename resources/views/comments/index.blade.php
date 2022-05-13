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
                <div class="list-group mw-100 w-100 my-2 gap-2">
                @forelse($comments as $comment)
                    <a href="{{ route('comment.show', $comment) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">{{ $comment->sender_name}} пишет</h5>
                            <small class="text-muted">{{ $comment->updated_at->format('d-m-Y') }}</small>
                        </div>
                        <p class="mb-1 overflow-hidden" style="white-space: nowrap; text-overflow: ellipsis;">{{ $comment->message }}</p>
                        <small class="text-muted">{{ $comment->target }}</small>
                    </a>
                @empty
                    <h2>Записей нет</h2>
                @endforelse
                </div>
            @else
                <h2 class="text-center">Комментариев нет</h2>
            @endif
            {{ $comments->onEachSide(0)->links() }}

        </div>
    </div>
@endsection



