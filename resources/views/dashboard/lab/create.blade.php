@extends('dashboard.index')
@section('main_content')
    <div class="p-12 py-6">
        {{-- Back Button --}}
        <a href="/dashboard/lab" class="flex items-center gap-2 text-blue-400 hover:text-blue-600">
            {{-- Back Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>

            <span>Kembali</span>
        </a>

        <h1 class="text-2xl font-bold my-5">Tambah Lab</h1>
        <form action="/dashboard/lab" method="POST">
            @csrf
            <div class="flex flex-col gap-3">
                <label for="nama">Nama Lab</label>
                <input type="text" name="nama" id="nama" class="border border-gray-300 rounded-lg p-2">
                {{-- Show error text --}}
                @error('nama')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

            </div>
            <div class="flex flex-col gap-3 mt-5">
                <label for="gedung">Gedung</label>
                <input type="text" name="gedung" id="gedung" class="border border-gray-300 rounded-lg p-2">
                {{-- Show error text --}}
                @error('gedung')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col gap-3 mt-5">
                <label for="lantai">Lantai</label>
                <input type="number" name="lantai" id="lantai" class="border border-gray-300 rounded-lg p-2">
                {{-- Show error text --}}
                @error('lantai')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col gap-3 mt-5">
                <label for="kapasitas">Kapasitas</label>
                <input type="number" name="kapasitas" id="kapasitas" class="border border-gray-300 rounded-lg p-2">
                {{-- Show error text --}}
                @error('kapasitas')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col gap-3 mt-5">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Tambah
                </button>
            </div>
        </form>
    </div>
@endsection
