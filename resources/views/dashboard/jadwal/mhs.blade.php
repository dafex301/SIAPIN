@extends('dashboard.index')
@section('main_content')
    <div class="p-12 py-6">
        {{-- Back Button --}}
        <a href="/dashboard/jadwal/{{ $jadwal->id }}" class="flex items-center gap-2 text-blue-400 hover:text-blue-600">
            {{-- Back Icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali</span>
        </a>
        <h1 class="text-2xl font-bold mt-5">Tambah Mahasiswa</h1>
        <h2 class="text-lg">{{ $jadwal->nama }}</h2>
        {{-- Form to add user --}}
        <form action="/dashboard/jadwal/{{ $jadwal->id }}/mhs" method="POST">
            @csrf
            <div class="flex flex-col gap-2">
                {{-- Show all user with checkbox --}}
                @foreach ($users as $user)
                    <div class="flex items-center gap-2">
                        <input id="m-{{ $user->id }}" type="checkbox" name="user_id[]" value="{{ $user->id }}">
                        <label for="m-{{ $user->id }}">{{ $user->nama }}</label>
                        {{-- Hidden input that value is $jadwal->id --}}
                        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
                    </div>
                @endforeach
                <button type="submit" class="bg-green-500 text-white hover:bg-green-600 rounded-md px-2 py-1 shadow-md">
                    Tambah
                </button>
            </div>
        @endsection
