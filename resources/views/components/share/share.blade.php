<div class="dropstart">
    <span title="Подборка" class="" data-bs-toggle="dropdown" data-bs-auto-close="outside"
          aria-expanded="false">
            <span data-comp="{{ $model->id }}"
                  title="Поделиться ..."
                  class="text-secondary text-center align-bottom mx-2">
                <i class="fa-solid fa-share-from-square"></i>
            </span>
    </span>
    <ul class="dropdown-menu-end dropdown-menu dropdown-menu-dark" style="min-width: fit-content">
        <li class="dropdown h3 text-center my-3 my-lg-0">
            <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown"
               aria-expanded="false" data-bs-auto-close="outside"><i class="fa-solid fa-at"></i></a>
            <form method="post" action="{{ route('compilations.store') }}"
                  class="dropdown-menu dropdown-menu-dark p-4 needs-validation"
                  enctype="multipart/form-data" style="width: max-content">
                @csrf
                <div class="mb-3">
                    <input name="product_id" type="number" class="form-control"
                           value="{{ $model->id }}" hidden>
                    <label for="validationEmail" class="form-label">Почта</label>
                    <div class="input-group">
                        <div class="input-group-text" id="btnGroupAddon">@</div>
                        <input id="validationEmail" name="email" type="email" class="form-control"
                               placeholder="Укажите email получателя" aria-label="Input group example"
                               aria-describedby="btnGroupAddon" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="compilationDescription" class="form-label">Комментарий</label>
                    <textarea name="comment" class="form-control" id="compilationDescription"
                              rows="5"
                              cols="25"
                              maxlength="300"
                              style="resize: none;"></textarea>
                </div>
                <button type="submit" class="btn btn-primary disabled">Отправить</button>
            </form>
        </li>
        <li><a class="dropdown-item h3 text-center" href="https://vk.com/share.php?url={{route('compilations.one', ['compilation' => $model, 'user' => Auth::user()])}}" target="_blank"><i class="fa-brands fa-vk"></i></a></li>
        <li><a class="dropdown-item h3 text-center" href="https://api.whatsapp.com/send?text={{route('compilations.one', ['compilation' => $model, 'user' => Auth::user()])}}"><i class="fa-brands fa-whatsapp"></i></a></li>
        <li><a class="dropdown-item h3 text-center" href="https://t.me/share/url?url={{route('compilations.one', ['compilation' => $model, 'user' => Auth::user()])}}&text="><i class="fa-brands fa-telegram"></i></a></li>
    </ul>
</div>

