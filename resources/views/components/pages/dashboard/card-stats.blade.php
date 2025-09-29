@props(['variant' => 'blue', 'title', 'value' => 0, 'subtitle', 'icon'])

@php
    $variants = [
        'blue' => 'bg-blue-100 text-blue-500',
        'red' => 'bg-red-100 text-red-500',
        'green' => 'bg-green-100 text-green-500',
        'yellow' => 'bg-yellow-100 text-yellow-500',
    ];
@endphp

<div class="flex bg-white p-5 rounded-md shadow-md gap-x-4 justify-between">
    <div class="flex flex-col gap-y-1">
        <h1 class="text-xs whitespace-nowrap text-slate-700">{{ $title }}</h1>
        <p class="font-bold text-base md:text-2xl">{{ $value }}</p>
        <p class="text-xs text-green-600">{{ $subtitle }}</p>
    </div>

    <div class="w-13 h-13 aspect-square rounded-md flex items-center justify-center {{ $variants[$variant] }}">
        <div class="w-6 h-6">
            {{ $icon }}
        </div>
    </div>
</div>