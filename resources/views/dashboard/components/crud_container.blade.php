{{-- Show message if success --}}
@if (session('status'))
    <div class=" my-5 mx-5 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">
            {{ session('status') }}
        </strong>
        <span class="block sm:inline">{{ $errors->first() }}</span>
    </div>
@endif

{{-- Show error message --}}
@if (session('error'))
    <div class=" my-5 mx-5 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">
            {{ session('error') }}
        </strong>
        <span class="block sm:inline">{{ $errors->first() }}</span>
    </div>
@endif

<div class="flex justify-between">

    <h2 class="text-left font-bold text-2xl pl-5 pt-4">
        {{ $page_title }}
    </h2>
    <a href="/dashboard/{{ $page }}/create">
        <div
            class="bg-green-500 rounded hover:bg-green-600 text-white py-2 mr-6 mt-4 px-4 items-center shadow-slate-50">
            Tambah
        </div>
    </a>
</div>
