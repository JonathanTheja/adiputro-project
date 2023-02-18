<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-900">
    @include('sidebar')

    <div class="ml-[250px] p-10" id="container" class="">
        <div class="bg-white p-10 rounded-md">
            @yield('container')
        </div>
</body>
<script src="{{ asset('js/sidebar.js') }}"></script>

</html>
