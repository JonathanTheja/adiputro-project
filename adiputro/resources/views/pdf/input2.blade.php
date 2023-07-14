<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technical Information</title>
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
            <div style="height: 230px; border-bottom: 3px solid black">
                <div style="width: 30%;float: left;border-right: 3px solid black;height: 100%">
                    <img src="{{ public_path('img/adiputro_logo.jpg') }}"
                        style="width: 260px;height: 200px;margin: 20px 90px" alt="">
                </div>
                <div
                    style="width: 35%;float: left;border-right: 3px solid black; text-align: center;padding-top: 95px;padding-bottom:95px;text-decoration: underline">
                    TECHNICAL INFORMATION
                </div>
                <div style="width: 35%;float: left;height: 100%; text-align: center">
                    <img src="{{ public_path('img/controlled_copy2.png') }}" alt=""
                        style="width: 80%;padding-top: 20px">
                    <div style="font-size: 26px;padding-top: 30px">NO LAPORAN : LAP/0001/BW/AP/III/2023</div>
                </div>
                <div style="clear: both;"></div>
            </div>
            <div style="padding: 10px 20px;border-bottom: 3px solid black">
                <div>
                    <div style="float: left;width: 200px">No</div>
                    <div style="float: left;">:&nbsp;</div>
                    <div style="float: left;width: 600px; ">(No TI)</div>
                    <div style="float: left;width: 220px">PRINTED AT</div>
                    <div style="float: left;">:&nbsp;</div>
                    <div style="float: left;">EPSON L120 10.10.47.10</div>
                </div>
                <div style="clear: both"></div>
                <div>
                    <div style="float: left;width: 200px">Tanggal</div>
                    <div style="float: left;">:&nbsp;</div>
                    <div style="float: left;width: 600px; ">(Tanggal Input)</div>
                    <div style="float: left;width: 220px">PRINTED BY</div>
                    <div style="float: left;">:&nbsp;</div>
                    <div style="float: left;">BAMBANG / SUB ASSY</div>
                </div>
                <div style="clear: both"></div>
                <div>
                    <div style="float: left;width: 200px">Revisi</div>
                    <div style="float: left;">:&nbsp;</div>
                    <div style="float: left;width: 600px; ">(Berdasarkan Perhitungan Program)</div>
                    <div style="float: left;width: 220px">NO OF PRINT</div>
                    <div style="float: left;">:&nbsp;</div>
                    <div style="float: left;">2</div>
                </div>
                <div style="clear: both"></div>
                <div>
                    <div style="float: left;width: 200px">Lampiran</div>
                    <div style="float: left;">:&nbsp;</div>
                    <div style="float: left;width: 600px; ">(Berdasarkan Perhitungan Program Berapa Lembar)</div>
                    <div style="float: left;width: 220px">PRINT DATE</div>
                    <div style="float: left;">:&nbsp;</div>
                    <div style="float: left;">09 NOVEMBER 2023 AT 16.32</div>
                </div>
                <div style="clear: both"></div>
            </div>
            <div style="border-bottom: 3px solid black">
                <div style="float: left;margin-left: 420px">HAL</div>
                <div style="float: left;margin-left: 670px">MODEL</div>
                <div style="clear: both"></div>
            </div>
            <div style="position: relative;border-bottom: 3px solid black">
                <div style="margin-bottom: -3px;">
                    <div id="firstDiv"
                        style="float:left; width: 900px; word-wrap: break-word;padding: 20px 10px;text-align: center; border-right: 2px solid black;">
                        aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                    </div>
                    <div id="secondDiv"
                        style="float:left; width: 610px; word-wrap: break-word;padding: 20px 10px;text-align: center;margin-left: -2px;border-left: 2px solid black">
                        aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
            @for ($i = 0; $i < 5; $i++)
                <div
                    style="width: 200px;height:250px;position: absolute;border-top: 3px solid black;border-left: 3px solid black;right: {{ ($i % 7) * 200 }}px;bottom: {{ floor($i / 7) * 250 }}px;font-size:25px;">
                    <div style="border-bottom: 3px solid black;text-align: center">DISETUJUI</div>
                </div>
            @endfor
            <div style="position: absolute;bottom: 0;right: 0">
                {{-- {{ $imagePath }} --}}
            </div>
        </div>
    </div>
</body>

</html>
