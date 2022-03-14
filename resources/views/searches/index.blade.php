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
            <a href="{{ route('search.create') }}" class="btn btn-primary btn-lg">Начать поиск</a>
            <a  href="#"class="btn btn-secondary btn-lg">Мои поиски</a>
    </div>
    </div>
@endsection



