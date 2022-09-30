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
        <h1 class="text-2xl font-bold mt-5">Detail Jadwal</h1>
        <h2 class="text-xl">{{ $jadwal->nama }}</h2>
        <h2>{{ $jadwal->lab->nama }} |
            {{ $jadwal->hari . ', ' . date('H:i', strtotime($jadwal->jam_mulai)) . '-' . date('H:i', strtotime($jadwal->jam_selesai)) }}
        </h2>
        <h2>Asprak 1 : {{ $jadwal->asprak1->nama }}</h2>
        {{-- If there is asprak 2, show --}}
        @if ($jadwal->asprak2)
            <h2>Asprak 2 : {{ $jadwal->asprak2->nama }}</h2>
        @endif
        <div class="flex justify-between items-center">
            <h3 class="text-md font-semibold my-5">List Peserta</h3>
            <a href="/dashboard/jadwal/{{ $jadwal->id }}/mhs" class="m-0">
                <div class="bg-green-500 text-white hover:bg-green-600 rounded-md px-2 py-1 shadow-md">
                    Tambah
                </div>
            </a>
        </div>
        {{-- Create table contain username and nim from user --}}
        <table class="min-w-full">
            <thead>
                <tr>
                    <th
                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        Nama</th>
                    <th
                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        NIM</th>
                    <th
                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($irs as $i)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="">
                                    <div class="text-sm font-medium leading-5 text-gray-900">
                                        {{ $i->user->nama }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-500">
                                {{ $i->user->nim }}
                            </div>
                        </td>
                        <td class="flex gap-4 border-b border-gray-200 whitespace-no-wrap px-6 pt-6 pb-2">
                            {{-- Delete Button --}}
                            <form action="/dashboard/jadwal/{{ $jadwal->id }}/mhs/{{ $i->id }}"
                                onsubmit="return confirm('Anda yakin untuk menghapus mahasiswa ini?')" method="POST"
                                class="flex items-center">
                                @method('delete')
                                @csrf
                                <button type="submit" class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="w-6 h-6 text-red-400 hover:text-red-600 cursor-pointer" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
        </table>
        </tbody>
        </table>
    @endsection
