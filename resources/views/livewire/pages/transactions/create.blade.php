<div>
    <livewire:pages.transactions.add-service-modal />
    <livewire:pages.transactions.select-customer-modal />
    <livewire:pages.transactions.add-pay-modal />

    <div class="mx-5 mt-5 flex flex-col gap-y-3">
        <x-breadcrumbs :links="[
        ['label' => 'Dashboard', 'url' => url('/')],
        ['label' => 'Transaksi', 'url' => url('/transactions')],
        ['label' => 'Tambah', 'url' => url('/transactions/create')],
    ]" />

        <div class="flex flex-col gap-y-5">
            <x-header :title="$pageTitle" :subtitle="$pageSubtitle" />

            <div class="flex justify-between items-center">
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

                <div class="flex items-center gap-x-2">
                    @if ($id == null)
                    <x-button variant="danger" wire:click="resetForm">Reset</x-button>
                    @endif

                    @if ($id)
                    <x-select label="Status" name="status" :options="$statusEnums" :showLabel="false" value="$status" wire:model="status" />

                    <a href="{{ $this->getWhatsappMessageLink() }}" target="_blank"><x-button variant="green">
                            <div class="flex items-center gap-x-1">
                                <svg class="w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M3 5.983C3 4.888 3.895 4 5 4h14c1.105 0 2 .888 2 1.983v8.923a1.992 1.992 0 0 1-2 1.983h-6.6l-2.867 2.7c-.955.899-2.533.228-2.533-1.08v-1.62H5c-1.105 0-2-.888-2-1.983V5.983Zm5.706 3.809a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Zm2.585.002a1 1 0 1 1 .003 1.414 1 1 0 0 1-.003-1.414Zm5.415-.002a1 1 0 1 0-1.412 1.417 1 1 0 1 0 1.412-1.417Z" clip-rule="evenodd" />
                                </svg>
                                Kirim Whatsapp
                            </div>
                        </x-button></a>

                    <a href="{{ route('transactions.export', $id) }}" target="_blank">
                        <x-button variant="green">
                            <div class="flex gap-x-2 items-center">
                                <svg class="w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd" />
                                </svg>
                                Unduh Nota
                            </div>
                        </x-button>
                    </a>
                    @endif

                    <x-button form="transaction-form" wire:click="submit">
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
                <section class="bg-white rounded-2xl shadow-md p-5 min-w-[300px] max-h-[500px]">
                    <form class="flex flex-col gap-y-4" action="/transactions" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menyimpan data transaksi ini?')">
                        @csrf
                        @method('POST')

                        <div class="flex flex-col g2ap-y-1">
                            <div class="flex flex-col gap-y-1">
                                <x-input-label label="Pilih Pelanggan" required />

                                <div class="flex gap-x-3 flex-nowrap">
                                    <div class="border border-gray-300 px-3 py-2 rounded-md flex w-full">
                                        <input
                                            class="text-sm text-nowrap overflow-ellipsis overflow-hidden focus:outline-none w-full"
                                            placeholder="Pilih Pelanggan" readonly="true"
                                            value="{{ @$customer->name }}" />


                                        @if(empty($id))
                                        <button wire:click="clearCustomer" type="button"
                                            class="cursor-pointer flex items-center justify-center hover:brightness-95"><svg
                                                class="w-4 text-gray-400" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18 17.94 6M18 18 6.06 6" />
                                            </svg>
                                        </button>
                                        @endif
                                    </div>

                                    @if(empty($id))
                                    <button type="button"
                                        wire:click="dispatchTo('pages.transactions.select-customer-modal', 'showModal')"
                                        class="bg-blue-600 aspect-square w-10 flex items-center justify-center rounded-md cursor-pointer hover:brightness-95"><svg
                                            class="w-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                        </svg></button>
                                    @endif
                                </div>
                            </div>
                            @error('customer.id')
                            <p class="text-red-500 text-xs">{{ \Illuminate\Support\Str::ucfirst($message) }}</p>
                            @enderror
                        </div>

                        <x-input label="Tanggal Transaksi" name="date" type="date" value="{{ date('Y-m-d') }}" required wire:model="date" :disabled="!empty($id)" />
                        <x-input label="Tanggal Diambil" name="due_date" type="date" required wire:model="due_date" :disabled="!empty($id)" />

                        <div class="flex flex-col gap-y-2">
                            <x-input-label label="Pembayaran" required />

                            <div class="flex flex-col gap-y-3">
                                <div>
                                    <div class="flex gap-x-5 flex-wrap gap-y-2">
                                        <x-checkbox type="radio" label="Sekarang" name="payment_status" value="0"
                                            wire:model.live="payment_status" :disabled="!empty($id)" />
                                        <x-checkbox type="radio" label="Uang Muka" name="payment_status" value="1"
                                            wire:model.live="payment_status" :disabled="!empty($id)" />
                                        <x-checkbox type="radio" label="Bayar Nanti" name="payment_status" value="2"
                                            wire:model.live="payment_status" :disabled="!empty($id)" />
                                    </div>

                                    @error('payment_status')
                                    <p class="text-red-500 text-xs">{{ \Illuminate\Support\Str::ucfirst($message) }}</p>
                                    @enderror
                                </div>

                                <div class="flex flex-col gap-y-1">
                                    @if ($payment_status == 1)
                                    <x-input name="total_paid" label="Jumlah Pembayaran" type="number" placeholder="Masukkan Jumlah Pembayaran" required wire:model="total_paid" value="{{ $total_paid }}" />
                                    @endif

                                    @error('total_paid')
                                    <p class="text-red-500 text-xs">{{ \Illuminate\Support\Str::ucfirst($message) }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </form>
                </section>

                <div class="bg-white p-5 rounded-2xl shadow-md w-full flex flex-col gap-y-5">
                    <div class="flex items-start justify-between">
                        <x-header title="Detail Transaksi" subtitle="Detail transaksi pelanggan" />

                        @if (!$id)
                        <x-button wire:click="dispatch('show-add-service-modal')" variant="green">+ Tambah Layanan</x-button>
                        @endif
                    </div>

                    <livewire:pages.transactions.table :services="$services" :showActions="false" />
                    <div>
                        <div class="flex justify-between px-4 py-2">
                            <h2 class="text-normal">Total</h2>
                            <p class="text-2xl font-bold">{{ $this->getFormattedTotal() }}</p>
                        </div>
                    </div>
                </div>

            </div>

            @if ($id)
            <div class="bg-white p-5 rounded-2xl shadow-md w-full flex flex-col gap-y-5">
                <div class="flex items-start justify-between">
                    <x-header title="Riwayat pembayaran" subtitle="Detail pembayaran" />

                    <x-button wire:click="dispatchTo('pages.transactions.add-pay-modal', 'show-modal')" variant="green" :disabled="@$this->transaction->total_paid >= $this->transaction->total">+ Tambah Pembayaran</x-button>
                </div>

                <x-pages.transactions.pays-table :pays="$pays" />
            </div>
            @endif

        </div>
    </div>
</div>