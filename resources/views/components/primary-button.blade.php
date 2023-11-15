<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-primary mt-3']) }}>
    {{ $slot }}
</button>
