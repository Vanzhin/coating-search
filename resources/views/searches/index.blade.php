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
    <div class="album py-5 bg-light min-vh-100 ">
        <div class="container d-flex flex-column rounded-2">
            @if(session('searchId'))
                <a href="{{ route('search.edit', session('searchId')) }}" class="btn btn-primary btn-lg mb-4">Продолжить поиск</a>
            @else
                <a href="{{ route('search.create') }}" class="btn btn-primary btn-lg mb-4">Начать поиск</a>

            @endif

            @if(Auth::user())
                @forelse($searches as $search)
                    <div id="{{$search->id}}" class="list-group m-1 mw-100">
                        <div class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                            <a href="{{route('search.show', [$search])}}"
                               class="text-decoration-none text-reset d-flex gap-2 w-100 flex-column ">
                                <div>
                                    <h6 class="mb-0">{{$search->title ?? 'Без названия'}}</h6>
                                    <p class="mb-0 opacity-75">{{ $search->description }}</p>
                                </div>
                                <small class="opacity-50 text-nowrap">{{$search->updated_at}}</small>
                            </a>
                            <span class="btn btn-close" data-bs-toggle="modal" data-bs-target="#searchDeleteModal"
                                  data-bs-item="{{$search->title ?? 'Без названия'}}"
                                  data-bs-id="{{$search->id}}">
                            </span>
                        </div>
                    </div>
                @empty
                    <h2>Записей нет</h2>
                @endforelse
                <div class="my-2">
                    {{ $searches->onEachSide(0)->links() }}
                </div>
            @endif
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="searchDeleteModal" tabindex="-1" aria-labelledby="searchDeleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchDeleteModalLabel"></h5>
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
        const searchDeleteModal = document.getElementById('searchDeleteModal');
        searchDeleteModal.addEventListener('show.bs.modal', function (event) {
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
            const modalTitle = searchDeleteModal.querySelector('.modal-message');
            const item = searchDeleteModal.querySelector('#delete');

            modalTitle.textContent = 'Удалить поиск "' + title + '"?'
            item.setAttribute('item-to-delete', item_id)

        })
        const myModalEl = document.getElementById('delete');
        const modalMessage = document.querySelector('.modal-message');
        // console.log(modalMessage);
        //         modalMessage.innerText = 'Поиск удален';

        myModalEl.addEventListener('click', () => {
            const id = event.target.getAttribute('item-to-delete');
            const el = document.getElementById(id);
            const okButton = document.getElementById('ok-button')
            event.target.classList.toggle('disabled')
            event.target.innerHTML = '<div class="spinner-border" role="status"></div>'
            searchSend('/search/' + id).then(() => {
                el.remove();
                myModalEl.setAttribute('hidden', true);
                okButton.removeAttribute('hidden');
                modalMessage.innerText = 'Поиск удален';
                // location.reload();

            })
        })

        async function searchSend(url) {

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



