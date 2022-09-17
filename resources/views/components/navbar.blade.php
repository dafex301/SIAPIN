<script defer src="{{ asset('js/navbar.js') }}"></script>

<div class="bg-gray-900 justify-between items-center flex px-12 py-3">
    <a href="/dashboard">
        <img src="{{ asset('img/undip.png') }}" alt="Universitas Diponegoro" class="h-12">
    </a>
    <div class="flex items-center">
        <div class="cursor-pointer" id="profile">
            <img class="h-12 rounded-full" src="{{ asset('img/robin.jpg') }}" alt="Robin">
        </div>
    </div>
</div>

<div id="profile-popup" class="bg-white shadow-lg rounded-xl h-30 w-36 absolute top-16 right-4 flex-row hidden">
    <div class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-gray-800 rounded-t-xl">Profile</div>
    <div class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-gray-800">Settings</div>
    <div class="p-2 px-4 hover:bg-gray-100 cursor-pointer text-gray-800 rounded-b-xl">
        <form action="/logout" method="POST">
            @csrf
            <button type="submit" class="">Logout</button>
        </form>
    </div>
</div>
