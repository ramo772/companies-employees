@props(['data-id' => '', 'data-url' => '', 'id' => ''])
<button {{ $attributes->merge(['class' => ' btn   px-3 me-2 me-md-3']) }}>
    {{ $slot }}
</button>
