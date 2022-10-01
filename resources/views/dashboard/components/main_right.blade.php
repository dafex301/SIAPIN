<div class="w-3/4 pb-3 bg-white rounded-lg shadow-lg">
    {{-- If the route is dashboard --}}
    @if (Route::currentRouteName() == 'dashboard')
        <h2 class="text-left font-bold text-2xl pl-5 pt-4">
            Dashboard
        </h2>
        {{-- Hello user->name --}}
        <div class="flex flex-col items-center mt-5">
            <h2 class="text-3xl font-semibold mt-5">
                Selamat Datang, {{ Auth::user()->nama }}
            </h2>
            <h2 class="text-xl">Semoga harimu "menyenangkan" 😁</h2>
        </div>
    @endif
    @yield('main_content')
</div>
