@extends('dashboard.index')
@section('main_content')
    <div class="p-12 py-6">
        {{-- Back Button --}}
        <a href="/dashboard/jadwal" class="flex items-center gap-2 text-blue-400 hover:text-blue-600">
            {{-- Back Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>

            <span>Kembali</span>
        </a>

        <h1 class="text-2xl font-bold my-5">Tambah Jadwal</h1>
        <form action="/dashboard/jadwal" method="POST">
            @csrf
            <div class="flex flex-col gap-3">
                <label for="nama">Nama</label>
                <input required type="text" name="nama" id="nama" class="border border-gray-300 rounded-lg p-2">
                {{-- Show error text --}}
                @error('nama')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col gap-3 mt-5">
                <label for="hari">Hari</label>
                <input required type="text" name="hari" id="hari" class="border border-gray-300 rounded-lg p-2">
                {{-- Show error text --}}
                @error('hari')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            {{-- Input time for jam_mulai --}}
            <div class="flex flex-col gap-3 mt-5">
                <label for="jam_mulai">Jam Mulai</label>
                <input required type="time" name="jam_mulai" id="jam_mulai"
                    class="border border-gray-300 rounded-lg p-2">
                {{-- Show error text --}}
                @error('jam_mulai')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Input time for jam_selesai --}}
            <div class="flex flex-col gap-3 mt-5">
                <label for="jam_selesai">Jam Selesai</label>
                <input required type="time" name="jam_selesai" id="jam_selesai"
                    class="border border-gray-300 rounded-lg p-2">
                {{-- Show error text --}}
                @error('jam_selesai')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-3 mt-5">
                <label for="lab">Lab</label>
                {{-- Show lab choice --}}
                <select required name="lab_id" id="lab" class="border border-gray-300 rounded-lg p-2">
                    <option value="" disabled selected>Pilih Lab</option>
                    @foreach ($labs as $lab)
                        <option value="{{ $lab->id }}">{{ $lab->nama }}</option>
                    @endforeach
                </select>
                {{-- Show error text --}}
                @error('lab')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Show matkul choice --}}
            <div class="flex flex-col gap-3 mt-5">
                <label for="matkul">Mata Kuliah</label>
                <select required name="matkul_id" id="matkul" class="border border-gray-300 rounded-lg p-2">
                    <option value="" disabled selected>Pilih Mata Kuliah</option>
                    @foreach ($matkuls as $matkul)
                        <option value="{{ $matkul->id }}">{{ $matkul->nama_matkul }}</option>
                    @endforeach
                </select>
                {{-- Show error text --}}
                @error('matkul')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror

                {{-- asprak_1 from user --}}
                <div class="flex flex-col gap-3 mt-5">
                    <label for="asprak_1">Asisten Praktikum 1</label>
                    {{-- Show asprak_1 choice --}}
                    <select required name="asprak_1" id="asprak_1" class="border border-gray-300 rounded-lg p-2">
                        <option value="" disabled selected>Pilih Asisten Praktikum 1</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nama }}</option>
                        @endforeach
                    </select>
                    {{-- Show error text --}}
                    @error('asprak_1')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                {{-- asprak_2 from user --}}
                <div class="flex flex-col gap-3 mt-5">
                    <label for="asprak_2">Asisten Praktikum 2</label>
                    {{-- Show asprak_2 choice --}}
                    <select name="asprak_2" id="asprak_2" class="border border-gray-300 rounded-lg p-2">
                        <option value="" selected>Pilih Asisten Praktikum 2</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->nama }}</option>
                        @endforeach
                    </select>
                    {{-- Show error text --}}
                    @error('asprak_2')
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
