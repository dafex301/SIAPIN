@extends('dashboard.index')
@section('main_content')
    <h2 class="text-left font-bold text-2xl pl-5 pt-4">
        Presensi
    </h2>

    {{-- Form to input code --}}
    <div class="mx-5">
        {{-- Show message if there is --}}
        @if (session('error'))
            <div class="my-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">
                    {{ session('error') }}
                </strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        {{-- Show success message --}}
        @if (session('success'))
            <div class="my-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">
                    {{ session('success') }}
                </strong>
                <span class="block sm:inline">{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="/dashboard/mhs/presensi" method="POST" class="mt-5">
            @csrf
            <div class="flex flex-col">
                <label for="code" class="text-gray-500">Kode Presensi</label>
                <input type="text" name="code" id="code" required
                    class="border-2 border-gray-300 rounded-lg p-2 mt-2 focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" class="bg-blue-500 text-white rounded-lg px-4 py-2 mt-5">Submit</button>
        </form>
    </div>
@endsection
