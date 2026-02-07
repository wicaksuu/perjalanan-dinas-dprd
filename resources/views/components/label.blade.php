<label {{ $attributes->merge(['class' => 'block font-bold text-sm text-gray-900 mb-2']) }}>
    {{ $value ?? $slot }}
</label>
