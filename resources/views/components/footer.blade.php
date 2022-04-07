<header class="p-3 bg-dark text-white">
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-2">
            <p class="col-md-4 mb-0 text-muted">© {{date('Y')}} {{env('APP_NAME')}}</p>

            <ul class="nav col-md-4 justify-content-end">
                <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link px-2 text-muted">Покрытия</a></li>
                <li class="nav-item"><a href="{{ route('search') }}" class="nav-link px-2 text-muted">Подбор</a></li>
{{--                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted disabled">Вопросы</a></li>--}}

                <li class="nav-item">
                    <span class="btn nav-link px-2 text-muted" data-bs-toggle="modal" data-bs-target="#modalMessage"
                          data-bs-name="{{ Auth::user()->name ?? null}}"
                          data-bs-email="{{ Auth::user()->email ?? null}}"

                    >Напишите нам</span>
                </li>
            </ul>
        </footer>
    </div>
{{--    modal--}}
    <div class="modal fade" id="modalMessage" tabindex="-1" aria-labelledby="modalMessageLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-secondary" id="modalMessageLabel">Новое сообщение</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-2 text-secondary needs-validation">
                        <div class="col-md-4">
                            <label for="validationCustomName" class="form-label">Ваше имя</label>
                            <input type="text" class="form-control" id="validationCustomName" name="name" oninput="textValidate(50)">
                            <div class="valid-feedback">
                                Отлично!
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustomEmail" class="form-label">Ваша почта</label>
                            <input type="email" class="form-control" id="validationCustomEmail" name="email" required>
                            <div class="valid-feedback">
                                Отлично!
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="validationCustom03" class="form-label">Сообщение</label>
                            <textarea class="form-control" id="validationCustom03" required
                                      style="resize: none;"
                                      name="message" rows="6"
                                      name="message"
                            ></textarea>
                            <div class="invalid-feedback">
                                Пожалуйста, напишите сообщение
                            </div>
                        </div>
                        <div class="col-12">
                            <p  class="btn btn-primary">
                                Отправить
                                <i class="fa-regular fa-paper-plane"></i>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</header>

@push('js')
    <script>

        let modalMessage = document.getElementById('modalMessage');
        modalMessage.addEventListener('show.bs.modal', function (event) {
            // Button that triggered the modal
            let button = event.relatedTarget;
            // Extract info from data-bs-* attributes
            let senderName = button.getAttribute('data-bs-name')
            let senderEmail = button.getAttribute('data-bs-email')

            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            let modalName = modalMessage.querySelector('#validationCustomName')
            let modalEmail = modalMessage.querySelector('#validationCustomEmail')

            modalName.value = senderName;
            modalEmail.value = senderEmail;
        });
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            let forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('click', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })();

        function sendMessage() {
            let senderId = button.getAttribute('data-bs-id');
            let senderName = button.getAttribute('data-bs-name');
            let senderEmail = button.getAttribute('data-bs-email');
            console.log(senderId,senderName, senderEmail)
            // const input = content.value;
            // const products = document.getElementById('products');
            // products.innerHTML = '<div class="spinner-border" role="status"></div>';
            // if (input){
            //     send('/search/quick/' + input).then((result) => {
            //         let links ='';
            //         result.forEach(function(item, i) {
            //             links = links + '<a href="http://coating-search.test/products/' + item.id + '\"' + ' class="btn btn-outline-secondary col-12 col-md-4">' + item.title + '</a>';
            //         })
            //         if(links){
            //             products.innerHTML = links;
            //         }else {
            //             products.innerHTML = '<p class="col" >Кажется, ничего не найдено ;(</p>' + '<a href="http://coating-search.test/search/create" class="btn col-12 btn-secondary btn-lg mb-4">Начать поиск по параметрам</a>';
            //         }
            //     });
            // } else {
            //     products.innerHTML = '<p class="col">Похоже, задан пустой запрос</p>' + '<a href="http://coating-search.test/search/create" class="btn col-12 btn-secondary btn-lg mb-4">Начать поиск по параметрам</a>';
            // }
        }
        // async function send(url){
        //
        //     let response = await fetch(url, {
        //         method: 'POST',
        //         headers: {
        //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
        //                 .getAttribute('content')
        //         }
        //     });
        //     return await response.json();
        // }
    </script>
@endpush
