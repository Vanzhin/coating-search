@extends('layouts.main')
@section('title')
    @parent Результаты поиска покрытий
@endsection
@section('header')
{{--    если пользователь пытается просмотреть не свою запись, то выводу заглушку--}}
    @if(Auth::check() ? Auth::user()->getAuthIdentifier() : false === $search->user_id or $search->session_token === session()->get('_token'))
        <section class="text-center container my-3">
        <h1 class="fw-light d-flex justify-content-center align-items-center">
            <span>Результаты поиска покрытий</span>
            <span class="badge bg-secondary mx-3">{{ $productCount }}</span>
        </h1>
        @include('inc.message')
            <a class="btn btn-outline-secondary m-3" data-bs-toggle="collapse" href="#collapseTitle" role="button" aria-expanded="false" aria-controls="collapseTitle">
                Параметры поиска
            </a>
            <div class="collapse" id="collapseTitle">
                <div class="card card-body">
                    <h3 class="fw-light">{!! $search->description!!}</h3>
                </div>
            </div>
    </section>
@endsection
@section('content')
        <div class="container min-vh-100 mb-4">
            <div class="d-flex">
                <form class="form-control d-flex flex-wrap align-items-stretch" method="post" action="{{ route('search.update', [$search]) }}">
                    @method('put')
                    @csrf
                    <div class="card flex-fill">
                        <select  name = "order-by" id = "order-by" class="form-control selectpicker"
                                 data-live-search="true"
                                 aria-label=".form-select-lg example"
                                 title="Выберите параметр сортировки"
                        >
                            @foreach($fieldsToOrderBy as $key => $field)
                                <option value="{{$key}}@asc" @if(isset($searchData['order-by']) && $searchData['order-by'] === $key.'@asc') selected @endif>{{Str::ucfirst($field)}} - по возрастанию</option>
                                <option value="{{$key}}@desc" @if(isset($searchData['order-by']) && $searchData['order-by'] === $key.'@desc') selected @endif>{{Str::ucfirst($field)}} - по убыванию</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex flex-fill">
                        <button type="submit"  class="w-25 btn btn-success p-2 flex-fill mx-1 d-flex justify-content-evenly align-items-center">
                            <i class="fa-solid fa-arrow-down-short-wide"></i>
                            <span class="d-none d-md-inline-flex">Сортировать</span>
                        </button>
                        <a href="{{ route('search.edit', ['search' => $search]) }}" class="w-25 d-flex justify-content-evenly align-items-center btn btn-primary p-2 flex-fill">
                            <i class="fa-solid fa-arrow-rotate-left"></i>
                            <span class="d-none d-md-inline-flex">Обновить</span>
                        </a>
                        @if(Auth::user())
                            @if($search->status === 'saved')
                                <a href="{{route('search')}}" class="w-25 btn btn-info mx-1 d-flex justify-content-evenly align-items-center">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                    <span class="d-none d-md-inline-flex">Мои поиски</span>
                                </a>
                            @else
                                <a class="w-25 btn btn-info mx-1 d-flex justify-content-evenly align-items-center" data-bs-toggle="modal" data-bs-target="#saveSearchModal">
                                    <i class="fa-regular fa-floppy-disk"></i>
                                    <span class="d-none d-md-inline-flex">Сохранить</span>
                                </a>
                            @endif
                        @endif
                        <a  href="{{ route('products.compare') }}" id = "compare-btn" class="w-25 btn bg-secondary p-2 flex-fill @if(count($compareProduct) > 1){{''}}@else disabled @endif">
                            <i class="fa-solid fa-chart-simple"></i>
                            <span id = "product-to-compare" class="badge btn-warning">@if($compareProduct){{count($compareProduct)}}@else{{''}}@endif</span>
                            </a>
                    </div>
                </form>
            </div>

                <div class="accordion" id="accordionPanelsStayOpenExample">

                @forelse($products as $product)
                        <div class="accordion-item">
                            <h2 class="accordion-header d-flex align-items-stretch" id="panelsStayOpen-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse-{{ $product->id}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse-{{ $product->id}}">
                                    <h5 class="header">{{ Str::upper($product->title) }}</h5>
                                </button>
                                <a href="javascript:;" id="prod-{{$product->id}}" style="width: 20%;" class="d-flex justify-content-evenly align-items-center btn compare @if(isset($compareProduct) && in_array($product->id, $compareProduct)){{"add btn-secondary"}}@else {{"btn-warning"}}@endif" compare="{{$product->id}}">
                                    @if(isset($compareProduct) && in_array($product->id, $compareProduct))
                                        <i class="fa-solid fa-minus"></i>
                                        <span class="d-none d-md-inline-flex">Убрать из сравнения</span>
                                    @else
                                        <i class="fa-solid fa-plus"></i>
                                        <span class="d-none d-md-inline-flex">Добавить в сравнение</span>
                                    @endif
                                </a>

                            </h2>
                            <div id="panelsStayOpen-collapse-{{ $product->id}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading-{{ $product->id}}">
                                <div class="accordion-body ">
                                    <h5 class="card-title">{{Str::ucfirst($product->description)}}
                                        @if($product->pds)
                                            <a href="@if(str_starts_with($product->pds, 'http')){{$product->pds}}@else{{Storage::disk('public')->url($product->pds)}}@endif" class="badge bg-secondary">PDS</a>
                                        @endif
                                    </h5>
                                    <div class="table-responsive">
                                        <table class="table table-sm w-auto">
                                            <thead class="table-light">
                                            <tr class="align-middle">
                                                @foreach($fields as $key => $value)
                                                    @if(in_array($key, ['title', 'description', 'pds']))
                                                        @continue
                                                    @else
                                                        <th class="text-center" style="font-size: 14px;" scope="col">
                                                            {!! $value !!}
                                                        </th>
                                                    @endif

                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="align-middle text-center">
                                                @foreach($fields as $key => $value)
                                                    @if(in_array($key, ['title', 'description', 'pds']))
                                                        @continue
                                                    @elseif($key == 'brand_id')
                                                        <td>{{Str::upper($product->brand->title)}}</td>
                                                    @elseif($key == 'catalog_id')
                                                        <td>{{Str::ucfirst($product->catalog->title)}}</td>
                                                    @elseif(in_array($key, array_keys($linkedFields)))

                                                        <td>
                                                            @foreach($product->$key as $item)
                                                                <span>{{Str::ucfirst($item->title)}}</span>
                                                            @endforeach
                                                        </td>
                                                    @else
                                                        <td>@if($product->$key){{Str::ucfirst($product->$key)}}@else {{'нет'}} @endif</td>
                                                    @endif

                                                @endforeach
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </div>
                @empty
                    <h2>Ничего не найдено</h2>
                @endforelse
            {{ $products->onEachSide(0)->links() }}

        </div>
        <!-- Modal -->
        <div class="modal fade" id="saveSearchModal" tabindex="-1" aria-labelledby="saveSearchModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="saveSearchModalLabel">Сохранение поиска</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form class="was-validated" method="post" action="{{ route('search.update', [$search]) }}">
                        @method('put')
                        @csrf
                        <div class="modal-body">
                            <label for="search-title"><h6>Название поиска: </h6></label>
                            <input class="form-control" type="text"  id="validationText" placeholder="Необходимо указать название" required name="search_title" value="Поиск №{{$search->id}}">
                            <div class="invalid-feedback">
                                Пожалуйста, укажите название
                            </div>
                            <input class="form-control" type="text"  id="status" name="status" value="saved" hidden>
                        </div>
                        <div class="modal-footer">
                            <button  class="btn btn-outline-secondary" data-bs-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-outline-success">Сохранить поиск</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @else
        <div class="container text-center py-5">
            <h5>Запись не найдена</h5>
        </div>
    @endif
@endsection
@push('js')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            const buttons = document.querySelectorAll("a.compare");
            buttons.forEach(button => button.addEventListener("click", function() {
                button.classList.toggle("disabled");
                button.innerHTML = '<div class="spinner-border" role="status"></div>';
                const id = this.getAttribute('compare');
                sendProductToCompare('/products/compare/' + id).then(() => {
                    // location.reload();
                    button.classList.toggle("disabled");

                })
            }));
        });
        //todo убрать отсюда и перенести в основной код выше
async function sendProductToCompare(url){

    let response = await fetch(url, {
        method: 'GET',
    });
    let result = await response.json();
    const prod_id = result.product_id;
    const badge = document.getElementById('product-to-compare');
    const compare_btn = document.getElementById('compare-btn');
    const btn = document.getElementById('prod-'+ prod_id);
    btn.classList.toggle("add");

    if(result.total > 1){
        badge.innerText = result.total;
        compare_btn.classList.remove('disabled')
    } else if(result.total === 0){
        badge.innerText = '';
        compare_btn.classList.add('disabled')
    } else{
        badge.innerText = result.total;
        compare_btn.classList.add('disabled')
    }
    if(btn.classList.contains('add')){
        btn.innerHTML = '<i class="fa-solid fa-minus"></i><span class="d-none d-md-inline-flex">Убрать из сравнения</span>';

    } else {
        btn.innerHTML = '<i class="fa-solid fa-plus"></i><span class="d-none d-md-inline-flex">Добавить в сравнение</span>';
    }
    btn.classList.toggle('btn-warning');
    btn.classList.toggle('btn-secondary');
    return result.ok;
}

    </script>

@endpush


