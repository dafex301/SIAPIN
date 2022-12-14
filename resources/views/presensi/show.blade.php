@extends('dashboard.index')
@section('main_content')
    <div class="p-12 py-6">
        {{-- Back Button --}}
        <a href="/dashboard/presensi" class="flex items-center gap-2 text-blue-400 hover:text-blue-600">
            {{-- Back Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali</span>
        </a>
        <div class="flex mt-5 justify-between">
            <div>
                <h1 class="text-2xl font-bold">Detail Presensi</h1>
                <h2 class="text-xl">{{ $jadwal->nama }}</h2>
                <h2>{{ $jadwal->lab->nama }} |
                    {{ $jadwal->hari . ', ' . date('H:i', strtotime($jadwal->jam_mulai)) . '-' . date('H:i', strtotime($jadwal->jam_selesai)) }}
                </h2>
            </div>
            <a href="/dashboard/presensi/{{ $jadwal->id }}/{{ $_GET['p'] ?? '1' }}/qr"
                class="bg-blue-500 px-4 flex items-center text-white h-10 hover:bg-blue-700 rounded-md">
                Generate QR Code
            </a>
        </div>
        <div class="flex justify-between items-center">
            <h3 class="text-md font-semibold my-5">List Peserta</h3>
            {{-- Dropdown of pertemuan --}}
            <div class="relative inline-block text-left">
                <div>
                    <button type="button"
                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm leading-5 font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150"
                        id="options-menu" aria-haspopup="true" aria-expanded="true">
                        Pertemuan
                        @if (isset($_GET['p']))
                            {{ $_GET['p'] }}
                        @else
                            1
                        @endif
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5 8a1 1 0 011.707 0L10 11.586 13.293 8A1 1 0 1115 9.707l-4 4a1 1 0 01-1.414 0l-4-4A1 1 0 015 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="origin-top-right absolute right-0 mt-2 w-28 rounded-md shadow-lg hidden">
                    <div class="rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical"
                        aria-labelledby="options-menu">
                        @for ($i = 1; $i <= $jadwal->matkul->pertemuan; $i++)
                            <a href="/dashboard/presensi/{{ $jadwal->id }}?p={{ $i }}"
                                class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900"
                                role="menuitem">{{ $i }}</a>
                        @endfor
                    </div>
                </div>
            </div>
            {{-- Script to hide and show --}}
            <script>
                const dropdown = document.getElementById('options-menu');
                const dropdownMenu = document.querySelector('.origin-top-right');
                dropdown.addEventListener('click', () => {
                    dropdownMenu.classList.toggle('hidden');
                });
            </script>
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
                        Status</th>
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
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-500">
                                {{-- Check if there is presensis data with irs->id and pertemuan from url --}}
                                @if ($presensi->where('pertemuan', $_GET['p'] ?? 1)->where('irs_id', $i->id)->count() > 0)
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Hadir
                                    </span>
                                @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Tidak Hadir
                                    </span>
                                @endif

                            </div>
                        </td>

                        <td class="flex gap-4 border-b border-gray-200 whitespace-no-wrap px-6 pt-6 pb-2">
                            {{-- Present and not present button --}}
                            @if ($presensi->where('pertemuan', $_GET['p'] ?? 1)->where('irs_id', $i->id)->count() > 0)
                                <form action="/dashboard/presensi/{{ $i->id }}?p={{ $_GET['p'] ?? '1' }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 text-sm leading-5 font-medium focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150">
                                        Reset
                                    </button>
                                </form>
                            @else
                                <form action="/dashboard/presensi/{{ $i->id }}?p={{ $_GET['p'] ?? '1' }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-green-500 text-white hover:bg-green-700 text-sm leading-5 font-medium  focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition ease-in-out duration-150">
                                        Hadir
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection
