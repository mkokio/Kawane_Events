@props(['value'])

<label {{ $attributes->merge(['class' => 'mt-4']) }}>
    {{ $value ?? $slot }}
</label>
