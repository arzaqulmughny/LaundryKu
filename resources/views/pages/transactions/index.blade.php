@extends('layouts.dashboard')

@section('title', 'Transaksi')

@section('content-inner')
<div class="mx-5 mt-5 flex flex-col gap-y-3">
    <x-breadcrumbs
        :links="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Transaksi', 'url' => url('/transactions')],
            ]" />

    <div class="flex flex-col gap-y-5">
        <div class="flex justify-between items-start">
            <x-header title="Transaksi" subtitle="Kelola data transaksi" />

            <div class="flex justify-end gap-x-5">
                @role(['OWNER', 'STAFF'])
                <a href="/transactions/create">
                    <x-button>
                        <div class="flex gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
                                <path d="M11 11.0001L11 2.0005L13 2.00049L13 11.0001L22.0001 10.9999L22.0002 12.9999L13 13.0001L13.0001 22L11.0001 22L11.0001 13.0001L2.00004 13.0003L2 11.0003L11 11.0001Z"></path>
                            </svg>
                            Tambah
                        </div>
                    </x-button>
                </a>
                @endrole
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-5">
            <livewire:transaction-table />
        </div>
    </div>
</div>

@endsection