@extends('dashboard.index')
@section('main_content')
    <div class="p-12 py-6">
        {{-- Back Button --}}
        <a href="/dashboard/presensi/{{ request()->jadwal_id }}?p={{ request()->pertemuan }}"
            class="flex items-center gap-2 text-blue-400 hover:text-blue-600">
            {{-- Back Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali</span>
        </a>
        <div class="flex mt-5 justify-between">
            <div>
                <h1 class="text-2xl font-bold">{{ $jadwal->nama }}</h1>
                <h2 class="text-xl">Pertemuan {{ request()->pertemuan }}</h2>
                <h2>{{ $jadwal->lab->nama }} |
                    {{ $jadwal->hari . ', ' . date('H:i', strtotime($jadwal->jam_mulai)) . '-' . date('H:i', strtotime($jadwal->jam_selesai)) }}
                </h2>
            </div>
        </div>
        <div class="mt-3">
            {!! QrCode::size(400)->generate($random_string) !!}
        </div>
        <div>
            <h2 class="text-md mt-5">Kode QR</h2>
            <p class="text-lg font-semibold">{{ $random_string }}</p>
        </div>
    </div>
    </div>
@endsection
