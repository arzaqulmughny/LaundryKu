@extends('layouts.app')

<div class="flex min-h-screen w-screen">
    <div class="fixed top-0 -left-[100%] lg:left-0 lg:sticky z-15 h-full bg-white flex flex-col shadow-md transition-all duration-300" id="sidebar">
        @include('components.sidebar')
    </div>

    <div class="flex flex-col w-full overflow-hidden">
        @include('components.topbar')
        @yield('content-inner')
    </div>
</div>