<div>
    <livewire:pages.transactions.add-service-modal />

    <div class="mx-5 mt-5 flex flex-col gap-y-3">
        <x-breadcrumbs
            :links="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Transaksi', 'url' => url('/transactions')],
            ['label' => 'Tambah', 'url' => url('/transactions/create')]]" 
        />

        <div class="flex flex-col gap-y-5">
            <x-header title="Edit Data Transaksi" subtitle="Edit data transaksi di sini" />

            <div class="flex justify-between items-center">
                <x-button variant="white">
                    <div class="flex items-center gap-x-2">
                        <svg class="w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                        </svg>
                        Kembali
                    </div>
                </x-button>

                <div class="flex items-center gap-x-2">
                    <x-button variant="danger" wire:click="resetForm">Reset</x-button>

                    <x-button form="transaction-form" wire:click="submit">
                        <div class="flex gap-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4">
                                <path d="M4 3H17L20.7071 6.70711C20.8946 6.89464 21 7.149 21 7.41421V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM12 18C13.6569 18 15 16.6569 15 15C15 13.3431 13.6569 12 12 12C10.3431 12 9 13.3431 9 15C9 16.6569 10.3431 18 12 18ZM5 5V9H15V5H5Z"></path>
                            </svg>
                            Simpan
                        </div>
                    </x-button>
                </div>
            </div>

            <div class="flex flex-col gap-y-5 gap-x-5 lg:flex-row">
                <section class="bg-white rounded-2xl shadow-md p-5 min-w-[300px] max-h-[400px]">
                    <form class="flex flex-col gap-y-4" action="/transactions" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menyimpan data transaksi ini?')">
                        @csrf
                        @method('POST')

                        <x-select label="Pelanggan" name="customer_id" :options="$customers" required wire:model="customer_id" />
                        <x-input label="Tanggal Transaksi" name="date" type="date" value="{{ date('Y-m-d') }}" required wire:model="date" />
                        <x-input label="Tanggal Transaksi" name="date" type="date" value="{{ date('Y-m-d') }}" required wire:model="date" />
                        <x-input label="Tanggal Diambil" name="due_date" type="date" required wire:model="due_date" />

                        <div class="flex flex-col gap-y-2">
                            <x-input-label label="Pembayaran" name="payment" required />

                            <div class="flex gap-x-5">
                                <x-checkbox type="radio" label="Sekarang" name="payment_method" value="now" wire:model="payment_method" />
                                <x-checkbox type="radio" label="Bayar Nanti" name="payment_method" value="later" wire:model="payment_method" />
                            </div>

                            @error('payment_method')
                            <p class="text-red-500 text-xs">{{ \Illuminate\Support\Str::ucfirst($message) }}</p>
                            @enderror
                        </div>
                    </form>
                </section>

                <div class="bg-white p-5 rounded-2xl shadow-md w-full flex flex-col gap-y-5">
                    <div class="flex items-start justify-between">
                        <x-header title="Detail Transaksi" subtitle="Detail transaksi pelanggan" />
                        <x-button wire:click="showModal" variant="green">+ Tambah Layanan</x-button>
                    </div>

                    <livewire:pages.transactions.table :services="$services" />
                </div>
            </div>
        </div>
    </div>
</div>