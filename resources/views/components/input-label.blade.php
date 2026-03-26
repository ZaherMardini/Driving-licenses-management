@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-white font-medium text-sm']) }}>
    {{ $value ?? $slot }}
</label>
