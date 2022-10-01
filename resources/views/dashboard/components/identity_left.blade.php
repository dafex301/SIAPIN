<div class="bg-white rounded-lg pb-5 shadow-lg">
    <div class="flex ml-3 pt-3 gap-3">
        <img class="h-14 rounded-full mt-2" src="{{ asset('img/robin.jpg') }}" alt="Robin">
        <div class="text-left">
            @if (auth()->user()->nim == '123')
                <p class="font-bold text-gray-800">Nico Robin</p>
                <p class="text-gray-400">Admin</p>
            @else
                <p class="font-bold text-gray-800">{{ auth()->user()->nama }}</p>
                <p class="text-gray-400">Mahasiswa</p>
            @endif
            <p class="text-sm text-gray-400">Informatika</p>
        </div>
    </div>
</div>
