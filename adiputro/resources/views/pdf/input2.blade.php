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
    @foreach ($photos as $i => $photo)
        {{-- @foreach ([1] as $i => $photo) --}}
        <div
            style="width: 94%;height: 95%;position: static;box-sizing: border-box;margin: 50px; border: 3px solid black;page-break-before: {{ $i > 0 ? 'always' : 'unset' }};">
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
                        <div style="font-size: 26px;padding-top: 30px">NO LAPORAN : {{ $nomor_laporan_ti }}</div>
                    </div>
                    <div style="clear: both;"></div>
                </div>
                <div style="padding: 10px 20px;border-bottom: 3px solid black">
                    <div>
                        <div style="float: left;width: 200px">No</div>
                        <div style="float: left;">:&nbsp;</div>
                        <div style="float: left;width: 600px; ">{{ $no_ti }}</div>
                        <div style="float: left;width: 220px">PRINTED AT</div>
                        <div style="float: left;">:&nbsp;</div>
                        <div style="float: left;">EPSON L120 10.10.47.10</div>
                    </div>
                    <div style="clear: both"></div>
                    <div>
                        <div style="float: left;width: 200px">Tanggal</div>
                        <div style="float: left;">:&nbsp;</div>
                        <div style="float: left;width: 600px; ">{{ $tanggal }}</div>
                        <div style="float: left;width: 220px">PRINTED BY</div>
                        <div style="float: left;">:&nbsp;</div>
                        <div style="float: left;">{{ $printed_by }}</div>
                    </div>
                    <div style="clear: both"></div>
                    <div>
                        <div style="float: left;width: 200px">Revisi</div>
                        <div style="float: left;">:&nbsp;</div>
                        <div style="float: left;width: 600px; ">{{ $revisi }} Kali</div>
                        <div style="float: left;width: 220px">NO OF PRINT</div>
                        <div style="float: left;">:&nbsp;</div>
                        <div style="float: left;">1</div>
                    </div>
                    <div style="clear: both"></div>
                    <div>
                        <div style="float: left;width: 200px">Lampiran</div>
                        <div style="float: left;">:&nbsp;</div>
                        <div style="float: left;width: 600px; ">{{ count($photos) }} Lembar</div>
                        <div style="float: left;width: 220px">PRINT DATE</div>
                        <div style="float: left;">:&nbsp;</div>
                        <div style="float: left;">{{ $print_date }}</div>
                    </div>
                    <div style="clear: both"></div>
                </div>
                @if ($i == 0)
                    <div style="border-bottom: 3px solid black">
                        <div style="float: left;margin-left: 420px">HAL</div>
                        <div style="float: left;margin-left: 670px">MODEL</div>
                        <div style="clear: both"></div>
                    </div>
                    <div style="position: relative;border-bottom: 3px solid black">
                        <div style="margin-bottom: -3px;">
                            <div id="firstDiv"
                                style="float:left; width: 900px; word-wrap: break-word;padding: 20px 10px;text-align: center; border-right: 2px solid black;">
                                {{ $nama_ti }}
                            </div>
                            <div id="secondDiv"
                                style="float:left; width: 610px; word-wrap: break-word;padding: 20px 10px;text-align: center;margin-left: -2px;border-left: 2px solid black">
                                {{ $i < count($item_descriptions) ? $item_descriptions[$i] : '' }}
                            </div>
                            <div style="clear: both"></div>
                        </div>
                    </div>
                @endif
                <div
                    style="height: 1000px; width: 100%; margin: 100px 20px; background-image: url('{{ public_path('gambar_komponen/' . $photo) }}'); background-size: contain; background-repeat: no-repeat; background-position: center;">
                </div>
                @if ($i == 0)
                    @for ($j = 0; $j < count($checked_by); $j++)
                        <div
                            style="width: 200px;height:250px;position: absolute;border-top: 3px solid black;border-left: 3px solid black;right: {{ ($j % 7) * 200 }}px;bottom: {{ floor($j / 7) * 250 }}px;font-size:25px;">
                            <div style="border-bottom: 3px solid black;text-align: center">DISETUJUI</div>
                            <div style="text-align: center;margin: 5px 0;font-size: 20px">
                                {{ strtoupper($checked_by[$j]->name) }}</div>
                        </div>
                    @endfor
                @endif
                <div style="position: absolute;bottom: 0;right: 0">
                    {{-- {{ $imagePath }} --}}
                </div>
            </div>
        </div>
    @endforeach
</body>

</html>
