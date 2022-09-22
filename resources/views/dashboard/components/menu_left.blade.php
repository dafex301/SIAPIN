<div class="bg-white rounded-lg shadow-lg mt-4 flex flex-col">
    <div>
        <div class="flex items-center flex-row py-3 pl-3 hover:bg-gray-100 rounded-t-lg cursor-pointer ">
            <i class="{{ (request() -> is('dashboard')) ? 'fa-solid fa-house pr-2' : 'fa-solid fa-house pr-2 text-gray-400'}}"></i>
            <p class="{{ (request() -> is('dashboard')) ? '' : 'text-gray-400'}}">Home</p>
        </div>
        <div class="flex items-center flex-row py-3 pl-3 hover:bg-gray-100 cursor-pointer">
            <i class="{{ (request() -> is('mahasiswa')) ? 'fa-solid fa-user-group pr-2' : 'fa-solid fa-user-group pr-2 text-gray-400'}}"></i>
            <p class="{{ (request() -> is('mahasiswa')) ? '' : 'text-gray-400'}}">Mahasiswa</p>
        </div>
        <div class="flex items-center flex-row py-3 pl-3 hover:bg-gray-100 cursor-pointer">
            <i class="{{ (request() -> is('dashboard/lab')) ? 'fa-solid fa-computer pr-2' : 'fa-solid fa-computer pr-2 text-gray-400'}}"></i>
            <p class="{{ (request() -> is('dashboard/lab')) ? '' : 'text-gray-400'}}">Lab</p>
        </div>
        <div class="flex items-center flex-row py-3 pl-3 hover:bg-gray-100 cursor-pointer">
            <i class="{{ (request() -> is('dashboard/matkul')) ? 'fa-solid fa-book pr-2' : 'fa-solid fa-book pr-2 text-gray-400'}}"></i>
            <p class="{{ (request() -> is('dashboard/matkul')) ? '' : 'text-gray-400'}}">Mata Kuliah</p>
        </div>
        <div class="flex items-center flex-row py-3 pl-3 hover:bg-gray-100 cursor-pointer">
            <i class="{{ (request() -> is('dashboard/jadwal')) ? 'fa-solid fa-calendar pr-2' : 'fa-solid fa-calendar pr-2 text-gray-400'}}"></i>
            <p class="{{ (request() -> is('dashboard/jadwal')) ? '' : 'text-gray-400'}}">Jadwal</p>
        </div>
        <div class="flex items-center flex-row py-3 pl-3 hover:bg-gray-100 cursor-pointer">
            <i class="{{ (request() -> is('dashboard/presensi')) ? 'fa-solid fa-bell pr-2' : 'fa-solid fa-bell pr-2 text-gray-400'}}"></i>
            <p class="{{ (request() -> is('dashboard/presensi')) ? '' : 'text-gray-400'}}">Presensi</p>
        </div>
    </div>
</div>
