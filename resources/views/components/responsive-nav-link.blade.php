@props(['active'])

@php
$classes = ($active ?? false)
    ? 'nav-link active' // Assuming 'active' represents the active state in Bootstrap nav
    : 'nav-link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
