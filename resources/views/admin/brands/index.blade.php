@extends('layouts.admin')
@section('title')
    Производители @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список производителей</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.brands.create') }}" class="btn btn-sm btn-secondary">Добавить</a>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="table-responsive ">
        @include('inc.message')
        <table class="table table-bordered table-sm table-hover align-middle">
            <thead class="thead-light align-middle sticky-top">
            <tr>
                @foreach($fields as $item)
                    <th scope="col">{!! $item !!}</th>
                @endforeach
                    <th scope="col">Действия</th>

            </tr>
            </thead>
            <tbody>
            @forelse($brands as $brand)

                <tr>
                    @foreach($fields as $key =>$item)
                        <td >{{Str::ucfirst($brand->$key)}}</td>
                    @endforeach

                        <td>
                        <div class="d-flex">
                            <a href="{{ route('admin.brands.edit',['brand' => $brand]) }}"  class="btn btn-warning">Редактировать</a>
                            <form method="post" action="{{ route('admin.brands.destroy', ['brand' => $brand]) }}">
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
        {{$brands->onEachSide(2)->links()}}
    </div>
@endsection
