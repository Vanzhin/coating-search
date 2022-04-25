@extends('layouts.main')
@section('title')
    @parent Форма обратной связи
@endsection
@section('header')
    <section class="text-center container">
        <h1 class="fw-light">Обратная связь</h1>

    </section>
@endsection
@section('content')
    <div class="album py-5 bg-light">
        <div class="modal-body">
            <form method="post" action="{{route('comment.store')}}" class="row g-2 text-secondary needs-validation" id="message-form" onsubmit="buttonDisable()">
                @csrf
                <div class="col-md-4">
                    @error('sender_name')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                    <label for="validationCustomName" class="form-label">Ваше имя</label>
                    <input type="text" class="form-control" id="validationCustomName" name="sender_name"
                           required
                           minlength="6"
                           maxlength="50"
                    >
                    <div class="valid-feedback">
                        Отлично!
                    </div>
                    <div class="invalid-feedback">
                        Пожалуйста, укажите свое имя
                    </div>
                </div>
                <div class="col-md-4">
                    @error('sender_name')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                    <label for="validationCustomEmail" class="form-label">Ваша почта</label>
                    <input type="email" class="form-control" id="validationCustomEmail" name="sender_email"
                           required
                    >
                    <div class="valid-feedback">
                        Отлично!
                    </div>
                    <div class="invalid-feedback">
                        Пожалуйста, укажите свою почту
                    </div>
                </div>
                <div class="col-12">
                    @error('message')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ $message }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @enderror
                    <label for="validationCustomMessage" class="form-label">Сообщение</label>
                    <textarea class="form-control" id="validationCustomMessage" required
                              style="resize: none;"
                              name="message" rows="6"
                              name="message"
                              minlength="10" maxlength="500"
                    ></textarea>
                    <div class="valid-feedback">
                        Отлично!
                    </div>
                    <div class="invalid-feedback">
                        Пожалуйста, напишите сообщение
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary" id="send-button">
                        Отправить
                        <i class="fa-regular fa-paper-plane"></i>
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection
@push('js')
    <script>
        function buttonDisable()
        {
            const buttonSubmit = document.getElementById('send-button');
            buttonSubmit.innerHTML = '<div class="spinner-border" role="status"></div>';
            buttonSubmit.classList.add('disabled')
        }

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

    </script>
@endpush



