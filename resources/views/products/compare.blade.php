@extends('layouts.main')
@section('title')
    @parent Сравнение покрытий
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">Сравнение покрытий</h1>

    </section>
@endsection
@section('content')
    <div class="container-fluid overflow-scroll" style="height: 80vh;">
        <div class="row flex-nowrap text-light sticky-top">
            @if(count($products))
                @foreach($products as $product)
                    <div class="col bg-secondary " style="min-width: 50%;">
                        <div class="card-body d-flex justify-content-around">
                            <h5 class="card-title text-center">{{$product->title}}</h5>
                            <button type="button" class="btn btn-close" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    data-bs-product="{{$product->title}}"
                                    data-bs-id="{{$product->id}}">
                            </button>
                        </div>
                    </div>
                @endforeach
        </div>
        @foreach($product->propertyToShow as $key => $value)
            @if($key === 'title')
                @continue
            @endif
            <div class="row">
                <h5 class="col card-title text-center">{!! $value !!}</h5>
            </div>
            <div class="row flex-nowrap">
                @foreach($products as $product)
                    <div class="col bg-light" style="min-width: 50%;">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{$product->$key}}</h5>
                        </div>
                    </div>
                @endforeach
            </div>

        @endforeach
        @foreach($linkedFields as $key => $value)
            <div class="row">
                <h5 class="col card-title text-center">{!! $value !!}</h5>
            </div>
            <div class="row flex-nowrap">
                @foreach($products as $product)
                    <div class="col bg-light" style="min-width: 50%;">
                        <div class="card-body ">
                            @foreach($product->$key as $item)
                                <span>{{Str::ucfirst($item->title)}}</span><br>
                            @endforeach
                        </div>
                    </div>
                @endforeach

            </div>
        @endforeach
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-message"></div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" data-bs-dismiss="modal">Отмена</a>
                    <a id="delete" href="javascript:;" class="btn btn-outline-danger">Удалить</a>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            const exampleModal = document.getElementById('exampleModal');
            exampleModal.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                const button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                const title = button.getAttribute('data-bs-product');
                const prod_id = button.getAttribute('data-bs-id');

                // If necessary, you could initiate an AJAX request here
                // and then do the updating in a callback.
                //
                // Update the modal's content.
                const modalTitle = exampleModal.querySelector('.modal-message');
                const del = exampleModal.querySelector('#delete');

                modalTitle.textContent = 'Удалить из сравнения ' + title + '?'
                del.setAttribute('product-to-delete', prod_id)

            })
            const myModalEl = document.getElementById('delete')
            myModalEl.addEventListener('click', () => {
                const id = event.target.getAttribute('product-to-delete');
                send('/products/compare/' + id).then(() => {
                    location.reload();

                })
            })

            async function send(url){

                let response = await fetch(url, {
                    method: 'GET',
                });
                let result = await response.json();
                return result.ok;
            }

        </script>
    @endpush

    @else
                <h4 class="text-warning text-center">Список пуст</h4>
            @endif
@endsection

