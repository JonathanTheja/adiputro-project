@extends('master.input')

@section('photos_ti')
    <div class="w-full text-center text-xl font-medium">Gambar TI</div>

    @foreach ($all_photos_ti_from_pdf as $photo)
        <div class="flex justify-center items-center">
            <img src="{{ asset("storage/$photo") }}" style="height: 1200px" alt="">
        </div>
    @endforeach

    {{-- @php
        echo 'gambar_komponen/images/input/ti/' . strval(date('Y-m-d H-i-s', $input_ti_detail->created_at->timestamp)) . '/input2.pdf';
    @endphp --}}
    {{-- @foreach ($all_photos_ti as $key => $photo)
        <div class="w-full flex lg:flex-row flex-col text-gray-900 font-medium">
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
            <div id=''
                class='img{{ $key }} img w-full flex items-center justify-between
                @if (!$boleh) {{ 'hidden' }} @endif'>
                <div class="text-center cursor-pointer" onclick='slideImg({{ $id_target_left }})'>
                    <i class="bi bi-caret-left-fill text-4xl rounded-lg text-white p-1 bg-gray-700"></i>
                </div>
                <img src="{{ asset("storage/$photo") }}" alt="" class='h-[500px]'
                    style='-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;'>
                <div class="text-center cursor-pointer" onclick='slideImg( {{ $id_target_right }})'>
                    <i class="bi bi-caret-right-fill text-4xl rounded-lg text-white p-1 bg-gray-700"></i>
                </div>
            </div>
        </div>
        @push('photosPaginationTI')
            <div id='imgPagination{{ $key }}'
                class='img{{ $key }} imgPagination py-1 px-2 cursor-pointer m-1 rounded-lg @if ($boleh) {{ 'bg-blue-500' }}
                @else
                {{ 'bg-gray-200' }} @endif'
                onclick="slideImg({{ $key }})">{{ $key + 1 }}</div>
        @endpush
        @push('photosFullTI')
            <div class="w-full flex items-center justify-center">
                <img src="{{ asset("storage/$photo") }}" alt="" class='h-[500px]'
                    style='-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;'>
            </div>
            <div class="w-full flex items-center justify-center">
                <div id='imgPagination{{ $key }}'
                    class='img{{ $key }} py-1 px-2 cursor-pointer m-1 rounded-lg bg-blue-500'>
                    {{ $key + 1 }}</div>
            </div>
        @endpush
    @endforeach --}}
    <script>
        setTimeout(() => {
            $('#input_menu').addClass('hidden');
            $('.input_ti').removeClass('hidden');
            // $('.input_ti.back_btn').addClass('hidden');
            $('.back_btn.input_ti').html(`
                <a href='/notifikasi/report/approval'>
                    <button class="flex items-center justify-center w-20 h-10 input_container input_ti"
                        style="transition: opacity 0.3s ease;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-900" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span class="text-gray-900">Kembali</span>
                    </button>
                </a>
            `);
            $('.input_ti').css('opacity', 1);
        }, 500);
        document.getElementById("photos_ti").classList.add("hidden");
        document.getElementById("nomor_laporan_ti").value = "{{ $input_ti_detail->nomor_laporan }}";
        setTimeout(() => {
            document.getElementById("accordion_input_ti").click();
        }, 500);
        setTimeout(() => {
            loadKodeTI($("#nomor_laporan_ti").val(), "{{ $input_ti_detail->input_ti_id }}");
            // loadKodeTI("{{ $kode_ti }}", "{{ $input_ti_detail->input_ti_id }}", undefined, false);
            setTimeout(() => {
                // nomor_laporan_ti.clear();
                // nomor_laporan_ti.clearOptions();
                // nomor_laporan_ti.addOption({
                //     value: "{{ $input_ti_detail->form_report->nomor_laporan }}",
                //     text: "{{ $input_ti_detail->form_report->nomor_laporan }}",
                // });
                // nomor_laporan_ti.addItem("{{ $input_ti_detail->form_report->nomor_laporan }}");
            }, 1000);
        }, 1000);

        function slideImg(id_target) {
            let selectedClass = "bg-blue-500";
            let unselectedClass = "bg-gray-200";
            $(`.img`).addClass("hidden");
            $(`.img${id_target}`).removeClass("hidden");
            $(`.imgPagination`).removeClass(selectedClass);
            $(`.imgPagination`).addClass(unselectedClass);
            $(`#imgPagination${id_target}`).removeClass(unselectedClass);
            $(`#imgPagination${id_target}`).addClass(selectedClass);
            // document.getElementById(`img${id_this}`).classList.add("hidden");
            // document.getElementById(`img${id_target}`).classList.remove("hidden");
        }
    </script>
@endsection
