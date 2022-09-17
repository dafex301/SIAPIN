<div class="w-3/4 pb-3 bg-white rounded-lg shadow-lg">
    {{-- If the path is /dashboard --}}
    @if (Request::path() == 'dashboard')
        <h1 class="text-2xl m-6 font-semibold">Dashboard</h1>
    @endif
    @yield('main_content')
</div>
