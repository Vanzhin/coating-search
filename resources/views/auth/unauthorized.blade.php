@extends('layouts.main')
@section('title')
    @parent Пользователь не авторизован
@endsection
@section('header')
@endsection
@section('content')
    <div class="container vh-100 d-flex justify-content-center">
        <div class="m-5 card text-center w-75" style="height: fit-content;">
            <div class="card-header">
                Ошибка авторизации
            </div>
            <div class="card-body h-50">
                <p class="card-text">
                    {{ Str::ucfirst($user->name) }}, Вы не авторизованы для этого действия.
                </p>
            </div>

        </div>
    </div>
@endsection



