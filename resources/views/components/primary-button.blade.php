<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline-primary mt-4']) }}>
    {{ $slot }}
</button>
