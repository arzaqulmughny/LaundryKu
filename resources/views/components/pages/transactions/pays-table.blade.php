@props(['pays' => []])

<div class="relative overflow-x-auto  sm:rounded-lg h-full">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Jumlah
                </th>
                <th scope="col" class="px-6 py-3">
                    Admin
                </th>
                <th scope="col" class="px-6 py-3">
                    Tanggal
                </th>
                <th scope="col" class="px-6 py-3">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @if (count($pays) == 0)
            <tr class="bg-white">
                <td class="text-center py-20" colspan="5">
                    Belum ada pembayaran
                </td>
            </tr>
            @endif

            @foreach ($pays as $index => $pay)
            <tr wire:key="{{ $index }}" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ rupiah($pay['amount']) }}
                </th>
                <td class="px-6 py-4">
                    {{ $pay['admin'] ?? auth()->user()->name }}
                </td>
                <td class="px-6 py-4">
                    {{ $pay['date'] }}
                </td>
                <td class="px-6 py-4">
                    @if (empty($pay['id']))
                    <x-button
                        wire:click="$dispatchTo('pages.transactions.create', 'delete-pay', { selectedIndex: {{ $index }} })"
                        variant="danger">
                        Hapus
                    </x-button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>