@props(['type' => 'button', 'variant' => 'primary'])

@php
$classes = [
'primary' => 'bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition',
'secondary' => 'bg-gray-100 px-6 py-2 rounded-md hover:brightness-90 transition',
'danger' => 'bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-700 transition',
'green' => 'bg-green-600 text-white px-6 py-2 rounded-md hover:bg-green-700 transition',
'white' => 'bg-white text-black px-6 py-2 rounded-md hover:brightness-90 transition',
];
@endphp

<button
    type="{{ $type }}"
    class="{{ $classes[$variant] }} text-sm cursor-pointer shadow-md disabled:saturate-0 disabled:cursor-not-allowed"
    {{ $attributes }}>
    {{ $slot }}
</button>