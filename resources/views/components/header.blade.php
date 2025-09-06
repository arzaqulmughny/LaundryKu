@props(['title', 'subtitle'])

<div class="flex flex-col gap-y-1">
    <h1 class="text-2xl font-semibold">{{ $title }}</h1>
    <p class="text-sm text-gray-500">{{ $subtitle }}</p>
</div>