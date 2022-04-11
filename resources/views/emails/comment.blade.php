@component('mail::message')
    <p>{{$greeting}}</p>
    <p>Новый комментарий опубликован {{ $comment->created_at }} пользователем {{$comment->sender_name}}.</p>
    @component('mail::button', ['url' => $url])
        Посмотреть
    @endcomponent
    <p>{{ $salutation }}</p>
    <p>{{config('app.name')}}</p>

@endcomponent
