@props(['data' => []])

<div class="relative overflow-x-auto sm:rounded-lg max-h-[350px]">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 sticky top-0 z-10">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nama
                </th>
                <th scope="col" class="px-6 py-3">
                    Jumlah
                </th>
                <th scope="col" class="px-6 py-3">
                    Satuan
                </th>
                <th scope="col" class="px-6 py-3">
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody id="materials-table-body" class="[&_tr]:odd:bg-white [&_tr]:odd:dark:bg-gray-900 [&_tr]:even:bg-gray-50 [&_tr]:even:dark:bg-gray-800 [&_tr]:hover:bg-gray-50 dark:[&_tr]:hover:bg-gray-800 [&_td]:px-6 [&_td]:py-2">
            @if (count($data) == 0)
            <tr class="bg-white">
                <td class="text-center py-20" colspan="5">
                    Belum ada bahan yang ditambahkan
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>