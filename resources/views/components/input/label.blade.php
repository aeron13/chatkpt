@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-sans absolute right-[6px] bottom-[3px] text-xs font-medium']) }}>
    {{ $value ?? $slot }}
</label>
