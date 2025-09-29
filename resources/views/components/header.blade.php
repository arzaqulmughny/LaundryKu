@props(['title', 'subtitle'])

<div class="flex flex-col gap-y-1">
    <h1 class="text-sm font-semibold text-slate-700">{{ $title }}</h1>
    <p class="text-xs text-slate-700">{{ $subtitle }}</p>
</div>