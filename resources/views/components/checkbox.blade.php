@props(['label', 'name', 'required' => false, 'value' => true, 'type' => 'checkbox'])
<label class="flex items-center gap-x-2" for="{{ $name }}-{{ $value }}">
    <input {{ $attributes }} type="{{ $type }}" name="{{ $name }}"
        id="{{ $name }}-{{ $value }}" value="{{ $value }}">
    <span class="text-sm">{{ $label }}</span>
</label>