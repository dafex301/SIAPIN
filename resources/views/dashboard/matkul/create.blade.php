@extends('dashboard.index')
@section('dashboard_container')
    <div class="flex items-center justify-center mt-12">
        <div class="flex flex-col gap-3 w-2/5 bg-white p-12 rounded-lg shadow-lg">
            {{-- Back Button --}}
            <a href="/dashboard/matkul" class="flex items-center gap-2 text-blue-400 hover:text-blue-600">
                {{-- Back Icon --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>

                <span>Kembali</span>
            </a>

            <div class="flex flex-col gap-3">
                <h1 class="text-3xl font-bold">Tambah Mata Kuliah</h1>
                <p class="">Tambahkan mata kuliah yang akan diampu</p>
            </div>
            <form action="/dashboard/matkul" method="POST">
                @csrf
                <div class="flex flex-col gap-3">
                    <label for="kode_matkul">Kode Mata Kuliah</label>
                    <input type="text" name="kode_matkul" id="kode_matkul" class="border border-gray-300 rounded-lg p-2">
                    {{-- Show error text --}}
                    @error('kode_matkul')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror

                </div>
                <div class="flex flex-col gap-3 mt-5">
                    <label for="nama_matkul">Nama Mata Kuliah</label>
                    <input type="text" name="nama_matkul" id="nama_matkul" class="border border-gray-300 rounded-lg p-2">
                    {{-- Show error text --}}
                    @error('nama_matkul')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col gap-3 mt-5">
                    <label for="pertemuan">Total Pertemuan</label>
                    <input type="number" name="pertemuan" id="pertemuan" class="border border-gray-300 rounded-lg p-2">
                    {{-- Show error text --}}
                    @error('pertemuan')
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
    </div>
@endsection
