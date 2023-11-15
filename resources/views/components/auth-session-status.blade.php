@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-weight-bold fs-sm text-success']) }}>
        {{ $status }}
    </div>
@endif
