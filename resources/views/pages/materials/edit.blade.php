@extends('layouts.dashboard')

@section('title', 'Pelanggan')

@section('content-inner')
<div class="mx-5 mt-5 flex flex-col gap-y-3">
    <x-breadcrumbs
        :links="[
        ['label' => 'Dashboard', 'url' => url('/')],
        ['label' => 'Bahan', 'url' => url('/materials')],
        ['label' => 'Edit', 'url' => url('/materials/' . $material->id . '/edit')],
    ]"
        current="Edit Data Bahan" />
    <x-header title="Edit Data Bahan" subtitle="Edit data bahan di sini" />
    
    <section class="bg-white rounded-2xl shadow-md p-5">
        <form class="flex flex-col gap-y-4" action="/materials/{{ $material->id }}" method="POST">
            @method('PUT')
            @csrf
            <x-input label="Nama" name="name" placeholder="Masukkan nama bahan" required autofocus value="{{ $material->name }}" />
            <x-select label="Satuan" name="unit" placeholder="Masukkan satuan bahan" required autofocus :options="$units" valueKey="code" labelKey="name" :selected="$material->unit" />
            <x-checkbox label="Aktif" name="active" :checked="$material->active == true" />

            <div class="flex space-x-4 justify-between">
                <a href="/materials">
                    <x-button variant="secondary">Kembali</x-button>
                </a>

                <div class="flex gap-x-4">
                    <x-button variant="danger" onclick="onDelete()">
                        <div class="flex gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
                                <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM9 11V17H11V11H9ZM13 11V17H15V11H13ZM9 4V6H15V4H9Z"></path>
                            </svg>
                            Hapus
                        </div>
                    </x-button>

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

<form action="/materials/{{ $material->id }}" method="POST" style="display: none;" id="delete-form">
    @method('DELETE')
    @csrf
</form>
@endsection

<script>
    /**
     * Show confirm dialog before delete
     */
    const onDelete = () => {
        if (!confirm('Apakah Anda yakin ingin menghapus data bahan ini?')) {
            return;
        }

        document.getElementById('delete-form').submit();
    }
</script>