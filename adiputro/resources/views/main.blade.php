<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> --}}
    @vite('resources/js/app.js')
</head>

@include('loading')

<body class="bg-gray-200 min-h-screen" onload="loadingOff()">
    @include('navbar')

    <div class="p-10 mt-16" id="container">
        <div class="bg-white p-10 rounded-md">
            @yield('container')
        </div>
    </div>
    @include('sweetalert::alert')
</body>

<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/tom-select.base.js') }}"></script>
<script src="{{ asset('js/jquery.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

</html>
