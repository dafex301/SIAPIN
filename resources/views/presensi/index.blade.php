@extends('dashboard.index')

@section('main_content')
    <h2 class="text-left font-bold text-2xl pl-5 pt-4">
        {{ $page_title }}
    </h2>
    <div class="flex flex-col items-center mt-4">
        <div class="py-2 my-2 overflow-x-auto w-full px-6">
            <div class="inline-block w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Jadwal</th>
                            <th
                                class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                                Waktu</th>
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
                                        {{-- Show time with format HH:MM --}}
                                        {{ $j->hari . ', ' . date('H:i', strtotime($j->jam_mulai)) . '-' . date('H:i', strtotime($j->jam_selesai)) }}
                                    </div>
                                </td>
                                <td class="flex gap-4 border-b border-gray-200 whitespace-no-wrap px-6 py-5">
                                    <a href="/dashboard/presensi/{{ $j->id }}" class="">
                                        <i class="fa fa-eye scale-110 text-green-600 hover:text-green-800 mr-1"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
