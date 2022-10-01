<div class="w-3/4 pb-3 bg-white rounded-lg shadow-lg">
    {{-- If the route is dashboard --}}
    @if (Route::currentRouteName() == 'dashboard')
        <h2 class="text-left font-bold text-2xl pl-5 pt-4">
            Dashboard
        </h2>
    @endif
    @yield('main_content')
</div>
