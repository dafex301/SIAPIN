@extends('layouts.main')

@section('container')
    <h1>Dashboard</h1>
    {{-- Logout Button --}}
    <form action="/logout" method="POST">
        @csrf
        <div class="flex items-center justify-center h-screen w-screen">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Logout</button>
        </div>
    </form>
@endsection
