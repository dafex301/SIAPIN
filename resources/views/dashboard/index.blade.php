@extends('layouts.main')


<script src="https://kit.fontawesome.com/4569be348d.js" crossorigin="anonymous"></script>


<body class="bg-gray-50">
    @section('container')
        @include('components.navbar')
        <div class="flex justify-center">
            <div class="flex justify-center gap-5 py-10 w-3/4">
                <div class="w-1/4">
                    {{-- Top-Left Identity --}}
                    @include('dashboard.components.identity_left')

                    {{-- Bottom-Left Menu --}}
                    @include('dashboard.components.menu_left')
                </div>

                {{-- Right Main Box --}}
                @include('dashboard.components.main_right')
            </div>
        </div>
    @endsection
</body>
