@extends('layouts.main')

@section('title')
    @parent Подборка {{ $compilation->title ?? null }}
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light d-flex pt-3">
            <div class="flex-fill">
                {{ Str::ucfirst($compilation->title ?? null) }}
                <span class="badge bg-secondary">{{ $compilation->products->count() }}</span>

            </div>
            <div class="d-flex">
                <div class="ms-1">
                    @if($compilation->is_private)
                        <span data-comp="{{ $compilation->id }}" title="Не доступна для других пользователей"
                              class="text-secondary text-center align-bottom" onclick="PrivateHandle(this)">
                    <i class="fa-solid fa-lock"></i>
                </span>
                    @else
                        <span data-comp="{{ $compilation->id }}" title="Доступна для других пользователей"
                              class="text-secondary text-center align-bottom" onclick="PrivateHandle(this)">
                    <i class="fa-solid fa-lock-open"></i>
                </span>
                    @endif
                </div>
                <div class="ms-4 ms-lg-3">
                <span title="Редактировать" class="text-secondary" data-bs-toggle="modal"
                      data-bs-target="#compilationEditModal">
                    <i class="fa-solid fa-pen-to-square"></i>
                </span>
                </div>
            </div>
            <div class="modal fade" id="compilationEditModal" tabindex="-1" aria-labelledby="compilationEditModal"
                 aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header dropdown-menu-dark text-light">
                            <h5 class="modal-title" id="exampleModalEditLabel">Обновление подборки</h5>
                            <span type="button" class="btn-close h5 text-danger" data-bs-dismiss="modal"
                                  aria-label="Close"></span>
                        </div>
                        <div class="modal-body dropdown-menu-dark">
                            <form method="post" action="{{ route('compilations.update', $compilation) }}"
                                  class="p-4 needs-validation h6 text-secondary"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="mb-3 text-start">
                                    <label for="validationCompilTitle" class="form-label">Название</label>
                                    <input name="title" type="text" class="form-control" id="validationCompilTitle"
                                           value="{{ $compilation->title }}"
                                           placeholder="Моя подборка"
                                           required
                                           minlength="5"
                                           maxlength="50">
                                </div>
                                <div class="mb-3 text-start">
                                    <label for="compilDescription"
                                           class="form-label text-secondary text-start">Описание</label>
                                    <textarea name="description" class="form-control" id="compilDescription"
                                              rows="5"
                                              cols="25"
                                              style="resize: none;">
                                        {{$compilation->description}}
                                    </textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Обновить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </h1>
    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light min-vh-100">
        <div class="container">
            @include('inc.message')
            <h3 class="text-start bg-white rounded-2">{{ Str::ucfirst($compilation->description) }}</h3>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @forelse($compilation->products as $product)
                    <x-products.card :product="$product" :likes="$likes" :compilation="$compilation"/>
                @empty
                    <h2 class="text-center w-100">Записей нет</h2>
                @endforelse
            </div>
            {{--            <div class="mt-2">--}}
            {{--                {{ $compilation->products->onEachSide(0)->links() }}--}}
            {{--            </div>--}}
        </div>
    </div>
@endsection
@once
    @push('js')
        <script src="{{ asset('js/private-handle.js')}}"></script>
    @endpush
@endonce


