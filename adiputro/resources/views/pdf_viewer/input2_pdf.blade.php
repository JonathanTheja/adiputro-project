<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }
    </style>
</head>

<body>
    <div style="width: 94%;height: 95%;position: static;box-sizing: border-box;margin: 50px; border: 3px solid black">
        <div style="position: relative;">
            <div style="height: 250px; border-bottom: 3px solid black">
                <div style="width: 30%;float: left;border-right: 3px solid black;height: 100%">
                    <img src="{{ public_path('img/adiputro_logo.jpg') }}" style="width: 280px;height: 200px;margin: 20px"
                        alt="">
                </div>
                <div style="width: 35%;float: left;border-right: 3px solid black;height: 100%">
                    Technical Information
                </div>
                <div style="width: 35%;float: left;;height: 100%">
                    Technical Information
                </div>
                <div style="clear: both;"></div>
            </div>
            <div style="position: absolute;bottom: 0;right: 0">
                {{-- {{ $imagePath }} --}}
            </div>
        </div>
    </div>
</body>

</html>
