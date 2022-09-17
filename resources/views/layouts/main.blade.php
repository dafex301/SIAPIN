<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <title>{{ $title }}</title>
</head>

<body class="bg-gray-50">
    @yield('container')
</body>

</html>
