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

<body class="bg-gray-200 min-h-screen">
    @include('sidebar')

    <div class="ml-[250px] p-10" id="container" class="">
        <div class="bg-white p-10 rounded-md">
            @yield('container')
        </div>
    </div>
    @include('sweetalert::alert')
    <select id="select-beast" placeholder="Select a person..." autocomplete="off" onclick="loadSelect()">
        <option value="">Select a person...</option>
        <option value="4">Thomas Edison</option>
        <option value="1">Nikola</option>
        <option value="3">Nikola Tesla</option>
        <option value="5">Arnold Schwarzenegger</option>
    </select>
</body>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/tom-select.base.js') }}"></script>
<script>
    new TomSelect("#select-beast", {
        create: true,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
</script>

</html>
