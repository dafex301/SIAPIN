@extends('layouts.main')

@section('container')
@include('components.navbar')
{{-- Add mahasiswa --}}
<div class="flex justify-center">
    <div class="w-1/2">
        <form action="/dashboard/mahasiswa" method="POST">
            @csrf
            <div class="mb-4">
                <label for="nim" class="sr-only">NIM</label>
                <input type="text" name="nim" id="nim" placeholder="NIM" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('nim') border-red-500 @enderror" value="{{ old('nim') }}">
                @error('nim')
                    <div class="text-red-500 mt-2 text-sm">
                        <h5>Error</h5>
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="nama" class="sr-only">Nama</label>
                <input type="text" name="nama" id="nama" placeholder="Nama" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('nama') border-red-500 @enderror" value="{{ old('nama') }}">
                @error('nama')
                    <div class="text-red-500 mt-2 text-sm">
                        <h5>Error</h5>
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="sr-only">Email</label>
                <input type="text" name="email" id="email" placeholder="Email" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                @error('email')
                    <div class="text-red-500 mt-2 text-sm">
                        <h5>Error</h5>
                    </div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="phone" class="sr-only">Phone</label>
                <input type="text" name="phone" id="phone" placeholder="phone" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('phone') border-red-500 @enderror" value="{{ old('phone') }}">
                @error('phone')
                    <div class="text-red-500 mt-2 text-sm">
                        <h5>Error</h5>
                    </div>
                @enderror
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Add Mahasiswa</button>
            </div>
        </form>
    </div>
</div>

    
@endsection