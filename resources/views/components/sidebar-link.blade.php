@props(['link', 'isActive' => null])

@php
$hrefPath = trim(parse_url($link['href'], PHP_URL_PATH), '/');
$isActive = $hrefPath
? request()->is($hrefPath . '*')
: request()->is('/');
@endphp

<li>
    <a href="{{ $link['href'] }}" class="flex items-center gap-x-5 px-4 py-3 rounded-md [&>svg]:w-4.5 {{ $isActive ? 'bg-sky-50 [&>div>svg]:text-sky-600 hover:bg-sky-100' : '[&>svg]:text-slate-700 bg-white hover:bg-sky-50' }} transition-all duration-300">
        <div class="w-4 h-4">
            {!! $link['svg'] !!}
        </div>
        <h1 class="text-xs md:text-sm {{ $isActive ? 'text-sky-600' : 'text-slate-700' }}">{{ $link['title'] }}</h1>
    </a>
</li>