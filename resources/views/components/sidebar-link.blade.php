@props(['link', 'isActive' => null])

@php
// Determine if the main link is active
$hrefPath = trim(parse_url($link['href'], PHP_URL_PATH), '/');
$isActive = $hrefPath
    ? request()->is($hrefPath . '*')
    : request()->is('/');

// Check if the link has a submenu
$hasSubmenu = !empty($link['submenu']);

// Check if any submenu item is active
$submenuIsActive = false;
if($hasSubmenu) {
    foreach($link['submenu'] as $sublink) {
        $subHrefPath = trim(parse_url($sublink['href'], PHP_URL_PATH), '/');
        if($subHrefPath && request()->is($subHrefPath . '*')) {
            $submenuIsActive = true;
            break;
        }
    }
}

// Determine submenu classes
$submenuClasses = 'ml-4 mt-1 flex flex-col gap-y-1 max-h-0 overflow-hidden transition-all duration-300';
if($submenuIsActive) {
    $submenuClasses .= ' max-h-96'; // open submenu if one of its items is active
}
@endphp

<li>
    <!-- Main link -->
    <a href="{{ $link['href'] ?? '#' }}" 
       class="flex items-center justify-between gap-x-5 px-4 py-3 rounded-md transition-all duration-300 
              {{ $isActive ? 'bg-sky-50 [&>div>svg]:text-sky-600 hover:bg-sky-100' : '[&>div>svg]:text-slate-700 bg-white hover:bg-sky-50' }}">
        <div class="flex items-center gap-x-2">
            <div class="w-4 h-4">{!! $link['svg'] !!}</div>
            <h1 class="text-xs md:text-sm {{ $isActive ? 'text-sky-600' : 'text-slate-700' }}">{{ $link['title'] }}</h1>
        </div>

        <!-- Submenu indicator icon -->
        @if($hasSubmenu)
            <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        @endif
    </a>

    <!-- Submenu, only render if exists -->
    @if($hasSubmenu)
        <ul class="{{ $submenuClasses }}">
            @foreach($link['submenu'] as $sublink)
                @php
                    $subHrefPath = trim(parse_url($sublink['href'], PHP_URL_PATH), '/');
                    $subIsActive = $subHrefPath ? request()->is($subHrefPath . '*') : false;
                @endphp
                <li>
                    <a href="{{ $sublink['href'] }}" 
                       class="block px-4 py-2 rounded-md text-xs md:text-sm {{ $subIsActive ? 'bg-sky-50 text-sky-600' : 'text-slate-700 hover:bg-slate-100' }}">
                        {{ $sublink['title'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</li>

@once
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add click toggle for submenu collapse
    document.querySelectorAll('li > a').forEach(link => {
        const submenu = link.nextElementSibling;
        if(submenu && submenu.tagName === 'UL') {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                // Toggle collapse / expand
                if(submenu.classList.contains('max-h-0')) {
                    submenu.classList.remove('max-h-0');
                    submenu.classList.add('max-h-96');
                } else {
                    submenu.classList.add('max-h-0');
                    submenu.classList.remove('max-h-96');
                }
            });
        }
    });
});
</script>
@endonce