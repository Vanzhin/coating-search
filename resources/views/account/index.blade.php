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
                    <a href="{{route('account.my')}}" class="btn btn-outline-secondary d-flex flex-nowrap align-items-center justify-content-around col-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
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
