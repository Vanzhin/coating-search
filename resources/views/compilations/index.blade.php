@extends('layouts.main')
@section('title')
    @parent Мои подборки покрытий
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">
            {{ $title ?? 'Мои подборки покрытий'}}
        </h1>
    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light min-vh-100 ">
        <div class="container d-flex flex-column rounded-2">
            @forelse($compilations as $compilation)
                <div id="{{$compilation->id}}" class="list-group m-1 mw-100">
                    <div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                        <a href="@if((!isset($user)) or ((Auth::user() ? Auth::user()->id : null) === $user->id))
                        {{ route('compilations.show', [$compilation]) }}
                        @else
                        {{ route('compilations.one', [$compilation, $user]) }}
                        @endif"
                           class="text-decoration-none text-reset d-flex gap-2 w-100 flex-column ">
                            <div>
                                <h4 class="mb-0">
                                    <span>{{Str::ucfirst($compilation->title ?? 'Без названия')}}</span>
                                    <span class="badge bg-secondary">{{ $compilation->products->count() }}</span>
                                </h4>
                                <p class="mb-0 opacity-75">{{ $compilation->description }}</p>
                            </div>
                            <small class="opacity-50 text-nowrap">{{$compilation->updated_at}}</small>
                        </a>
                        @if((!isset($user)) or ((Auth::user() ? Auth::user()->id : null) === $user->id))

                            <div class="d-flex align-items-center gap-3 fs-2">
                                @if($compilation->is_private)
                                    <span data-comp="{{ $compilation->id }}"
                                          title="Не доступна для других пользователей"
                                          class="text-secondary text-center align-bottom"
                                          onclick="PrivateHandle(this)">
                                        <i class="fa-solid fa-lock"></i>
                                    </span>
                                @else
                                    <span data-comp="{{ $compilation->id }}"
                                          title="Доступна для других пользователей"
                                          class="text-secondary text-center align-bottom"
                                          onclick="PrivateHandle(this)">
                                        <i class="fa-solid fa-lock-open"></i>
                                    </span>
                                @endif
                                <x-share :model="$compilation"></x-share>
                            </div>
                            <span class="btn btn-close" data-bs-toggle="modal"
                                  data-bs-target="#compilationDeleteModal"
                                  data-bs-item="{{$compilation->title ?? 'Без названия'}}"
                                  data-bs-id="{{$compilation->id}}"
                                  style="font-size: x-large">
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <h2>Записей нет</h2>
            @endforelse
            <div class="my-2">
                {{ $compilations->onEachSide(0)->links() }}
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="compilationDeleteModal" tabindex="-1" aria-labelledby="compilationDeleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="compilationDeleteModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-message"></div>
                </div>
                <div class="modal-footer">
                    <a id="delete" href="javascript:;" class="btn btn-outline-danger col">Удалить</a>
                    <button id="ok-button" class="btn btn-outline-primary col" data-bs-dismiss="modal" hidden>ОК
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        const CompilationDeleteModal = document.getElementById('compilationDeleteModal');
        CompilationDeleteModal.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            // возвращаю кнопку #delete в первоначальное состояние
            const myModalEl = document.getElementById('delete');
            myModalEl.removeAttribute('hidden');
            myModalEl.classList.remove('disabled');
            myModalEl.innerHTML = 'Удалить'
            //прячу кнопку #ok-button
            const okButton = document.getElementById('ok-button')
            okButton.setAttribute('hidden', true);

            const button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            const title = button.getAttribute('data-bs-item');
            const item_id = button.getAttribute('data-bs-id');


            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            const modalTitle = CompilationDeleteModal.querySelector('.modal-message');
            const item = CompilationDeleteModal.querySelector('#delete');

            modalTitle.textContent = 'Удалить подборку "' + title + '"?'
            item.setAttribute('item-to-delete', item_id)

        })
        const myModalEl = document.getElementById('delete');
        const modalMessage = document.querySelector('.modal-message');

        myModalEl.addEventListener('click', () => {
            const id = event.target.getAttribute('item-to-delete');
            const el = document.getElementById(id);
            const okButton = document.getElementById('ok-button')
            event.target.classList.toggle('disabled')
            event.target.innerHTML = '<div class="spinner-border" role="status"></div>'
            compilationSend('/compilations/' + id).then(() => {
                el.remove();
                myModalEl.setAttribute('hidden', true);
                okButton.removeAttribute('hidden');
                modalMessage.innerText = 'Подборка удалена';

            })
        })

        async function compilationSend(url) {

            let response = await fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content')
                }
            });
            let result = await response.json();
            return result.ok;
        }
    </script>
@endpush
@once
    @push('js')
        <script src="{{ asset('js/private-handle.js')}}"></script>
    @endpush
@endonce



