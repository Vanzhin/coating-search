<div class="alert alert-{{ $type }}">
    {{ $message}} {{ $item ? ' - ' . Str::upper($item) : null }}
</div>
