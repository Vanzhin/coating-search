@extends('layouts.main')
@section('title')
    @parent Подбор покрытий
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">Подбор покрытий</h1>
        @include('inc.message')
        <h3 class="fw-light">{!! $search->description!!}</h3>

    </section>
@endsection
@section('content')
        <div class="container">
            <div class="d-flex flex-wrap">
                <a href="{{ route('search.edit', ['search' => $search]) }}" class="btn btn-primary btn-">Обновить поиск</a>
                <a  href="#"class="btn btn-secondary btn-md">Мои поиски</a>
                <form class="form-control d-flex" method="post" action="{{ route('search.update', [$search]) }}">
                    @method('put')
                    @csrf
                    <div class="card col">
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

                    <button type="submit"  class="btn btn-success">Сортировать</button>

                </form>

            </div>

                <div class="accordion" id="accordionPanelsStayOpenExample">

                @forelse($products as $product)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse-{{ $product->id}}" aria-expanded="false" aria-controls="panelsStayOpen-collapse-{{ $product->id}}">
                                    <h5 class="header">{{$product->title}}</h5>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapse-{{ $product->id}}" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading-{{ $product->id}}">
                                <div class="accordion-body ">
                                    <h5 class="card-title">{{Str::ucfirst($product->description)}}
                                        <a class="badge bg-secondary" href="{{$product->pds}}">PDS</a>
                                    </h5>

                                    <div class="table-responsive">
                                        <table class="table table-sm w-auto">
                                            <thead class="table-light">
                                            <tr>
                                                @foreach($fields as $key => $value)
                                                    @if(in_array($key, ['title', 'description', 'pds']))
                                                        @continue
                                                    @else
                                                        <th scope="col"><span style="font-size: 14px;">{!! $value !!}</span></th>
                                                    @endif

                                                @endforeach
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
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
                                                        <td>{{$product->$key}}</td>
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
@endsection




