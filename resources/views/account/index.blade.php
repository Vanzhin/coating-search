@extends('layouts.main')

@section('title')
    @parent | Профиль
@endsection
@section('content')
    <div class="container ">
        <div class="row">
            <div class="col-sm-5" >
                <img  src="@if(Auth::user()->avatar){!!Auth::user()->avatar!!}@else{!!Storage::disk('public')->url('images/users/default.png')!!}@endif" width="150" height="150" class="rounded-circle">

                <h2>{{Auth::user()->name}}</h2>
                <p>@if(Auth::user()->role){{ Auth::user()->role }}@else {{'Пользователь'}}@endif</p>
                <p>Последний раз заходили: {{Auth::user()->last_login_at}}</p>

                <p><a class="btn btn-secondary" href="#">View details »</a></p>
            </div>
            <div class="col-sm-7 d-flex flex-column">
                <div class="d-flex align-items-start">
                    <a href="{{route('search')}}" class="m-1 btn btn-outline-secondary d-flex flex-nowrap align-items-center justify-content-around col-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-chat-left-text-fill" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793V2zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z"/>
                        </svg>
                        <h4 class="fw-bold mb-0">Мои поиски</h4>
                    </a>
                    <div>
                        <p>Отображаются поиски, которые Вы производили</p>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <a class="btn btn-outline-secondary d-flex flex-nowrap align-items-center justify-content-around col-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                        </svg>
                        <h4 class="fw-bold mb-0">Мои материалы</h4>
                    </a>
                    <div>
                        <p>Отображаются материалы, которые вы отметили</p>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
