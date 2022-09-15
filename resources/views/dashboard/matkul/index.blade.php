@extends('layouts.main')

@section('container')
    @include('components.navbar')
    {{-- Add matkul --}}

    {{-- Show table from $matkul --}}
    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Total Pertemuan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($matkul as $m)
                <tr>
                    <td>{{ $m->kode_matkul }}</td>
                    <td>{{ $m->nama_matkul }}</td>
                    <td>{{ $m->pertemuan }}</td>
                    <td class="flex">
                        {{-- Edit Button --}}
                        <a href="/dashboard/matkul/{{ $m->id }}/edit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </a>
                        {{-- Delete Button --}}
                        <form action="/dashboard/matkul/{{ $m->id }}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
    </table>
@endsection
