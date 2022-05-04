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
    <div class="wrap container">
        <div class="scenes row">
            @if(count($products))
                @foreach($products as $product)
                    <div id="product-{{$product->id}}" class="track col-6 col-sm-3 p-0">
                        <div class="heading bg-secondary justify-content-between d-flex align-items-center px-1">
                            <a href="{{route('products.show', $product)}}" class="text-light text-decoration-none flex-fill text-center">
                                <h5 class="p-0 m-0">{{Str::upper($product->title)}}</h5>
                            </a>
                            <button id="del-{{$product->id}}"type="button" class="btn btn-close" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                    data-bs-product="{{$product->title}}"
                                    data-bs-id="{{$product->id}}">
                            </button>
                        </div>
                        @foreach($product->propertyToShow as $key => $value)
                            @if($key === 'title')
                                @continue
                            @endif
                                <div class="entry text-center">
                                    <h6>{!! $value !!}</h6>
                                    <h4>
                                        @if($product->$key)
                                            {{ $product->$key === true ? 'Да' : $product->$key }}
                                        @else
                                            Нет
                                        @endif
                                    </h4>
                                </div>
                        @endforeach
                        @foreach($linkedFields as $key => $value)
                            <div class="entry large text-center">
                                <h6>{!! $value !!}</h6>
                                <h4>
                                    @foreach($product->$key as $item)
                                        <span>{{Str::ucfirst($item->title) ?? 'нет'}}</span><br>
                                    @endforeach
                                </h4>
                            </div>
                        @endforeach
                    </div>
                @endforeach
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-message text-center"></div>
                </div>
                <div class="modal-footer">
                    <a id="close"  class="btn btn-secondary col" data-bs-dismiss="modal" hidden>ОК</a>
                    <a id="delete" href="javascript:;" class="btn btn-outline-danger col">Удалить</a>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
{{--todo функция comparedProductUpdate дублируется в compare-general.js, удалить дублирование--}}
            function comparedProductUpdate(total, badgesClassName, buttonsClassName)
            {
                const badges = document.querySelectorAll('.' + badgesClassName);
                const compare_btns = document.querySelectorAll('.' + buttonsClassName);
                if(total === 0){
                    badges.forEach(badge => badge.innerText = '');
                    compare_btns.forEach(compare_btn => compare_btn.classList.add('disabled'));

                } else if(total > 1) {
                    badges.forEach(badge => badge.innerText = total);
                    compare_btns.forEach(compare_btn => compare_btn.classList.remove('disabled'))
                } else{
                    badges.forEach(badge => badge.innerText = total);
                    compare_btns.forEach(compare_btn => compare_btn.classList.add('disabled'))
                }
            }
            const deleteModal = document.getElementById('deleteModal');
            const del = deleteModal.querySelector('#delete');
            const close = document.getElementById('close');
            deleteModal.addEventListener('show.bs.modal', function (event) {
                // Button that triggered the modal
                const button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                const prod_id = button.getAttribute('data-bs-id');

                // If necessary, you could initiate an AJAX request here
                // and then do the updating in a callback.
                //
                // Update the modal's content.
                close.setAttribute('hidden', true);
                del.removeAttribute('hidden');
                del.classList.remove('disabled');
                del.innerText = 'Удалить';
                const modalTitle = deleteModal.querySelector('.modal-message');
                const title = button.getAttribute('data-bs-product');
                modalTitle.textContent = 'Удалить из сравнения ' + title + '?'
                del.setAttribute('product-to-delete', prod_id)

            })
            const myModalEl = document.getElementById('delete')
            myModalEl.addEventListener('click', () => {
                const id = event.target.getAttribute('product-to-delete');
                event.target.classList.toggle('disabled')
                event.target.innerHTML= '<div class="spinner-border" role="status"></div>'
                const product = document.getElementById('product-' + id);
                sendCompare('/products/compare/' + id).then(() => {
                    const title = document.getElementById('del-' + id).getAttribute('data-bs-product');
                    close.removeAttribute('hidden');
                    product.remove();
                    myModalEl.setAttribute('hidden', true);

                    const modalTitle = document.querySelector('.modal-message');
                    modalTitle.textContent = 'Удалено: ' + title;
                    if(!document.querySelector('.track')){
                        document.querySelector('.scenes').innerHTML = '<h4 class="text-warning text-center">Список пуст</h4>';
                    }

                })
            })

            async function sendCompare(url){

                let response = await fetch(url, {
                    method: 'GET',
                });
                let result = await response.json();
                comparedProductUpdate(result.total, 'product-to-compare', 'compare-btn')

                return result.total;
            }
        </script>
    @endpush
    @else
        <h4 class="text-warning text-center">Список пуст</h4>
    @endif
@endsection


