@extends('layouts.admin')
@section('title')
    Наполнители @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список наполнителей</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.additives.create') }}" class="btn btn-sm btn-secondary">Добавить</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="table-responsive table-container">
        @include('inc.message')
        <div class="table-horizontal-container">
            <table class="unfixed-table table table-sm table-hover align-middle table-borderless">
                <thead class="thead-light align-middle">
                <tr class="justify-content-center">
                    @foreach($fields as $item)
                        <th class="bg-light justify-content-center" scope="col">{!! $item !!}</th>
                    @endforeach
                    <th class="bg-light align-content-center" scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($additives as $additive)

                    <tr>
                        @foreach($fields as $key =>$item)
                            <td >{{Str::ucfirst($additive->$key)}}</td>
                        @endforeach

                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.additives.edit',['additive' => $additive]) }}"  class="btn btn-warning">Редактировать</a>
                                <form method="post" action="{{ route('admin.additives.destroy', ['additive' => $additive]) }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Удалить</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <p>Записей нет</p>
                @endforelse
                </tbody>
            </table>

        </div>
        {{$additives->links()}}
    </div>
@endsection
