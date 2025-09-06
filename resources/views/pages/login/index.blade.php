@extends('layouts.app')
@section('title', 'Login - LaundryKu')

@section('content')
<div class="bg-slate-100 w-full h-screen flex justify-center items-center">
    <form action="{{ route('login.post') }}" method="POST">
        <div class="bg-white flex flex-col p-10 rounded-lg shadow-md gap-y-6">
            <div class="flex flex-col justify-center items-center gap-y-3">
                <div class="w-18 h-18 object-contain overflow-hidden rounded-full">
                    <img src="https://placehold.co/400" alt="">
                </div>

                <h1 class="text-md font-medium text-slate-800">Selamat Datang di Aplikasi LaundryKu</h1>
            </div>

            @csrf
            <div class="flex flex-col gap-y-3">
                <x-input label="Email atau Username" name="username" type="text" placeholder="Masukkan email atau username"></x-input>
                <x-input label="Password" name="password" type="password" placeholder="Masukkan password"></x-input>
            </div>

            <button type="submit" class="w-full py-1.5 bg-blue-500 text-white rounded-md hover:brightness-90 cursor-pointer text-sm">
                Masuk
            </button>
        </div>
    </form>
</div>
@endsection