@extends('layouts.admin')
@section('title')
    Поиски @parent
@endsection
@section('header')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Список поисков</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group me-2">
                <a href="{{ route('admin.searches.create') }}" class="btn btn-sm btn-secondary disabled">Добавить</a>
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
                        <th class="bg-light justify-content-center" scope="col">{!! Str::ucfirst($item) !!}</th>
                    @endforeach
                    <th class="bg-light align-content-center" scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($searches as $search)
                    <tr>
                        @foreach($fields as $key =>$item)
                            @if($key === 'user_id')
                                <td >{{Str::ucfirst($user->where('id', $search->$key)->value('name')) . ' (id: ' . $search->$key . ')'}}</td>
                                @continue
                            @endif
                            <td >{{Str::ucfirst($search->$key)}}</td>
                        @endforeach
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('admin.searches.edit',['search' => $search]) }}"  class="btn btn-warning disabled">Редактировать</a>
                                <form method="post" action="{{ route('admin.searches.destroy', ['search' => $search]) }}">
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
        {{$searches->links()}}
    </div>
@endsection
@push('js')
@endpush



