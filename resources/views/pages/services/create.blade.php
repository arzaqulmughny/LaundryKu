@extends('layouts.dashboard')

@section('title', 'Pelanggan')

@section('content-inner')
<div class="mx-5 mt-5 flex flex-col gap-y-3">
    <x-breadcrumbs
        :links="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Layanan', 'url' => url('/services')],
            ['label' => 'Tambah', 'url' => url('/services/create')],
        ]" />

    <div class="flex flex-col gap-y-5">
        <x-header title="Tambah Data Layanan" subtitle="Masukkan data layanan di sini" />

        <section class="bg-white rounded-2xl shadow-md p-5">
            <form class="flex flex-col gap-y-4" action="/services" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan data layanan ini?')">
                @csrf
                @method('POST')
                <x-input label="Nama" name="name" placeholder="Masukkan nama layanan" required autofocus />
                <x-input label="Deskripsi" name="description" placeholder="Masukkan deskripsi layanan" required autofocus />
                <x-input label="Harga" name="price" placeholder="Masukkan harga layanan" required autofocus />
                <x-select label="Satuan" name="unit" required autofocus :options="['kg', 'pcs']" />
                <x-checkbox label="Aktif" name="active" checked="true" />

                <div class="flex space-x-4 justify-between">
                    <a href="/customers">
                        <x-button variant="secondary">Kembali</x-button>
                    </a>

                    <div class="flex gap-x-4">
                        <x-button type="submit">
                            <div class="flex gap-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
                                    <path d="M4 3H17L20.7071 6.70711C20.8946 6.89464 21 7.149 21 7.41421V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM12 18C13.6569 18 15 16.6569 15 15C15 13.3431 13.6569 12 12 12C10.3431 12 9 13.3431 9 15C9 16.6569 10.3431 18 12 18ZM5 5V9H15V5H5Z"></path>
                                </svg>
                                Simpan
                            </div>
                        </x-button>
                    </div>
                </div>
            </form>
        </section>
    </div>
</div>

@endsection