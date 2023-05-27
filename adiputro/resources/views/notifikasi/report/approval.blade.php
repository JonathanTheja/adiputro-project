@extends('main')
@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Report Approval</h1>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item bg-white border border-gray-200 rounded-lg">
            <h2 class="accordion-header mb-0" id="headingTwo">
                <button
                    class="accordion-button collapsed relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
                bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <h1 class="text-xl text-gray-800">
                        Input Technical Instruction
                    </h1>
                </button>
            </h2>
            <div id="collapseOne" data-te-collapse-item data-te-collapse-show class="accordion-collapse collapse"
                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
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
            </div>
        </div>
    </div>

    <div class="accordion mt-4" id="accordionExample">
        <div class="accordion-item bg-white border border-gray-200 rounded-lg">
            <h2 class="accordion-header mb-0" id="headingTwo">
                <button
                    class="accordion-button collapsed relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
                bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    <h1 class="text-xl text-gray-800">
                        Input Gambar Teknik
                    </h1>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
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
            </div>
        </div>
    </div>
    <script>
        //accordion agak bug
        // setTimeout(() => {
        //     document.getElementById("btnAccordion").click();
        // }, 500);
    </script>
@endsection
