@extends('layouts.dashboard')
@section('title', 'Pelanggan')

@section('content-inner')
<div class="mx-5 mt-5 flex flex-col gap-y-3">
    @include('pages.services.select-material-modal')
    <x-breadcrumbs :links="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Layanan', 'url' => url('/services')],
            ['label' => 'Tambah', 'url' => url('/services/create')],
        ]" />

    <div class="flex flex-col gap-y-5">
        <x-header title="Layanan" :subtitle="@$service ? 'Ubah Layanan' : 'Tambah Layanan'" />

        <div class="flex justify-between items-center flex-wrap gap-3">
            <a href="/transactions">
                <x-button variant="white">
                    <div class="flex items-center gap-x-2">
                        <svg class="w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m15 19-7-7 7-7" />
                        </svg>
                        Kembali
                    </div>
                </x-button>
            </a>

            <div class="flex items-center gap-2 flex-wrap">
                @if (@$service)
                    <x-button variant="danger" type="button" onclick="onDeleteService()">Hapus</x-button>
                @endif

                <x-button type="button" id="submit-button" :onclick="@$service ? 'update(event)' : 'store(event)'">
                    <div class="flex gap-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
                            <path
                                d="M4 3H17L20.7071 6.70711C20.8946 6.89464 21 7.149 21 7.41421V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM12 18C13.6569 18 15 16.6569 15 15C15 13.3431 13.6569 12 12 12C10.3431 12 9 13.3431 9 15C9 16.6569 10.3431 18 12 18ZM5 5V9H15V5H5Z">
                            </path>
                        </svg>
                        Simpan
                    </div>
                </x-button>
            </div>
        </div>


        <div class="flex flex-col gap-y-5 gap-x-5 lg:flex-row">
            <section class="bg-white rounded-2xl shadow-md p-5 flex-1 h-fit" id="transaction-form">
                <form class="flex flex-col gap-y-4" id="service-form" action="{{ @$service ? route('services.update', $service) : route('services.store') }}" method="POST">
                    @csrf
                    @method(@$service ? 'PUT' : 'POST')
                    
                    <x-input name="name" label="Nama Layanan" type="text" placeholder="Masukkan Nama Layanan" required value="{{ @$service->name ?? old('name') }}" />
                    <x-input name="description" label="Deskripsi" type="text" placeholder="Masukkan Deskripsi" value="{{ @$service->description ?? old('description') }}" />
                    <x-select name="unit" label="Satuan" placeholder="Masukkan Satuan" required :options="App\Models\Unit::getOptionsForSelect()" selected="{{ @$service->unit ?? old('unit') }}" />
                    <x-input name="labor_cost" label="Biaya Tenaga" type="text" placeholder="Masukkan Biaya Tenaga" value="{{ @$service->labor_cost ?? old('labor_cost', 0) }}" />
                    <div class="flex items-start gap-x-2">
                        <div class="flex-1">
                            <x-select name="pricing_mode" label="Metode Harga" :showPlaceholder="false" :options="App\Models\Service::$pricingModeEnum" required :selected="@$service->pricing_mode ?? old('pricing_mode', 'FIXED')" onchange="onChangePricingMode(event)" />
                        </div>
                        <div class="flex-3">
                            <x-input name="price" label="Harga" type="text" placeholder="Masukkan Harga" required value="{{ @$service->price ?? old('price', 0) }}" />
                        </div>
                    </div>
                    <x-checkbox label="Aktif" name="active" checked="{{ @$service->active ?? old('active', true) }}" />

                    <input type="hidden" name="materials" id="materials" />
                </form>
            </section>

            <div class="bg-white p-5 rounded-2xl shadow-md flex-1 flex flex-col gap-y-5 pb-10">
                <div class="flex items-start justify-between">
                    <x-header title="Daftar Bahan" subtitle="Daftar bahan yang digunakan dalam layanan ini." />
                    <x-button variant="green" onclick="document.querySelector('.select-material-modal').classList.toggle('hidden');">+ Tambah Bahan</x-button>
                </div>

                <x-pages.services.materials-table />
            </div>
        </div>
    </div>
</div>
@endsection

@include('pages.services.upsert-script')
