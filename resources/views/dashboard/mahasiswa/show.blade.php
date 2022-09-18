@extends('dashboard.index')
@section('main_content')
    {{-- Show the data of user --}}
    <div class="p-12 py-6">
        {{-- Back Button --}}
        <a href="/dashboard/mahasiswa" class="flex items-center gap-2 text-blue-400 hover:text-blue-600">
            {{-- Back Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali</span>
        </a>
        <h1 class="text-2xl font-bold my-5">Detail Mahasiswa</h1>
        <div class="flex flex-col gap-3">
            <label for="nama">Nama</label>
            <input value="{{ $user->nama }}" disabled type="text" name="nama" id="nama"
                class="border border-gray-300 rounded-lg p-2">
        </div>
        <div class="flex flex-col gap-3 mt-5">
            <label for="nim">NIM</label>
            <input value="{{ $user->nim }}" disabled type="text" name="nim" id="nim"
                class="border border-gray-300 rounded-lg p-2">
        </div>
        <div class="flex flex-col gap-3 mt-5">
            <label for="email">Email</label>
            <input value="{{ $user->email }}" disabled type="email" name="email" id="email"
                class="border border-gray-300 rounded-lg p-2">
        </div>
    @endsection
