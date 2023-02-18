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

<body>
    @include('sidebar')
    <div class="containerMaster hidden" id="masterUser">
        @include('master.user')
    </div>
    <div class="containerMaster hidden" id="masterDepartemen">
        @include('master.departemen')
    </div>
    <div class="containerMaster hidden" id="masterStall">
        @include('master.user')
    </div>
    <div class="containerMaster hidden" id="masterLevel">
        @include('master.user')
    </div>
</body>
<script src="{{asset("js/sidebar.js")}}"></script>
</html>
