<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ $title }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!--fontawesome-->
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="{{ asset('assets/js/instascan.min.js') }}"></script>
    <!--toastr-->
    <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.min.css') }}" />

    <!--sweetalert2-->
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}" />
    @yield('styles')
</head>

<body>
    <div class="app">
            @yield('container')
    </div>
    <!--scripts-->
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!--jquery-->
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
    <!--fontawesome-->
    <script src="{{ asset('assets/fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
    <!--sweetalert2-->
    <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/tableToexcel/dist/tableToExcel.js') }}"></script>
    @yield('scripts')
</body>

</html>
