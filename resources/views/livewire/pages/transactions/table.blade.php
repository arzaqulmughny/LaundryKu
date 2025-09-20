<div class="relative overflow-x-auto shadow-md sm:rounded-lg h-full">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Layanan
                </th>
                <th scope="col" class="px-6 py-3">
                    Jumlah
                </th>
                <th scope="col" class="px-6 py-3">
                    Satuan
                </th>
                <th scope="col" class="px-6 py-3">
                    Subtotal
                </th>

                @if ($showActions)
                    <th scope="col" class="px-6 py-3">
                        Aksi
                    </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if (count($services) == 0)
            <tr class="bg-white">
                <td class="text-center py-20" colspan="5">
                    Tidak ada layanan yang dipilih
                </td>
            </tr>
            @endif

            @foreach ($services as $index => $service)
            <tr wire:key="{{ $index }}" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $service['service_name'] }}
                </th>
                <td class="px-6 py-4">
                    <x-input type="number" name="quantity" label="" wire:model.live="$parent.services.{{ $index }}.quantity" />
                </td>
                <td class="px-6 py-4">
                    {{ $service['service_name'] }}
                </td>
                <td class="px-6 py-4">
                    {{ $this->getSubtotalIndex($index) }}
                </td>

                @if ($showActions)
                    <td class="px-6 py-4">
                        <x-button variant="danger" wire:click="$dispatch('delete-service', {selectedIndex: {{ $index }} })">Hapus</x-button>
                    </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>