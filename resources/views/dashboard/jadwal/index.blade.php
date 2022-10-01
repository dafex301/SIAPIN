@extends('dashboard.index')

@section('main_content')
    @include('dashboard.components.crud_container')
    <div class="flex flex-col items-center mt-4">
        <div class="py-2 my-2 overflow-x-auto w-full px-6">
            <div class="inline-block w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Nama</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Lab</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Jadwal</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Asprak 1</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Asprak 2</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach ($jadwal as $j)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex items-center">
                                        <div class="">
                                            <div class="text-sm font-medium leading-5 text-gray-900">
                                                {{ $j->nama }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $j->lab->nama }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{-- Show time with format HH:MM --}}
                                        {{ $j->hari . ', ' . date('H:i', strtotime($j->jam_mulai)) . '-' . date('H:i', strtotime($j->jam_selesai)) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $j->asprak1->nama }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500">
                                        @if ($j->asprak2)
                                            {{ $j->asprak2->nama }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                </td>
                                <td class="flex gap-4 border-b border-gray-200 whitespace-no-wrap px-6 pt-8 pb-5">
                                    <a href="/dashboard/jadwal/{{ $j->id }}" class="">
                                        <i class="fa fa-eye scale-110 text-green-600 hover:text-green-800 pt-1 mr-1"></i>
                                    </a>
                                    <a href="/dashboard/jadwal/{{ $j->id }}/edit" class="">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="w-6 h-6 text-blue-400 hover:text-blue-600 cursor-pointer" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </a>
                                    {{-- Delete Button --}}
                                    <form action="/dashboard/jadwal/{{ $j->id }}"
                                        onsubmit="return confirm('Anda yakin untuk menghapus jadwal ini?')" method="POST"
                                        class="flex items-center">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="w-6 h-6 text-red-400 hover:text-red-600 cursor-pointer"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
