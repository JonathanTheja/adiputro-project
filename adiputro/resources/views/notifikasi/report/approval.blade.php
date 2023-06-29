@extends('main')

@section('container')
    <div id="contentContainer" style="position: relative; transition: opacity 0.3s ease;">
    </div>

    <script>
        function fadeIn(element) {
            element.style.opacity = "1";
        }

        function fadeOut(element) {
            element.style.opacity = "0";
        }

        function returnState() {
            const contentContainer = document.getElementById('contentContainer');
            fadeOut(contentContainer);
            setTimeout(() => {
                contentContainer.innerHTML = `
                    <div id="contentContainer">

                        <h1 class="text-center text-5xl font-semibold">Report Approval</h1>
                        <div class="flex justify-center items-center space-x-10" style="height: 450px">
                            <div class="mr-2">
                                <button id="technicalBtn"
                                    class="flex items-center justify-center w-96 h-64 bg-gray-900 hover:bg-gray-600 text-white text-xl font-bold rounded-lg"
                                    onclick="changeContent(0)">
                                    <span class="text-center" style="line-height: 60px; font-size: 45px">Technical Instruction</span>
                                </button>
                            </div>
                            <div>
                                <button
                                    class="flex items-center justify-center w-96 h-64 bg-gray-900 hover:bg-gray-600 text-white text-xl font-bold rounded-lg"
                                    onclick="changeContent(1)">
                                    <span class="text-center" style="line-height: 60px; font-size: 45px">Gambar Teknik</span>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                fadeIn(contentContainer);
            }, 300);
        }
        returnState();

        function changeContent(index) {
            const contentContainer = document.getElementById('contentContainer');
            fadeOut(contentContainer);
            setTimeout(() => {
                if (index == 0) {
                    contentContainer.innerHTML = `
                        <div style="position:absolute;top:10px;left:0;">
                            <button id="arrowBackBtn" class="flex items-center justify-center w-20 h-10" onclick="returnState()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                <span class="text-gray-900">Kembali</span>
                            </button>
                        </div>
                        <h1 class="text-center text-5xl font-semibold mb-5">Report Approval</h1>
                        <div class="accordion-body py-2 overflow-x-auto">
                            <div class="py-4">
                        <table class="w-full text-md bg-white shadow-md rounded mb-2">
                            <tbody>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 pb-3">Kode TI</th>
                                    <th scope="col" class="px-6 pb-3">Revisi</th>
                                    <th scope="col" class="px-6 pb-3">Nomor Laporan</th>
                                    <th scope="col" class="px-6 pb-3">Nama TI</th>
                                    <th scope="col" class="px-6 pb-3">Model</th>
                                    <th scope="col" class="px-6 pb-3">Pembuat</th>
                                    <th scope="col" class="px-6 pb-3">User Defined</th>
                                    <th scope="col" class="px-6 pb-3">Description</th>
                                    <th scope="col" class="px-6 pb-3">Action</th>
                                </tr>
                                @foreach ($input_ti as $input)
                                    <form action="/notifikasi/report/approval/doApprove" method="POST">
                                        <input type="text" class="hidden" name="input_ti_id"
                                            value="{{ $input->input_ti_id }}">
                                        <input type="text" class="hidden" name="penyetuju_id"
                                            value="{{ Auth::user()->user_id }}">
                                        <button class="hidden" id="input{{ $input->input_ti_id }}"></button>
                                    </form>
                                    <tr class="border-b hover:bg-orange-100 bg-gray-100 text-md">
                                        <td class="p-2 py-4"><a class="hover:bg-blue-200"
                                                href="/master/input/ti/detail/{{ $input->input_ti_id }}">{{ $input->kode_ti }}</a>
                                        </td>
                                        @if ($input->revisi == 0)
                                            <td class="p-2 py-4 text-center">Pertama dibuat</td>
                                        @else
                                            <td class="p-2 py-4 text-center">Revisi {{ $input->revisi }}</td>
                                        @endif
                                        <td class="p-2 py-4 whitespace-nowrap"><a class="hover:bg-blue-200"
                                                href="/dashboard/{{ $input->form_report->item_level_id }}">{{ $input->nomor_laporan }}</a>
                                        </td>
                                        <td class="p-2 py-4 text-center">{{ $input->nama_ti }}</td>
                                        <td class="p-2 py-4 text-center">{{ $input->model }}</td>
                                        <td class="p-2 py-4 text-center">{{ $input->pembuat->full_name }}</td>
                                        <td class="p-2 py-4 text-center">{{ $input->user_defined->name }}</td>
                                        <td class="p-2 py-4 text-center">{{ $input->user_defined->desc }}</td>

                                        @if ($input->status == 0)
                                            <td class="p-2 py-4 text-center">Revisi</td>
                                        @else
                                            <td class="border-collapse">
                                                <a href="/master/input/ti/detail/{{ $input->input_ti_id }}">
                                                    <button
                                                        class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium w-full py-7 text-center">Approve
                                                    </button></a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                        </div>
                    `;
                } else {
                    contentContainer.innerHTML = `
                        <div style="position:absolute;top:10px;left:0;">
                            <button id="arrowBackBtn" class="flex items-center justify-center w-20 h-10" onclick="returnState()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-900" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                <span class="text-gray-900">Kembali</span>
                            </button>
                        </div>
                        <h1 class="text-center text-5xl font-semibold mb-5">Report Approval</h1>
                        <div class="accordion-body py-2 overflow-x-auto">
                            <div class="py-4">
                        <table class="w-full text-md bg-white shadow-md rounded mb-2">
                            <tbody>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 pb-3">Kode TI</th>
                                    <th scope="col" class="px-6 pb-3">Kode GT</th>
                                    <th scope="col" class="px-6 pb-3">Process Entry</th>
                                    <th scope="col" class="px-6 pb-3">Revisi</th>
                                    <th scope="col" class="px-6 pb-3">Nomor Laporan</th>
                                    <th scope="col" class="px-6 pb-3">Nama GT</th>
                                    {{-- <th scope="col" class="px-6 pb-3">Model</th>
                                    <th scope="col" class="px-6 pb-3">Pembuat</th> --}}
                                    <th scope="col" class="px-6 pb-3">User Defined</th>
                                    <th scope="col" class="px-6 pb-3">Description</th>
                                    <th scope="col" class="px-6 pb-3">Action</th>
                                </tr>
                                @foreach ($input_gt as $input)
                                    <form action="/notifikasi/report/approval/doApprove" method="POST">
                                        <input type="text" class="hidden" name="input_gt_id"
                                            value="{{ $input->input_gt_id }}">
                                        <input type="text" class="hidden" name="penyetuju_id"
                                            value="{{ Auth::user()->user_id }}">
                                        <button class="hidden" id="input{{ $input->input_ti_id }}"></button>
                                    </form>
                                    <tr class="border-b hover:bg-orange-100 bg-gray-100 text-md">
                                        <td class="p-2 py-4"><a class="hover:bg-blue-200"
                                                href="/master/input/gt/detail/{{ $input->input_gt_id }}">{{ $input->kode_ti }}</a>
                                        </td>
                                        <td class="p-2 py-4"><a class="hover:bg-blue-200"
                                                href="/master/input/gt/detail/{{ $input->input_gt_id }}">{{ $input->kode_gt }}</a>
                                        </td>

                                        <td class="p-2 py-4 text-center">{{ $input->process_entry->work_description }}
                                        </td>
                                        @if ($input->revisi == 0)
                                            <td class="p-2 py-4 text-center">Pertama dibuat</td>
                                        @else
                                            <td class="p-2 py-4 text-center">Revisi {{ $input->revisi }}</td>
                                        @endif
                                        <td class="p-2 py-4 whitespace-nowrap"><a class="hover:bg-blue-200"
                                                href="/dashboard/{{ $input->form_report->item_level_id }}">{{ $input->nomor_laporan }}</a>
                                        </td>
                                        <td class="p-2 py-4 text-center">{{ $input->nama_gt }}</td>
                                        <td class="p-2 py-4 text-center">{{ $input->user_defined->name }}</td>
                                        <td class="p-2 py-4 text-center">{{ $input->user_defined->desc }}</td>
                                        @if ($input->status == 0)
                                            <td class="p-2 py-4 text-center">Revisi</td>
                                        @else
                                            <td class="border-collapse">
                                                <a href="/master/input/gt/detail/{{ $input->input_gt_id }}">
                                                    <button
                                                        class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium w-full py-7 text-center">Approve
                                                    </button></a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                        </div>
                    `;
                }
                fadeIn(contentContainer);
            }, 300);
        }
    </script>
@endsection
