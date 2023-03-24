@extends('master.input')

@section('photos_ti')
    <div class="w-full text-center text-xl font-medium">Gambar TI</div>

    <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col text-gray-900 font-medium">
        @foreach ($all_photos_ti as $key => $photo)
            @php
                $id_target_left = $key - 1;
                $id_target_right = $key + 1;
                $boleh = false;
                if ($key == 0) {
                    $boleh = true;
                    $id_target_left = count($all_photos_ti) - 1;
                }
                if ($key == count($all_photos_ti) - 1) {
                    $id_target_right = 0;
                }
            @endphp
            <div id='img{{ $key }}'
                class='w-full flex items-center justify-between
            @if (!$boleh) {{ 'hidden' }} @endif'>
                <div class="text-center cursor-pointer" onclick='slideImg({{ $key }}, {{ $id_target_left }})'>
                    <i class="bi bi-caret-left-fill text-4xl rounded-lg text-white p-1 bg-gray-700"></i>
                </div>
                <img src="{{ asset("storage/$photo") }}" alt="" class='h-[500px]'
                    style='-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;'>
                <div class="text-center cursor-pointer" onclick='slideImg( {{ $key }}, {{ $id_target_right }})'>
                    <i class="bi bi-caret-right-fill text-4xl rounded-lg text-white p-1 bg-gray-700"></i>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        document.getElementById("photos_ti").classList.add("hidden");
        document.getElementById("kode_ti").value = "{{ $kode_ti }}";
        setTimeout(() => {
            document.getElementById("accordion_input_ti").click();
        }, 500);
        setTimeout(() => {
            loadKodeTI("{{ $kode_ti }}", "{{ $input_ti_detail->input_ti_id }}");
        }, 1000);

        function slideImg(id_this, id_target) {
            document.getElementById(`img${id_this}`).classList.add("hidden");
            document.getElementById(`img${id_target}`).classList.remove("hidden");
        }
    </script>
@endsection
