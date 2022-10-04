@extends('dashboard.index')
@section('main_content')
    <div class="p-12 py-6">
        <div class="flex my-5 justify-between">
            <div>
                <h1 class="text-2xl font-bold">History Presensi</h1>
            </div>
        </div>
        <table class="min-w-full">
            <thead>
                <tr>
                    <th
                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        Mata Kuliah</th>
                    <th
                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        Pertemuan</th>
                    <th
                        class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                        Waktu</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($presensi as $p)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="">
                                    <div class="text-sm font-medium leading-5 text-gray-900">
                                        {{ $p->irs_id->jadwal_id->nama }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-500">
                                {{ $p->pertemuan }}
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <div class="text-sm leading-5 text-gray-500">
                                {{ $p->created_at }}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
@endsection
