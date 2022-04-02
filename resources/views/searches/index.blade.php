@extends('layouts.main')
@section('title')
    @parent | Подбор покрытий
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">Подбор покрытий</h1>
    </section>
@endsection
@section('content')
    <div class="container album py-5 bg-light">
        <div class="d-flex flex-column">
            <a href="{{ route('search.create') }}" class="btn btn-primary btn-lg mb-4">Начать поиск</a>
            @if(Auth::user())
                @forelse($searches as $search)
                    <div class="list-group m-1 mw-100">
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                            <div class="d-flex gap-2 w-100 justify-content-between">
                                <div>
                                    <h6 class="mb-0">{{$search->title ?? 'Без названия'}}</h6>
                                    <p class="mb-0 opacity-75">{{ $search->description }}</p>
                                </div>
                                <small class="opacity-50 text-nowrap">{{$search->updated_at}}</small>
                                <img src="https://github.com/twbs.png" alt="twbs" width="32" height="32" class="rounded-circle flex-shrink-0">
                            </div>
                        </a>
                    </div>
                @empty
                    <h2>Записей нет</h2>
                @endforelse
            @endif
        </div>
        {{ $searches->onEachSide(0)->links() }}
    </div>
@endsection



