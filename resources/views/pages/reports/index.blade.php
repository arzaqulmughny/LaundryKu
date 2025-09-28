@extends('layouts.dashboard')

@section('title', 'Laporan')

@section('content-inner')
<div class="mx-5 mt-5 flex flex-col gap-y-3">
    <x-breadcrumbs
        :links="[
            ['label' => 'Dashboard', 'url' => url('/')],
            ['label' => 'Laporan', 'url' => url('/reports')],
        ]" />

    <form class="flex flex-col gap-y-5" method="GET" target="_blank" action="/reports">
        <x-header title="Laporan" subtitle="Dapatkan informasi terkait bisnis Laundry anda" />

        <section class="bg-white rounded-2xl shadow-md p-5">
            <x-select label="Judul" name="title" :options="$reportEnums" onChange="onChangeReportTitle(event)" selected="{{ request()->query('type') }}" />

            @php
                $type = request()->query('type');
            @endphp

            @if (!empty($type))
                @include('pages.reports.fields.' . strtolower($type))
            @endif

            <input type="text" class="hidden" name="submit" value="true" />
        </section>

        @if (!empty($type))
        <div class="flex justify-end">
            <x-button type="submit">Tampilkan</x-button>
        </div>
        @endif
    </form>
</div>

@include('pages.reports.index_script')
@endsection