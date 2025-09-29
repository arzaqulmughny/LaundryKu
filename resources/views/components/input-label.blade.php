@props(['label', 'name' => "", 'required' => false])

<label
    for="{{ $name }}"
    class="text-xs font-medium text-gray-700 {{ $required ? 'after:content-["*"] after:ml-0.5 after:text-red-600' : '' }}">
    {{ $label }}
</label>