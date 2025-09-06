@props(['label', 'name', 'required' => false, 'value' => true])

<div class="flex items-center gap-x-2">
    <input type="checkbox" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" {{ $attributes }}>
    <x-input-label :label="$label" :name="$name" :required="$required" />
</div>