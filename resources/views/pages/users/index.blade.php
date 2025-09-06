@extends('layouts.dashboard')

@section('title', 'Layanan')

@section('content-inner')
<div class="mx-5 mt-5 flex flex-col gap-y-3">
    <x-breadcrumbs
        :links="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Pengguna', 'url' => url('/users')],
            ]" />

    <div class="flex flex-col gap-y-5">
        <div class="flex justify-between items-start">
            <x-header title="Pengguna" subtitle="Kelola data pengguna" />

            <div class="flex justify-end gap-x-5">
                <!-- <x-button variant="green">
                    <div class="flex gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
                            <path d="M21 3H3C2.44772 3 2 3.44772 2 4V20C2 20.5523 2.44772 21 3 21H21C21.5523 21 22 20.5523 22 20V4C22 3.44772 21.5523 3 21 3ZM12 16C10.3431 16 9 14.6569 9 13H4V5H20V13H15C15 14.6569 13.6569 16 12 16ZM16 9H13V6H11V9H8L12 13.5L16 9Z"></path>
                        </svg>
                        Import
                    </div>
                </x-button> -->

                <a href="/users/create">
                    <x-button>
                        <div class="flex gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
                                <path d="M11 11.0001L11 2.0005L13 2.00049L13 11.0001L22.0001 10.9999L22.0002 12.9999L13 13.0001L13.0001 22L11.0001 22L11.0001 13.0001L2.00004 13.0003L2 11.0003L11 11.0001Z"></path>
                            </svg>
                            Tambah
                        </div>
                    </x-button>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-5">
            <livewire:users-table />
        </div>
    </div>
</div>

@endsection