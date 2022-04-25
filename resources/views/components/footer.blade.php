<header class="p-1 bg-dark text-white">
    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-1 my-1">
            <p class="col-md-4 mb-0 text-muted">© {{date('Y')}} {{env('APP_NAME')}}</p>
            <ul class="nav col-5 col-md-7 justify-content-end d-flex flex-nowrap align-items-center">
                <li class="nav-item">
                    <a href="{{ route('products.index') }}" class="nav-link px-2 text-muted d-flex justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-layers-fill" viewBox="0 0 16 16">
                            <path d="M7.765 1.559a.5.5 0 0 1 .47 0l7.5 4a.5.5 0 0 1 0 .882l-7.5 4a.5.5 0 0 1-.47 0l-7.5-4a.5.5 0 0 1 0-.882l7.5-4z"/>
                            <path d="m2.125 8.567-1.86.992a.5.5 0 0 0 0 .882l7.5 4a.5.5 0 0 0 .47 0l7.5-4a.5.5 0 0 0 0-.882l-1.86-.992-5.17 2.756a1.5 1.5 0 0 1-1.41 0l-5.17-2.756z"/>
                        </svg>
                        <span class="d-none d-md-inline-flex m-1">
                            Покрытия
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('search') }}" class="nav-link px-2 text-muted d-flex justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-list-nested" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4.5 11.5A.5.5 0 0 1 5 11h10a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zm-2-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm-2-4A.5.5 0 0 1 1 3h10a.5.5 0 0 1 0 1H1a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        <span class="d-none d-md-inline-flex m-1">
                            Подбор
                        </span>
                    </a>
                </li>
{{--                <li class="nav-item"><a href="#" class="nav-link px-2 text-muted disabled">Вопросы</a></li>--}}
                <li class="nav-item">
                    <a href="{{ route('comment.create') }}" class="nav-link px-2 text-muted d-flex justify-content-center align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                        </svg>
                        <span class="d-none d-md-inline-flex m-1">
                            Напишите нам
                        </span>
                    </a>
                </li>

{{--                <li class="nav-item">--}}
{{--                    <span class="btn nav-link px-2 text-muted" data-bs-toggle="modal" data-bs-target="#modalMessage"--}}
{{--                          data-bs-name="{{ Auth::user()->name ?? null}}"--}}
{{--                          data-bs-email="{{ Auth::user()->email ?? null}}"--}}

{{--                    >Напишите нам</span>--}}
{{--                </li>--}}
            </ul>
        </footer>
    </div>
{{--    modal--}}
{{--    <div class="modal fade" id="modalMessage" tabindex="-1" aria-labelledby="modalMessageLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog modal-fullscreen">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title text-secondary" id="modalMessageLabel">Новое сообщение</h5>--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form  class="row g-2 text-secondary needs-validation" id="message-form">--}}
{{--                        @csrf--}}
{{--                        <div class="col-md-4">--}}
{{--                            <label for="validationCustomName" class="form-label">Ваше имя</label>--}}
{{--                            <input type="text" class="form-control" id="validationCustomName" name="sender_name"--}}
{{--                                   required--}}
{{--                                   minlength="6"--}}
{{--                                   maxlength="50"--}}
{{--                                   oninput="validate()"--}}
{{--                            >--}}
{{--                            <div class="valid-feedback">--}}
{{--                                Отлично!--}}
{{--                            </div>--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Пожалуйста, укажите свое имя--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-4">--}}
{{--                            <label for="validationCustomEmail" class="form-label">Ваша почта</label>--}}
{{--                            <input type="email" class="form-control" id="validationCustomEmail" name="sender_email" required--}}
{{--                                   oninput="validate()"--}}
{{--                            >--}}
{{--                            <div class="valid-feedback">--}}
{{--                                Отлично!--}}
{{--                            </div>--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Пожалуйста, укажите свою почту--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-12">--}}
{{--                            <label for="validationCustomMessage" class="form-label">Сообщение</label>--}}
{{--                            <textarea class="form-control" id="validationCustomMessage" required--}}
{{--                                      style="resize: none;"--}}
{{--                                      name="message" rows="6"--}}
{{--                                      name="message"--}}
{{--                                      oninput="validate()"--}}
{{--                                      minlength="10" maxlength="500"--}}
{{--                            ></textarea>--}}
{{--                            <div class="valid-feedback">--}}
{{--                                Отлично!--}}
{{--                            </div>--}}
{{--                            <div class="invalid-feedback">--}}
{{--                                Пожалуйста, напишите сообщение--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-12">--}}
{{--                            <button type="submit" class="btn btn-primary disabled" id="send-button">--}}
{{--                                Отправить--}}
{{--                                <i class="fa-regular fa-paper-plane"></i>--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    </div>--}}
</header>

{{--@push('js')--}}
{{--    <script>--}}

{{--        let email = document.getElementById('validationCustomEmail');--}}
{{--        let name = document.getElementById('validationCustomName');--}}
{{--        let message = document.getElementById('validationCustomMessage');--}}
{{--        const sendButton = document.getElementById('send-button');--}}
{{--        function validate() {--}}
{{--            if ((name.value.length >= 6 && name.value.length <= 200)--}}
{{--            && (email.value.match(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/))--}}
{{--            && (message.value.length >= 10 && message.value.length <= 500)){--}}
{{--                sendButton.classList.remove('disabled');--}}
{{--            } else {--}}
{{--                sendButton.classList.add('disabled');--}}
{{--            }--}}
{{--        }--}}

{{--        let modalMessage = document.getElementById('modalMessage');--}}
{{--        modalMessage.addEventListener('show.bs.modal', function (event) {--}}
{{--            // Button that triggered the modal--}}
{{--            let button = event.relatedTarget;--}}
{{--            // Extract info from data-bs-* attributes--}}
{{--            let senderName = button.getAttribute('data-bs-name')--}}
{{--            let senderEmail = button.getAttribute('data-bs-email')--}}

{{--            // If necessary, you could initiate an AJAX request here--}}
{{--            // and then do the updating in a callback.--}}
{{--            //--}}
{{--            // Update the modal's content.--}}
{{--            let modalName = modalMessage.querySelector('#validationCustomName')--}}
{{--            let modalEmail = modalMessage.querySelector('#validationCustomEmail')--}}

{{--            modalName.value = senderName;--}}
{{--            modalEmail.value = senderEmail;--}}
{{--        });--}}
{{--        // Example starter JavaScript for disabling form submissions if there are invalid fields--}}
{{--        (function () {--}}
{{--            'use strict'--}}

{{--            // Fetch all the forms we want to apply custom Bootstrap validation styles to--}}
{{--            let forms = document.querySelectorAll('.needs-validation')--}}

{{--            // Loop over them and prevent submission--}}
{{--            Array.prototype.slice.call(forms)--}}
{{--                .forEach(function (form) {--}}
{{--                    form.addEventListener('click', function (event) {--}}
{{--                        if (!form.checkValidity()) {--}}
{{--                            event.preventDefault()--}}
{{--                            event.stopPropagation()--}}
{{--                        }--}}

{{--                        form.classList.add('was-validated')--}}
{{--                    }, false)--}}
{{--                })--}}
{{--        })();--}}

{{--        function sendMessage() {--}}
{{--            sendButton.innerHTML = '<div class="spinner-border" role="status"></div>';--}}
{{--            const comment = [];--}}
{{--            comment['sender_email'] = email.value;--}}
{{--            comment['sender_name'] = name.value;--}}
{{--            comment['message'] = message.value;--}}
{{--            send('/comment/quick/').then((result) => {--}}
{{--                    console.log(result)--}}
{{--                });--}}

{{--        }--}}
{{--        async function send(url){--}}
{{--            const comment = [];--}}
{{--            comment['sender_email'] = email.value;--}}
{{--            comment['sender_name'] = name.value;--}}
{{--            comment['message'] = message.value;--}}
{{--            console.log(comment, 'hello', )--}}
{{--            let user = {--}}
{{--                name: 'John',--}}
{{--                surname: 'Smith'--}}
{{--            };--}}

{{--            let response = await fetch(url, {--}}
{{--                method: 'PUT',--}}
{{--                headers: {--}}
{{--                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')--}}
{{--                        .getAttribute('content'),--}}
{{--                    'Content-Type': 'application/json; charset=utf-8'--}}
{{--                },--}}
{{--                body: JSON.stringify(user),--}}
{{--            });--}}
{{--            return await response.json();--}}
{{--        }--}}
{{--    </script>--}}
{{--@endpush--}}
