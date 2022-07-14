<div class="alert alert-{{ $type }}">
    {{ $message}} {{ isset($item) ? ' - ' . Str::upper($item) : null }}
</div>
