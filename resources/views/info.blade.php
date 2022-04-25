@extends('layouts.main')
@section('title')
    @parent В планах
@endsection
@section('header')
    <div class="container mt-3">
        <h2 class="text-center">В планах</h2>
    </div>
@endsection
@section('content')
    <div class="container-fluid vh-100">
        <ul class="list-group">
            <li class="list-group-item">Кастомизация создания запросов для зарегистрированных пользователей.</li>
            <li class="list-group-item">Возможность отправки на почту результатов поиска.</li>
            <li class="list-group-item">Получение статистики по запросам и материалам для зарегистрированных пользователей.</li>
            <li class="list-group-item">Возможность оставлять комментарии о материалах.</li>
            <li class="list-group-item">Пока все.</li>
        </ul>
    </div>
@endsection


