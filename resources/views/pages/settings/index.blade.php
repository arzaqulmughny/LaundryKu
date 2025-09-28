@extends('layouts.dashboard')

@section('title', 'Pelanggan')

@section('content-inner')
<div class="mx-5 mt-5 flex flex-col gap-y-3">
    <x-breadcrumbs
        :links="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Pengaturan', 'url' => url('/settings')],
            ]" />

    <div class="flex flex-col gap-y-5">
        <div class="flex justify-between items-start">
            <x-header title="Pengaturan" subtitle="Pengaturan akan diterapkan ke aplikasi" />
            <x-button variant="danger" onclick="onResetAll()">
                <div class="flex gap-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
                        <path d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM9 11V17H11V11H9ZM13 11V17H15V11H13ZM9 4V6H15V4H9Z"></path>
                    </svg>
                    Reset Pengaturan
                </div>
            </x-button>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-5">
            <livewire:settings-table />
        </div>
    </div>
</div>

<form action="/settings/reset-all" method="POST" style="display: none;" id="reset-all-form">
    @method('DELETE')
    @csrf
</form>

@endsection

<script>
    /**
     * Show confirm dialog before reset all settings
     */
    const onResetAll = () => {
        if (!confirm('Apakah Anda yakin mereset semua pengaturan?')) {
            return;
        }

        document.getElementById('reset-all-form').submit();
    }
</script>