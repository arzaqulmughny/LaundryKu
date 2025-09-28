@props(['link', 'isActive' => null])

@php
$hrefPath = trim(parse_url($link['href'], PHP_URL_PATH), '/');
$isActive = $hrefPath
? request()->is($hrefPath . '*')
: request()->is('/');
@endphp

<li>
    <a href="{{ $link['href'] }}" class="flex items-center gap-x-5 px-4 py-3 rounded-md hover:brightness-95 [&>svg]:w-4.5 {{ $isActive ? 'bg-sky-50 [&>svg]:text-sky-600' : '[&>svg]:text-slate-700' }}">
        <div style="width: 20px; overflow: hidden;">
            {!! $link['svg'] !!}
        </div>
        <h1 class="text-sm {{ $isActive ? 'text-sky-600' : 'text-slate-700' }}">{{ $link['title'] }}</h1>
    </a>
</li>