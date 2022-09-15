@extends('layouts.main')
@section('container')

    <body class='overflow-hidden'>
        <div class="min-h-screen bg-blue-400 flex flex-col gap-3 justify-center items-center">
            <div class="absolute w-60 h-60 rounded-xl bg-blue-300 -top-5 -left-16 z-0 transform rotate-45 hidden md:block">
            </div>
            <div class="absolute w-48 h-48 rounded-xl bg-blue-300 -bottom-6 -right-10 transform rotate-12 hidden md:block">
            </div>
            {{-- If login attempt failed --}}
            @error('identifier')
                <div class="bg-red-100 border w-3/12 rounded-lg mt-4 border-red-200 text-red-700 p-3 shadow-md" role="alert">
                    <p>{{ $message }}</p>
                </div>
            @enderror
            <form action="/login" method="POST">
                @csrf
                <div class="py-12 px-12 bg-white rounded-2xl shadow-xl z-20">
                    <div>
                        <h1 class="text-3xl font-bold text-center mb-4 ">Masuk <span class="text-blue-400">SIAPIN</span></h1>
                        <p class="w-80 text-center text-sm mb-8 font-semibold text-gray-700 tracking-wide ">Sistem
                            Informasi Absensi Praktikum Informatika</p>
                    </div>
                    <div class="space-y-4">

                        <input type="text" placeholder="NIM atau email" required name="identifier"
                            class="block text-sm py-3 px-4 rounded-lg w-full border outline-none" />
                        <input type="password" placeholder="Password" required name="password"
                            class="block text-sm py-3 px-4 rounded-lg w-full border outline-none" />
                    </div>
                    <div class="text-center mt-6">
                        <button type="submit"
                            class="py-3 w-64 text-xl text-white bg-blue-400 hover:bg-blue-600 rounded-2xl">Masuk</button>
                    </div>
                </div>
            </form>
            <div class="w-40 h-40 absolute bg-blue-300 rounded-full top-0 right-12 hidden md:block"></div>
            <div class="w-20 h-40 absolute bg-blue-300 rounded-full bottom-20 left-10 transform rotate-45 hidden md:block">
            </div>
        </div>
    </body>
@endsection
