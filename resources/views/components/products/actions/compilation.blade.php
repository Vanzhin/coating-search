<div class="dropdown">
    <span title="Подборка" class="" data-bs-toggle="dropdown" data-bs-auto-close="outside"
          aria-expanded="false">
        @if(Auth::user()->compiledProducts()->contains('id', $product->id))
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                 class="bi bi-clipboard2-check-fill" viewBox="0 0 16 16">
                <path
                    d="M10 .5a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5.5.5 0 0 1-.5.5.5.5 0 0 0-.5.5V2a.5.5 0 0 0 .5.5h5A.5.5 0 0 0 11 2v-.5a.5.5 0 0 0-.5-.5.5.5 0 0 1-.5-.5Z"/>
                <path
                    d="M4.085 1H3.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1h-.585c.055.156.085.325.085.5V2a1.5 1.5 0 0 1-1.5 1.5h-5A1.5 1.5 0 0 1 4 2v-.5c0-.175.03-.344.085-.5Zm6.769 6.854-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708.708Z"/>
            </svg>
        @else
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                 class="bi bi-clipboard2-check" viewBox="0 0 16 16">
                <path
                    d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
                <path
                    d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
                <path
                    d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3Z"/>
            </svg>
        @endif
    </span>
    <ul class="dropdown-menu dropdown-menu-dark">
        <li class="dropdown">
            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown"
               aria-expanded="false" data-bs-auto-close="outside">Добавить в новую ...</a>
            <form method="post" action="{{ route('compilations.store') }}"
                  class="dropdown-menu dropdown-menu-dark p-4 needs-validation"
                  enctype="multipart/form-data" style="width: max-content">
                @csrf
                <div class="mb-3">
                    <input name="product_id" type="number" class="form-control"
                           value="{{ $product->id }}" hidden>
                    <label for="validationCompilationTitle" class="form-label">Название</label>
                    <input name="title" type="text" class="form-control" id="validationCompilationTitle"
                           placeholder="Моя подборка"
                           required
                           minlength="5"
                           maxlength="50">
                </div>
                <div class="mb-3">
                    <label for="compilationDescription" class="form-label">Описание</label>
                    <textarea name="description" class="form-control" id="compilationDescription"
                              rows="5"
                              cols="25"
                              style="resize: none;"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </form>
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        @if(Auth::user()->compilations->diff($product->compilations->where('user_id', Auth::user()->id))->count() > 0)
            <li class="dropdown">
                <a class="dropdown-toggle dropdown-item" href="#" data-bs-toggle="dropdown"
                   aria-expanded="false">Добавить в ...</a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    {{--                                                    todo убрать повтор запросов к бд--}}
                    @foreach(Auth::user()->compilations as $comp)
                        @if($comp->products->contains('id', $product->id))
                            @continue
                        @endif
                        <li>
                            <a class="dropdown-item"
                               href="{{ route('compilations.add', ['product'=> $product, 'compilation' => $comp]) }}">{{ $comp->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            @if(request()->routeIs('compilations*'))
                <li class="dropdown">
                    <a class="dropdown-toggle dropdown-item" href="#" data-bs-toggle="dropdown"
                       aria-expanded="false">Переместить в ...</a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        @foreach(Auth::user()->compilations as $comp)
                            @if($comp->products->contains('id', $product->id))
                                @continue
                            @endif
                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('compilations.move', ['product'=> $product, 'compTo' => $comp, 'compFrom' => $compilation]) }}">{{ $comp->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @endif
        @if(request()->routeIs('compilations*'))
            @if((!isset($user)) or ((Auth::user() ? Auth::user()->id : null) === $user->id))
                <li class="dropdown">
                    <a class="dropdown-item"
                       href="{{ route('compilations.delete', ['product'=> $product, 'compilation' => $compilation]) }}">Удалить</a>
                </li>
            @endif
        @endif
    </ul>
</div>

