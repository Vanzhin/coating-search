@if(session()->has('error'))
    @component('components.user.alert',['type' => 'danger', 'message' => session()->get('error')])
    @endcomponent
@endif

@if(session()->has('success'))
    @component('components.user.alert',['type' => 'success', 'message' => session()->get('success')])
    @endcomponent
@endif

@if($errors->any())
    <div class="form-group">
        @foreach($errors->all() as $error)
            @component('components.user.alert',['type' => 'danger', 'message' => $error])
            @endcomponent
        @endforeach
    </div>
@endif
