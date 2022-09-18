<div class="bg-white rounded-lg shadow-lg mt-4 flex flex-col">
    <div>
        <div class="flex items-center flex-row py-3 pl-3 hover:bg-gray-100 rounded-t-lg cursor-pointer ">
            <i class=@php
                // change color based on route
                if (request()->routeIs('dashboard')) {
                    echo '"fa-solid fa-house pr-2"';
                } else {
                    echo '"fa-solid fa-house pr-2 text-gray-400"';
                }
            @endphp></i>
            <p class=@php
                // change color based on route
                if (request()->routeIs('dashboard')) {
                    echo '';
                } else {
                    echo 'text-gray-400';
                }
            @endphp>Home</p>
        </div>
        <div class="flex items-center flex-row py-3 pl-3 hover:bg-gray-100 cursor-pointer">
            <i class=@php
                // change color based on route
                if (request()->routeIs('dashboard/mahasiswa')) {
                    echo '"fa-solid fa-user-group pr-2"';
                } else {
                    echo '"fa-solid fa-user-group pr-2 text-gray-400"';
                }
            @endphp></i>
            <p class=@php
                // change color based on route
                if (request()->routeIs('dashboard/mahasiswa')) {
                    echo '';
                } else {
                    echo 'text-gray-400';
                }
            @endphp>Mahasiswa</p>
        </div>
        <div class="flex items-center flex-row py-3 pl-3 hover:bg-gray-100 cursor-pointer">
            <i class=@php
                // change color based on route
                if (request()->routeIs('dashboard/lab')) {
                    echo '"fa-solid fa-computer pr-2"';
                } else {
                    echo '"fa-solid fa-computer pr-2 text-gray-400"';
                }
            @endphp></i>
            <p class=@php
                // change color based on route
                if (request()->routeIs('dashboard/lab')) {
                    echo '';
                } else {
                    echo 'text-gray-400';
                }
            @endphp>Lab</p>
        </div>
        <div class="flex items-center flex-row py-3 pl-3 hover:bg-gray-100 cursor-pointer">
            <i class=@php
                // change color based on route
                if (request()->routeIs('dashboard/matkul')) {
                    echo '"fa-solid fa-book pr-2"';
                } else {
                    echo '"fa-solid fa-book pr-2 text-gray-400"';
                }
            @endphp></i>
            <p class=@php
                // change color based on route
                if (request()->routeIs('dashboard/matkul')) {
                    echo '';
                } else {
                    echo 'text-gray-400';
                }
            @endphp>Mata Kuliah</p>
        </div>
        <div class="flex items-center flex-row py-3 pl-3 hover:bg-gray-100 cursor-pointer">
            <i class=@php
                // change color based on route
                if (request()->routeIs('dashboard/jadwal')) {
                    echo '"fa-solid fa-calendar pr-2"';
                } else {
                    echo '"fa-solid fa-calendar pr-2 text-gray-400"';
                }
            @endphp></i>
            <p class=@php
                // change color based on route
                if (request()->routeIs('dashboard/jadwal')) {
                    echo '';
                } else {
                    echo 'text-gray-400';
                }
            @endphp>Jadwal</p>
        </div>
        <div class="flex items-center flex-row py-3 pl-3 hover:bg-gray-100 cursor-pointer">
            <i class=@php
                // change color based on route
                if (request()->routeIs('dashboard/presensi')) {
                    echo '"fa-solid fa-bell pr-2"';
                } else {
                    echo '"fa-solid fa-bell pr-2 text-gray-400"';
                }
            @endphp></i>
            <p class=@php
                // change color based on route
                if (request()->routeIs('dashboard/presensi')) {
                    echo '';
                } else {
                    echo 'text-gray-400';
                }
            @endphp>Presensi</p>
        </div>
    </div>
</div>
