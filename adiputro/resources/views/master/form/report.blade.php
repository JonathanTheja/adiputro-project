@extends('main')
@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Form Report</h1>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item bg-white border border-gray-200 rounded-lg">
            <h2 class="accordion-header mb-0" id="headingTwo">
                <button
                    class="accordion-button collapsed relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
            bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    <h1 class="text-xl text-gray-800">
                        Tambah Report
                    </h1>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body py-4 px-5">
                    <form action="{{ url('/master/form/report/add') }}" method="POST">
                        @csrf
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="full_name"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Nomor
                                Laporan</label>
                            <div class="w-4"></div>
                            <input disabled type="text" id="full_name" name="nomor" value="{{ $nomor_laporan }}"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Nomor Laporan" required>
                            <input type="text" id="full_name" name="nomor_laporan" value="{{ $nomor_laporan }}"
                                class="hidden shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 w-full p-2.5"
                                placeholder="Nomor Laporan" required>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col justify-start">
                            <label for="full_name"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Tanggal</label>
                            <div class="w-4"></div>
                            <input disabled type="text" id="full_name" name="tanggal" value="{{ $tanggal }}"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Nomor Laporan">
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="full_name"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Pelapor</label>
                            <div class="w-4"></div>
                            <input type="text" id="full_name" name="pelapor"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5 "
                                placeholder="Pelapor" required>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="full_name"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Departemen</label>
                            <div class="w-4"></div>
                            <input type="text" id="full_name" name="departemen"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5 "
                                placeholder="Departemen" required>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="full_name"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Kategori</label>
                            <div class="w-4"></div>
                            <input type="text" id="full_name" name="kategori"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5 "
                                placeholder="Kategori" required>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="full_name"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Temuan</label>
                            <div class="w-4"></div>
                            <input type="text" id="full_name" name="temuan"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5 "
                                placeholder="Temuan" required>
                        </div>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Tambah
                            report baru</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="text-gray-900">
        <div class="p-4 flex">
            <h1 class="text-3xl">
                Daftar User
            </h1>
        </div>
        <div class="py-4 flex justify-start overflow-x-auto">

            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Nomor Laporan</th>
                        <th class="text-left p-3 px-5 w-40">Tanggal</th>
                        <th class="text-left p-3 px-5">Pelapor</th>
                        <th class="text-left p-3 px-5">Departemen</th>
                        <th class="text-left p-3 px-5">Kategori</th>
                        <th class="text-left p-3 px-5">Temuan</th>
                    </tr>
                    @foreach ($form_reports as $form_report)
                        <tr class="border-b hover:bg-orange-100 bg-gray-100">
                            <td class="p-3 px-5">{{ $form_report->nomor_laporan }}</td>
                            <td class="p-3 px-5">{{ date('d-m-Y', strtotime($form_report->tanggal)) }}</td>
                            <td class="p-3 px-5">{{ $form_report->pelapor->full_name }}</td>
                            <td class="p-3 px-5">{{ $form_report->pelapor->department->name }}</td>
                            <td class="p-3 px-5">{{ $form_report->kategori }}</td>
                            <td class="p-3 px-5">{{ $form_report->temuan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
