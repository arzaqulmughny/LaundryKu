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
                    <x-button>+ Tambah</x-button>
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