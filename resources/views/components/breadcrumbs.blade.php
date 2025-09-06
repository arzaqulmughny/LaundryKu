@props([
    'links' => [],
    'current' => ''
])

<nav class="text-sm text-gray-600 mb-4" aria-label="Breadcrumb">
    <ol class="list-reset flex space-x-2">
        @foreach($links as $link)
            @if(!$loop->last)
                <li>
                    <a href="{{ $link['url'] }}" class="hover:underline hover:text-gray-900">
                        {{ $link['label'] }}
                    </a>
                    <span class="mx-2">›</span>
                </li>
            @else
                <li class="text-gray-900 font-semibold" aria-current="page">
                    {{ $link['label'] }}
                </li>
            @endif
        @endforeach
    </ol>
</nav>