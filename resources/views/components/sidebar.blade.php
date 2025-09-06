@php
$links = [
    [
        'href' => route('home'),
        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M11 2.04935V13H21.9506C21.4489 18.0533 17.1853 22 12 22C6.47715 22 2 17.5228 2 12C2 6.81462 5.94668 2.55107 11 2.04935ZM13 0.542847C18.5535 1.02121 22.9788 5.4465 23.4571 11H13V0.542847Z"></path></svg>',
        'title' => 'Dashboard',
    ],
    [
        'href' => route('customers.index'),
        'svg' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 10C14.2091 10 16 8.20914 16 6 16 3.79086 14.2091 2 12 2 9.79086 2 8 3.79086 8 6 8 8.20914 9.79086 10 12 10ZM5.5 13C6.88071 13 8 11.8807 8 10.5 8 9.11929 6.88071 8 5.5 8 4.11929 8 3 9.11929 3 10.5 3 11.8807 4.11929 13 5.5 13ZM21 10.5C21 11.8807 19.8807 13 18.5 13 17.1193 13 16 11.8807 16 10.5 16 9.11929 17.1193 8 18.5 8 19.8807 8 21 9.11929 21 10.5ZM12 11C14.7614 11 17 13.2386 17 16V22H7V16C7 13.2386 9.23858 11 12 11ZM5 15.9999C5 15.307 5.10067 14.6376 5.28818 14.0056L5.11864 14.0204C3.36503 14.2104 2 15.6958 2 17.4999V21.9999H5V15.9999ZM22 21.9999V17.4999C22 15.6378 20.5459 14.1153 18.7118 14.0056 18.8993 14.6376 19 15.307 19 15.9999V21.9999H22Z"></path></svg>',
        'title' => 'Pelanggan',
    ]
];
@endphp

<nav>
    <div class="flex items-center p-5 py-10 gap-x-5 ">
        <div class="w-10">
            <img src="https://placehold.co/400" alt="">
        </div>

        <div>
            <h1>LaundryKu</h1>
            <p class="text-xs whitespace-nowrap">Kelola bisnis landry dengan mudah</p>
        </div>
    </div>

    <hr class="border-slate-300">

    <ul class="px-3 pt-5 flex flex-col gap-y-3">
        @foreach ($links as $link)
            <x-sidebar-link :link="$link" />
        @endforeach
    </ul>
</nav>