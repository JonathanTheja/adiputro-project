@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Input</h1>
    {{-- <button><a href="/master/input/pdf_viewer">pdf_viewer</a></button> --}}

    <div class="flex justify-center items-center space-x-10"
        style="height: 450px;position: relative; transition: opacity 0.3s ease;opacity: 1" id="input_menu">
        <div class="mr-2">
            <button id="technicalBtn"
                class="flex items-center justify-center w-96 h-64 p-4 bg-[rgb(238,137,128)] hover:bg-[rgb(218,117,108)] text-black text-xl font-bold rounded-3xl"
                onclick="changeContent('input_ti')">
                <span class="text-center" style="line-height: 60px; font-size: 45px">Tambah Technical Instruction</span>
            </button>
        </div>
        <div>
            <button
                class="flex items-center justify-center w-96 h-64 p-4 bg-[rgb(255,205,170)] hover:bg-[rgb(235,185,150)] text-black text-xl font-bold rounded-3xl"
                onclick="changeContent('input_gt')">
                <span class="text-center" style="line-height: 60px; font-size: 45px">Tambah Gambar Teknik</span>
            </button>
        </div>
        <div>
            <button
                class="flex items-center justify-center w-96 h-64 p-4 bg-[rgb(156,184,155)] hover:bg-[rgb(136,164,135)] text-black text-xl font-bold rounded-3xl"
                onclick="changeContent('input_model')">
                <span class="text-center" style="line-height: 60px; font-size: 45px">Tambah Model</span>
            </button>
        </div>
    </div>
    <div class="accordion_input_ti" id="accordion_input_ti">
        <div class="back_btn input_ti">
            <button class="flex items-center justify-center w-20 h-10 hidden input_container input_ti"
                style="transition: opacity 0.3s ease;opacity: 0;" onclick="backToMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-900" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="text-gray-900">Kembali</span>
            </button>
        </div>
        <div class=" bg-white border border-gray-200 rounded-lg hidden input_container input_ti"
            style="transition: opacity 0.3s ease;opacity: 0;" id="">
            <h2 class="mb-0" id="headingTwo">
                <button id="accordion_input_ti"
                    class="relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
                bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="true" aria-controls="">
                    <h1 class="text-xl text-gray-800">
                        Tambah Technical Instruction [Input 2]
                    </h1>
                </button>
            </h2>
            <div id="" data-te-collapse-item data-te-collapse-show class="" aria-labelledby="headingTwo"
                data-bs-parent="#accordion_input_ti">
                <div class=" py-4 px-5">
                    <form action="{{ url('/master/input/ti/addTI') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input class="hidden" type="text" name="item_level_id" id="item_level_id">
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nomor_laporan_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Nomor
                                Laporan</label>
                            <div class="w-4"></div>
                            <select id="nomor_laporan_ti" placeholder="Nomor Laporan"
                                class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                autocomplete="off" name="nomor_laporan_ti" required
                                onchange="loadKodeTI(this.value);

                                getLevelProsesTI(this.value)
                                ">
                                <option disabled selected value>Pilih Nomor Laporan</option>
                                @forelse ($form_report_ti as $form_report)
                                    <option value="{{ $form_report->nomor_laporan }}">{{ $form_report->nomor_laporan }}
                                    </option>
                                @empty
                                @endforelse
                                {{-- @foreach ($form_report_ti as $form_report)
                                    <option value="{{ $form_report->nomor_laporan }}">{{ $form_report->nomor_laporan }}
                                    </option>
                                @endforeach --}}
                                <option value="tambah">
                                    Tambah Baru
                                </option>
                            </select>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="kode_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 flex-shrink-0 w-32">Kode
                                TI</label>
                            <div class="w-4"></div>
                            <input readonly type="text" id="kode_ti" name="kode_ti" {{-- oninput="loadInputTI(this.value,undefined,{{ $form_report_ti }}, true);alert(this.value)" --}}
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Kode TI" required>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nama_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Nama
                                TI</label>
                            <div class="w-4"></div>
                            <input type="text" id="nama_ti" name="nama_ti"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Nama TI" required>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="level_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Level
                                Proses</label>
                            <div class="w-4"></div>
                            <select id="level_proses_ti" placeholder="Level Proses" required
                                class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                autocomplete="off" name="level_proses_ti[]" multiple onchange="getProcessEntryTI()">
                                {{-- @foreach ($departments as $department)
                                <option value="{{ $department->department_id }}">{{ $department->name }}</option>
                            @endforeach --}}
                            </select>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nomor_laporan_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Process
                                Entry</label>
                            <div class="w-4"></div>
                            <select id="process_entry_ti" placeholder="Process Entry" onchange="getCodeComponentTI()"
                                class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                autocomplete="off" name="process_entry_ti" required>
                                <option disabled selected value>Pilih Process Entry</option>
                                {{-- @foreach ($form_report_ti as $form_report)
                                    <option value="{{ $form_report->nomor_laporan }}">{{ $form_report->nomor_laporan }}
                                    </option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="flex lg:flex-row flex-col">
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="nama_ti"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Kode
                                    Komponen</label>
                                <div class="w-4"></div>

                                <select id="kode_komponen_ti" placeholder="Kode Komponen" required
                                    class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                    autocomplete="off" name="kode_komponen_ti[]" multiple onchange="getComponentTI()">
                                    {{-- @foreach ($departments as $department)
                                        <option value="{{ $department->department_id }}">{{ $department->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="flex lg:flex-row flex-col mb-4">
                            <table class="w-full text-sm text-left text-gray-500 shadow-md sm:rounded-lg">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            No
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Kode Komponen
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nama Komponen
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Level
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="komponen_ti">

                                </tbody>
                            </table>
                        </div>
                        <div class="flex lg:flex-row flex-col">
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="nama_ti"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Model</label>
                                <div class="w-4"></div>
                                <input type="text" id="model" name="model"
                                    value="{{ $pembuat->department->name }}"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                    placeholder="Model" required>
                            </div>
                            <div class="w-8"></div>
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="nama_ti"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-32">Pembuat</label>
                                <div class="w-4"></div>
                                <input type="text" readonly id="name" name="pembuat"
                                    value="{{ $pembuat->full_name }}"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Pembuat" required>
                            </div>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nama_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Diperiksa
                                Oleh</label>
                            <div class="w-4"></div>
                            <select id="diperiksa_oleh" name="diperiksa_oleh[]" required placeholder="Diperiksa Oleh"
                                class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full"
                                multiple>
                                @forelse ($diperiksa_oleh as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->full_name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-4" id="accordionCBApprovedBy">
                            <div class=" bg-white border border-gray-200 rounded-lg mb-4">
                                <h2 class="mb-0" id="headingCB">
                                    <button id="btnApprovedBy1"
                                        class="relative flex items-center w-full py-2 px-5 text-base text-gray-800 text-left
                                bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseCB1"
                                        aria-expanded="true" aria-controls="">
                                        <h1 class="text-md text-gray-800">
                                            Approved By
                                        </h1>
                                    </button>
                                </h2>
                                <div id="collapseCB1" class="p-4" aria-labelledby="headingCB" data-te-collapse-item
                                    data-te-collapse-show data-bs-parent="#accordionCBApprovedBy">
                                    {{-- @if ($pembuat->department->access_database == 'SPK Mini Bus') --}}
                                    <div class="text-center text-xl mb-2 bg-gray-100 cursor-pointer"
                                        onclick="allMinibusTI()">All Minibus</div>
                                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-2">
                                        @forelse ($approved_by_minibus as $department)
                                            {{-- department minibus --}}
                                            <div>
                                                <input id="default-checkbox"
                                                    @if ($pembuat->department->access_database == 'SPK Mini Bus') {{ 'checked' }} @endif
                                                    type="checkbox" name="cb_minibus_ti[]"
                                                    value="{{ $department->department_id }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cb_ti minibus">
                                                <label for="default-checkbox"
                                                    class="ml-2 text-sm font-medium text-gray-900">{{ $department->name }}</label>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    {{-- @else --}}
                                    <div class="text-center text-xl mb-2 bg-gray-100 cursor-pointer" onclick="allBusTI()">
                                        All Bus</div>
                                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-2">
                                        @forelse ($approved_by_bus as $department)
                                            {{-- department bus --}}
                                            <div>
                                                <input id="default-checkbox"
                                                    @if ($pembuat->department->access_database == 'SPK Bus') {{ 'checked' }} @endif
                                                    type="checkbox" name="cb_bus_ti[]"
                                                    value="{{ $department->department_id }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cb_ti bus">
                                                <label for="default-checkbox"
                                                    class="ml-2 text-sm font-medium text-gray-900">{{ $department->name }}</label>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nama_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">User
                                Defined</label>
                            <div class="w-4"></div>
                            <select id="user_defined_ti" placeholder="User Defined" onchange="getUserDefinedDescTI();"
                                class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                autocomplete="off" name="user_defined_ti[]" required multiple>
                                <option disabled selected value>Pilih User Defined</option>
                                @forelse ($user_defined as $item)
                                    <option value="{{ $item->user_defined_id }}">{{ $item->name }} -
                                        {{ $item->desc }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        {{-- saat lihat detail upload photo, button submit dimatikan --}}
                        <div id="photos_ti">
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="description"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Gambar
                                    TI</label>
                                <div class="w-4"></div>
                                <input
                                    class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2.5"
                                    id="multiple_files" type="file" multiple name="photos[]" required>
                            </div>
                            <button type="submit" class="hidden" id="submit_ti"></button>
                            <div onclick="submitTI()"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-fit cursor-pointer">
                                Input Technical Instruction
                            </div>
                    </form>
                </div>
                <div class="lg:mb-4 mb-2 ">
                    @yield('photos_ti')</div>
                <div id="photosPaginationTI" class="mb-4 flex justify-center">
                    @stack('photosPaginationTI')
                </div>
                <div class="lg:mb-4 mb-2">
                    @stack('photosFullTI')
                </div>
                @isset($hasUserNowApproved, $input_ti_detail)
                    <div
                        class="focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xl px-5 py-2.5 text-center w-full">
                        User yang sudah Approve
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-4">
                        <table class="w-full text-md text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Username
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Full Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Department
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Role
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($input_ti_approved)
                                    @foreach ($input_ti_approved as $ti_approved)
                                        <tr class="bg-white border-b">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                {{ $ti_approved->user->username }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $ti_approved->user->full_name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $ti_approved->user->department->name }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $ti_approved->user->role->name }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                    @if (!$hasUserNowApproved)
                        @isset($input_ti_detail)
                            @if ($input_ti_detail->status == 1)
                                <form action="{{ url('/master/input/ti/approveTI') }}" method="POST">
                                    @csrf
                                    <input class="hidden" name="input_ti_id" type="text"
                                        value="{{ $input_ti_detail->input_ti_id }}">
                                    <button class="hidden" id="btn_approve_ti" type="submit"></button>
                                    {{-- <div onclick="approveTI()"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full cursor-pointer">
                                Approve
                            </div> --}}
                                    <label for="my-modal-konfirmasi-ti">
                                        <div
                                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full cursor-pointer">
                                            Approve
                                        </div>
                                    </label>
                                </form>
                            @endif
                        @endisset
                    @endif
                @endisset
            </div>
        </div>
    </div>
    <div class="mt-4 accordion_input_gt" id="accordion_input_gt">
        <div class="back_btn input_gt">
            <button class="flex items-center justify-center w-20 h-10 hidden input_container input_gt"
                style="transition: opacity 0.3s ease;opacity: 0;" onclick="backToMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-900" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="text-gray-900">Kembali</span>
            </button>
        </div>
        <div class=" bg-white border border-gray-200 rounded-lg hidden input_container input_gt"
            style="transition: opacity 0.3s ease;opacity: 0;" id="">
            <h2 class="mb-0" id="headingTwo">
                <button id="accordion_input_gt"
                    class="relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
                bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="">
                    <h1 class="text-xl text-gray-800">
                        Tambah Gambar Teknik [Input 3]
                    </h1>
                </button>
            </h2>
            <div id="" class="" aria-labelledby="headingTwo" data-bs-parent="#accordion_input_gt">
                <div class=" py-4 px-5">
                    <form action="{{ url('/master/input/gt/add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input class="hidden" type="text" name="item_level_id" id="item_level_id">
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nomor_laporan"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Nomor
                                Laporan</label>
                            <div class="w-4"></div>
                            {{-- <input type="text" id="nomor_laporan_gt" name="nomor_laporan_gt" readonly
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Nomor Laporan" required> --}}
                            <select id="nomor_laporan_gt" placeholder="Nomor Laporan"
                                class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                autocomplete="off" name="nomor_laporan_gt" required
                                onchange="getProcessEntryGT(this.value);">
                                <option disabled selected value>Pilih Nomor Laporan</option>
                                @if (isset($form_report_gt))
                                    @forelse ($form_report_gt as $form_report)
                                        <option value="{{ $form_report->nomor_laporan }}">
                                            {{ $form_report->nomor_laporan }}
                                        </option>
                                    @empty
                                    @endforelse
                                @endif
                                <option value="tambah">
                                    Tambah Baru
                                </option>
                            </select>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="kode_gt"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 flex-shrink-0 w-32">Kode
                                Gambar</label>
                            <div class="w-4"></div>
                            <input type="text" id="kode_gt" name="kode_gt"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Kode Gambar" required readonly>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="kode_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 flex-shrink-0 w-32">Kode
                                TI</label>
                            <div class="w-4"></div>
                            <input type="text" id="kode_ti_gt" name="kode_ti_gt"
                                oninput="
                                // getGTByKodeTI(this.value)
                                "
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Kode TI">
                            {{-- kode_ti_gt -> kode_ti punya gt --}}
                            {{-- <select id="kode_ti_gt" placeholder="Kode TI" required onchange="getGTByKodeTI(this.value)"
                                class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                autocomplete="off" name="kode_ti_gt">
                                <option disabled selected value>Pilih Kode TI</option>
                                @foreach ($input_ti as $input)
                                    <option value="{{ $input->kode_ti }}">{{ $input->kode_ti }}</option>
                                @endforeach
                            </select> --}}
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nama_gt"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Nama
                                Gambar</label>
                            <div class="w-4"></div>
                            <input type="text" id="nama_gt" name="nama_gt"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Nama Gambar">
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="process_entry_gt"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Process
                                Entry</label>
                            <div class="w-4"></div>
                            <select id="process_entry_gt" placeholder="Process Entry"
                                onchange="getComponentGT(this.value);"
                                class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                autocomplete="off" name="process_entry_gt" required>
                                <option disabled selected value>Pilih Process Entry</option>
                                {{-- @foreach ($form_report_ti as $form_report)
                                    <option value="{{ $form_report->nomor_laporan }}">{{ $form_report->nomor_laporan }}
                                    </option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nama_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Kode
                                Komponen</label>
                            <div class="w-4"></div>
                            <select id="kode_komponen_gt" placeholder="Kode Komponen" required
                                onchange="getDetailComponentGT(this.value)"
                                class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                autocomplete="off" name="kode_komponen_gt">
                                {{-- @foreach ($departments as $department)
                                    <option value="{{ $department->department_id }}">{{ $department->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="flex lg:flex-row flex-col">
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="nama_ti"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Level
                                    Proses</label>
                                <div class="w-4"></div>
                                <input type="text" id="level_proses_gt" name="level_proses_gt" readonly
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                    placeholder="Level Proses">
                            </div>
                            <div class="w-8"></div>
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="nama_ti"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-52">Nama
                                    Komponen</label>
                                <div class="w-4"></div>
                                <input type="text" readonly id="nama_komponen_gt" name="nama_komponen_gt"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Nama Komponen" required>
                            </div>
                        </div>
                        {{-- <div class="flex lg:flex-row flex-col">
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="nama_ti"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Model</label>
                                <div class="w-4"></div>
                                <input type="text" id="model" name="model" readonly
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                    placeholder="Model" required>
                            </div>
                            <div class="w-8"></div>
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="nama_ti"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-52">Pembuat</label>
                                <div class="w-4"></div>
                                <input type="text" readonly id="name" name="pembuat"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Pembuat" required>
                            </div>
                        </div> --}}
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nama_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Diperiksa
                                Oleh</label>
                            <div class="w-4"></div>
                            <select id="diperiksa_oleh_gt" name="diperiksa_oleh_gt[]" required
                                placeholder="Diperiksa Oleh"
                                class="bg-gray-50 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full"
                                multiple>
                                @forelse ($diperiksa_oleh as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->full_name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="mb-4" id="accordionCB">
                            <div class=" bg-white border border-gray-200 rounded-lg mb-4">
                                <h2 class="mb-0" id="headingCB">
                                    <button id="btnApprovedBy2"
                                        class="relative flex items-center w-full py-2 px-5 text-base text-gray-800 text-left
                                bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseCB2"
                                        aria-expanded="false" aria-controls="">
                                        <h1 class="text-md text-gray-800">
                                            Approved By
                                        </h1>
                                    </button>
                                </h2>
                                <div id="collapseCB2" class="p-4" data-te-collapse-item data-te-collapse-show
                                    aria-labelledby="headingCB" data-bs-parent="#accordionCB">
                                    {{-- @if ($pembuat->department->access_database == 'SPK Mini Bus') --}}
                                    <div class="text-center text-xl mb-2 bg-gray-100 cursor-pointer"
                                        onclick="allMinibusGT()">All Minibus</div>
                                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-2">
                                        @forelse ($approved_by_minibus as $department)
                                            {{-- department minibus --}}
                                            <div>
                                                <input id="default-checkbox"
                                                    @if ($pembuat->department->name == $department->name) {{ 'checked' }} @endif
                                                    type="checkbox" name="cb_minibus_gt[]"
                                                    value="{{ $department->department_id }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cb_gt minibus">
                                                <label for="default-checkbox"
                                                    class="ml-2 text-sm font-medium text-gray-900">{{ $department->name }}</label>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    {{-- @else --}}
                                    <div class="text-center text-xl mb-2 bg-gray-100 cursor-pointer" onclick="allBusGT()">
                                        All Bus</div>
                                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-2">
                                        @forelse ($approved_by_bus as $department)
                                            {{-- department bus --}}
                                            <div>
                                                <input id="default-checkbox"
                                                    @if ($pembuat->department->name == $department->name) {{ 'checked' }} @endif
                                                    type="checkbox" name="cb_bus_gt[]"
                                                    value="{{ $department->department_id }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cb_gt bus">
                                                <label for="default-checkbox"
                                                    class="ml-2 text-sm font-medium text-gray-900">{{ $department->name }}</label>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">

                            <label for="nama_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">User
                                Defined</label>
                            <div class="w-4"></div>
                            <select id="user_defined_gt" placeholder="User Defined"
                                class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                autocomplete="off" name="user_defined_gt[]" required multiple
                                onchange="getUserDefinedDescGT(this.value)">
                                <option disabled selected value>Pilih User Defined</option>
                                @forelse ($user_defined as $item)
                                    <option value="{{ $item->user_defined_id }}">{{ $item->name }} -
                                        {{ $item->desc }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>

                        {{-- saat lihat detail upload photo, button submit dimatikan --}}
                        <div id="photos_gt">
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="description"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Gambar
                                    Teknik</label>
                                <div class="w-4"></div>
                                <input
                                    class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2.5"
                                    id="multiple_files" type="file" multiple name="photos[]" required>
                            </div>
                            <button type="submit" class="hidden" id="submit_gt"></button>
                            <div onclick="submitGT()"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-fit cursor-pointer">
                                Input Gambar Teknik
                            </div>
                        </div>
                    </form>
                    <div class="lg:mb-4 mb-2">
                        @yield('photos_gt')
                    </div>
                    <div id="photosPaginationGT" class="mb-4 flex justify-center">
                        @stack('photosPaginationGT')
                    </div>
                    <div class="lg:mb-4 mb-2">
                        @stack('photosFullGT')
                    </div>
                    @isset($hasUserNowApproved, $input_gt_detail)
                        <div
                            class="focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-xl px-5 py-2.5 text-center w-full">
                            User yang sudah Approve
                        </div>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-4">
                            <table class="w-full text-md text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Username
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Full Name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Department
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Role
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($input_gt_approved)
                                        @foreach ($input_gt_approved as $gt_approved)
                                            <tr class="bg-white border-b">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $gt_approved->user->username }}
                                                </th>
                                                <td class="px-6 py-4">
                                                    {{ $gt_approved->user->full_name }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $gt_approved->user->department->name }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $gt_approved->user->role->name }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                        @if (!$hasUserNowApproved)
                            @isset($input_gt_detail)
                                @if ($input_gt_detail->status == 1)
                                    <form action="{{ url('/master/input/gt/approveGT') }}" method="POST">
                                        @csrf
                                        <input class="hidden" name="input_gt_id" type="text"
                                            value="{{ $input_gt_detail->input_gt_id }}">
                                        <input class="hidden" id="item_component_id" name="item_component_id" type="text">
                                        <button class="hidden" id="btn_approve_gt" type="submit"></button>
                                        {{-- <div onclick="approveTI()"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full cursor-pointer">
                                Approve
                            </div> --}}
                                        <label for="my-modal-konfirmasi-gt">
                                            <div
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-full cursor-pointer">
                                                Approve
                                            </div>
                                        </label>
                                    </form>
                                @endif
                            @endisset
                        @endif
                    @endisset
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4 accordion_input_model" id="accordion_input_model">
        <div class="back_btn edit_back_btn">
            <button class="flex items-center justify-center w-20 h-10 hidden input_container input_model"
                style="transition: opacity 0.3s ease;opacity: 0;" onclick="backToMenu()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-900" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="text-gray-900">Kembali</span>
            </button>
        </div>
        <div class=" bg-white border border-gray-200 rounded-lg hidden input_container input_model"
            style="transition: opacity 0.3s ease;opacity: 0;">
            <h2 class="mb-0" id="headingThree">
                <button
                    class="relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
                bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#" aria-expanded="false" aria-controls="">
                    <h1 class="text-xl text-gray-800">
                        Tambah Model [Input 4]
                    </h1>
                </button>
            </h2>
            <div id="" class="" aria-labelledby="headingThree" data-bs-parent="#accordion_input_model">
                <div class=" py-4 px-5">
                    <form action="{{ url('/master/input/gt/add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input class="hidden" type="text" name="item_level_id" id="item_level_id">


                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="kode_model"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Kode
                                Komponen</label>
                            <div class="w-4"></div>
                            <select id="id_komponen_model" placeholder="Kode Komponen" required
                                onchange="getDetailComponentModel(this.value)"
                                class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                autocomplete="off" name="id_komponen_model">
                                @if (isset($item_components))
                                    @forelse ($item_components as $item_component)
                                        <option value="{{ $item_component->item_component_id }}">
                                            {{ $item_component->item_number }}</option>
                                    @empty
                                    @endforelse
                                @endif
                            </select>
                        </div>

                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nama_komponen_model"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 flex-shrink-0 w-32">Nama
                                Komponen</label>
                            <div class="w-4"></div>
                            <input type="text" id="nama_komponen_model" name="nama_komponen_model" oninput=""
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Nama Komponen">
                        </div>


                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="input_gambar_model"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 flex-shrink-0 w-32">Input
                                Gambar Model
                            </label>
                            <div class="container py-10">
                                <div class="flex flex-col" id="table_model">
                                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                                        <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                            <div class="overflow-hidden">
                                                <table class="min-w-full text-left text-sm font-light">
                                                    <thead class="border-b font-medium dark:border-neutral-500">
                                                        <tr>
                                                            <th scope="col" class="px-6 py-4">Tampak</th>
                                                            <th scope="col" class="px-6 py-4">Cek</th>
                                                            <th scope="col" class="px-6 py-4">Opsi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border-b dark:border-neutral-500">
                                                            <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                                Isometri
                                                            </td>
                                                            <td class="whitespace-nowrap px-6 py-4" id="isometri_check">x
                                                            </td>
                                                            <td class="whitespace-nowrap px-6 py-4">
                                                                <a href="javascript:void(0);"
                                                                    onclick="toggleToShowImage(0)">Edit</a>
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b dark:border-neutral-500">
                                                            <td class="whitespace-nowrap px-6 py-4 font-medium">Depan
                                                            </td>
                                                            <td class="whitespace-nowrap px-6 py-4" id="depan_check">x
                                                            </td>
                                                            <td class="whitespace-nowrap px-6 py-4">
                                                                <a href="javascript:void(0);"
                                                                    onclick="toggleToShowImage(1)">Edit</a>
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b dark:border-neutral-500">
                                                            <td class="whitespace-nowrap px-6 py-4 font-medium">
                                                                Belakang
                                                            </td>
                                                            <td class="whitespace-nowrap px-6 py-4" id="belakang_check">x
                                                            </td>
                                                            <td class="whitespace-nowrap px-6 py-4">
                                                                <a href="javascript:void(0);"
                                                                    onclick="toggleToShowImage(2)">Edit</a>
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b dark:border-neutral-500">
                                                            <td class="whitespace-nowrap px-6 py-4 font-medium">Atas
                                                            </td>
                                                            <td class="whitespace-nowrap px-6 py-4" id="atas_check">x</td>
                                                            <td class="whitespace-nowrap px-6 py-4"
                                                                onclick="toggleToShowImage(3)">Edit</td>
                                                        </tr>
                                                        <tr class="border-b dark:border-neutral-500">
                                                            <td class="whitespace-nowrap px-6 py-4 font-medium">Bawah
                                                            </td>
                                                            <td class="whitespace-nowrap px-6 py-4" id="bawah_check">x
                                                            </td>
                                                            <td class="whitespace-nowrap px-6 py-4">
                                                                <a href="javascript:void(0);"
                                                                    onclick="toggleToShowImage(4)">Edit</a>
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b dark:border-neutral-500">
                                                            <td class="whitespace-nowrap px-6 py-4 font-medium">Samping
                                                                Kanan</td>
                                                            <td class="whitespace-nowrap px-6 py-4" id="kanan_check">x
                                                            </td>
                                                            <td class="whitespace-nowrap px-6 py-4">
                                                                <a href="javascript:void(0);"
                                                                    onclick="toggleToShowImage(5)">Edit</a>
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b dark:border-neutral-500">
                                                            <td class="whitespace-nowrap px-6 py-4 font-medium">Samping
                                                                Kiri</td>
                                                            <td class="whitespace-nowrap px-6 py-4" id="kiri_check">x</td>
                                                            <td class="whitespace-nowrap px-6 py-4">
                                                                <a href="javascript:void(0);"
                                                                    onclick="toggleToShowImage(6)">Edit</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white rounded-lg overflow-hidden hidden" id="prev_images_container_model">
                                    <div class="md:flex">
                                        <!-- Image Live Preview -->
                                        <div class="w-full">
                                            <label for="text_model"
                                                class="flex items-center justify-center font-weight-bold"
                                                id="text_model">TAMPAK DEPAN
                                            </label>
                                            <span id="image-name" class="text-gray-500 text-sm"></span>
                                            <img id="preview-image" class="h-64 w-full object-cover" src="">
                                        </div>

                                    </div>
                                    <div class="flex flex-row justify-around mt-2">
                                        <input id="load-image" type="file" accept="image/*" class="hidden">
                                        <label for="load-image"
                                            class="w-full mr-2 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Upload
                                            Gambar</label>

                                        <button type="button" id="remove-image"
                                            class="w-full ml-2 bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Hapus
                                            Gambar</button>
                                    </div>

                                    <div class="flex flex-row justify-center mt-2">
                                        <button type="button" id="back_model_preview"
                                            class="mr-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l"
                                            onclick="toggleToShowImage(-1)">
                                            Kembali
                                        </button>
                                        <button type="button" id="prev-image"
                                            class="mr-2 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-l">
                                            << </button>
                                                <button type="button" id="next-image"
                                                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-r">
                                                    >>
                                                </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="hidden" id="submit_model"></button>
                        <div onclick="submitModel()"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-fit cursor-pointer">
                            Input Model
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden" id="modalKonfirmasiTI">
        <input type="checkbox" id="my-modal-konfirmasi-ti" class="modal-toggle" />
        <label for="my-modal-konfirmasi-ti" class="modal cursor-pointer">
            <label class="modal-box relative" for="">
                <label for="my-modal-konfirmasi-ti" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="text-lg font-bold" id="titleModal">Konfirmasi Approve TI</h3>
                <div class="py-4" id="bodyModal">Username</div>
                <input type="text" class="hidden" id="input_ti_id" value="{{ isset($input_ti_detail) ? $input_ti_detail->input_ti_id : '' }}">
                <input type="text" name="username" id="username"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Username" required>
                <div class="py-4" id="bodyModal">Password</div>
                <input type="password" name="password" id="password"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Password" required>
                <button type="submit" onclick="approveTI()"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Konfirmasi</button>
            </label>
        </label>
    </div>
    <div class="hidden" id="modalKonfirmasiGT">
        <input type="checkbox" id="my-modal-konfirmasi-gt" class="modal-toggle" />
        <label for="my-modal-konfirmasi-gt" class="modal cursor-pointer">
            <label class="modal-box relative" for="">
                <label for="my-modal-konfirmasi-gt" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="text-lg font-bold" id="titleModal">Konfirmasi Approve Gambar Teknik</h3>
                <div class="py-4" id="bodyModal">Username</div>
                <input type="text" name="username_gt" id="username_gt"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Username" required>
                <div class="py-4" id="bodyModal">Password</div>
                <input type="password" name="password_gt" id="password_gt"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Password" required>
                <button type="submit" onclick="approveGT()"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Konfirmasi</button>
            </label>
        </label>
    </div>

    <script>
        const previewImage = document.getElementById('preview-image');
        const loadImage = document.getElementById('load-image');
        const imageName = document.getElementById('image-name');
        const removeImage = document.getElementById('remove-image');
        const prevImage = document.getElementById('prev-image');
        const nextImage = document.getElementById('next-image');

        let texts = ["TAMPAK ISOMETRI", "TAMPAK DEPAN", "TAMPAK BELAKANG", "TAMPAK ATAS", "TAMPAK BAWAH",
            "TAMPAK SAMPING KANAN", "TAMPAK SAMPING KIRI"
        ]
        let currentIndex = 0;
        let totalImages = 7;
        const images = [];

        for (let i = 0; i < texts.length; i++) {
            images.push({
                img: null,
                name: texts[i],
                src: null
            });
        }

        // Load image when input changes
        loadImage.addEventListener('change', () => {
            const file = loadImage.files[0];
            const reader = new FileReader();
            reader.onload = () => {
                previewImage.src = reader.result;
                imageName.textContent = file.name;
                images[currentIndex].img = file;
                images[currentIndex].src = reader.result;
            };
            console.log(images);
            reader.readAsDataURL(file);
            console.log(images);
        });

        function resetCheck() {
            var elements = [$("#isometri_check"), $("#depan_check"), $("#belakang_check"), $("#atas_check"), $(
                "#bawah_check"), $("#kanan_check"), $("kiri_check")];
            for (let i = 0; i < images.length; i++) {
                let image = images[i];
                if (image.img == null) {
                    elements[i].text("x");
                } else {
                    elements[i].text("v");
                }
            }
        }

        function reset() {
            previewImage.src = '';
            loadImage.value = '';
            imageName.textContent = '';
        }


        removeImage.addEventListener('click', () => {
            images[currentIndex].img = null;
            images[currentIndex].src = null;
            reset();
        });

        prevImage.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + totalImages) % totalImages;
            if (images[currentIndex].src != null) {
                previewImage.src = images[currentIndex].src;
            } else {
                reset();
            }

            $("#text_model").text(texts[currentIndex]);
        });

        nextImage.addEventListener('click', () => {
            currentIndex = (currentIndex + 1 + totalImages) % totalImages;
            if (images[currentIndex].src != null) {
                previewImage.src = images[currentIndex].src;
            } else {
                reset();
            }

            $("#text_model").text(texts[currentIndex]);
        });

        function toggleToShowImage(current_index) {
            if (current_index != -1) {
                $("#table_model").addClass("hidden");
                $("#prev_images_container_model").removeClass("hidden");
                previewImage.src = images[current_index].src;
                $("#text_model").text(texts[current_index]);
                currentIndex = current_index;
            } else {
                resetCheck();
                $("#table_model").removeClass("hidden");
                $("#prev_images_container_model").addClass("hidden");
            }
        }

        function submitModel() {
            var formData = new FormData();
            var itemComponentModelId = $("#id_komponen_model").val();
            formData.append('item_component_id', itemComponentModelId);

            for (let i = 0; i < images.length; i++) {
                var file = images[i];
                formData.append('images[]', file.img);
                formData.append('texts[]', file.name);
            }
            $.ajax({
                url: '/master/input/model/add',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response.message);
                    Swal.fire({
                        // text: "You won't be able to revert this!",
                        icon: 'success',
                        title: 'Berhasil Tambah Model!',
                        // showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        // html: `<div class='flex items-center justify-center w-full'>${html}</div>`,
                        // confirmButtonText: 'Yes, Update it!'
                        allowOutsideClick: false
                    })
                },
                error: function(response) {
                    Swal.fire({
                        // text: "You won't be able to revert this!",
                        icon: 'error',
                        title: 'Gagal Tambah Model!',
                        // showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        // html: `<div class='flex items-center justify-center w-full'>${html}</div>`,
                        // confirmButtonText: 'Yes, Update it!'
                        allowOutsideClick: false
                    })
                }
            });

        }

        //agak bug
        setTimeout(() => {
            document.getElementById("btnApprovedBy1").click();
            document.getElementById("btnApprovedBy2").click();
        }, 500);

        setTimeout(() => {
            document.getElementById("modalKonfirmasiTI").classList.remove("hidden");
            document.getElementById("modalKonfirmasiGT").classList.remove("hidden");
        }, 1000);
    </script>


    <script src="{{ asset('js/tom-select.complete.min.js') }}"></script>
    <script>
        function changeContent(id) {
            $('#input_menu').css('opacity', 0);
            setTimeout(() => {
                $('#input_menu').addClass('hidden');
                $(`.${id}`).removeClass('hidden');
                setTimeout(() => {
                    $(`.${id}`).css('opacity', 1);
                }, 50);
            }, 300);
        }

        function backToMenu() {
            $('.input_container').css('opacity', 0);
            setTimeout(() => {
                $('.input_container').addClass('hidden');
                $('#input_menu').removeClass('hidden');
                setTimeout(() => {
                    $('#input_menu').css('opacity', 1);
                }, 50);
            }, 300);
        }

        function generateTom(id) {
            return new TomSelect(id, {
                plugins: {
                    remove_button: {
                        title: 'Remove this item',
                    }
                },
                persist: false,
                // create: true,
                // onDelete: function(values) {
                //     return confirm(values.length > 1 ? 'Apakah anda yakin ingin menghapus ' + values.length +
                //         ' items?' : 'Apakah anda yakin ingin menghapus?');
                // }
            });
        }

        function dropdownInput(id) {
            return new TomSelect(id, {
                plugins: ['dropdown_input'],
            });
        }

        let level_proses_ti, diperiksa_oleh, diperiksa_oleh_gt, process_entry_ti, kode_komponen_ti, nomor_laporan_ti,
            user_defined_ti, user_defined_gt, kode_komponen_gt, kode_ti_gt, kode_komponen_model, kode_gt_model;

        function refreshInput() {
            diperiksa_oleh = generateTom("#diperiksa_oleh")
            kode_komponen_ti = generateTom("#kode_komponen_ti")
            level_proses_ti = generateTom("#level_proses_ti")
            nomor_laporan_ti = generateTom("#nomor_laporan_ti")
            user_defined_ti = generateTom("#user_defined_ti")
            process_entry_ti = generateTom("#process_entry_ti")

            // kode_ti_gt = generateTom("#kode_ti_gt")
            nomor_laporan_gt = generateTom("#nomor_laporan_gt")
            process_entry_gt = generateTom("#process_entry_gt")
            diperiksa_oleh_gt = generateTom("#diperiksa_oleh_gt")
            kode_komponen_gt = generateTom("#kode_komponen_gt")
            user_defined_gt = generateTom("#user_defined_gt")

            // nomor_laporan_gt = generateTom("#nomor_laporan_gt")
            // process_entry_gt = generateTom("#process_entry_gt")
            // diperiksa_oleh_gt = generateTom("#diperiksa_oleh_gt")
            kode_komponen_model = generateTom("#kode_komponen_model")
            kode_gt_model = generateTom("#kode_gt_model")
        }
        refreshInput()

        function allMinibusTI() {
            $('input[type=checkbox].cb_ti.minibus').each(function() {
                $(this).prop('checked', true);
            });
        }

        function allBusTI() {
            $('input[type=checkbox].cb_ti.bus').each(function() {
                $(this).prop('checked', true);
            });
        }

        function allMinibusGT() {
            $('input[type=checkbox].cb_gt.minibus').each(function() {
                $(this).prop('checked', true);
            });
        }

        function allBusGT() {
            $('input[type=checkbox].cb_gt.bus').each(function() {
                $(this).prop('checked', true);
            });
        }
        //                                                  param    ini           ini               ini hanya untuk edit
        function getLevelProsesTI(nomor_laporan_ti, level_process_input_ti, item_component_ti, process_entry_id) {
            //setiap kali nomor laporan diganti, reset
            // resetDataTI();
            if (nomor_laporan_ti == "tambah") {
                window.location.href = "/dashboard";
            } else {
                $.ajax({
                    url: `/master/input/ti/getLevelTI`,
                    type: "POST",
                    cache: false,
                    data: {
                        nomor_laporan_ti: nomor_laporan_ti
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log(response.item_level_ti);
                            console.log(level_proses_ti);
                            if (level_process_input_ti == undefined) {
                                level_proses_ti.clear();
                                level_proses_ti.clearOptions();
                            }
                            response.item_level_ti.forEach((level, key) => {
                                level_proses_ti.addOption({
                                    value: level.item_level_id,
                                    text: `Level ${key} ${level.name}`
                                });
                            });
                            //cek apakah edit
                            if (level_process_input_ti != undefined) {
                                level_process_input_ti.forEach(level => {
                                    level_proses_ti.addItem(level.item_level_id);
                                });
                                //show kode komponen dengan param item_component_ti
                                getProcessEntryTI(process_entry_id);
                                setTimeout(() => {
                                    getCodeComponentTI(item_component_ti);
                                }, 2000);
                            }
                        }
                    }
                });
            }
        }

        function getProcessEntryTI(process_entry_id) {
            if (level_proses_ti.items.length == 0) {
                process_entry_ti.clear();
            } else {
                $.ajax({
                    url: `/master/input/ti/getProcessEntryTI`,
                    type: "POST",
                    cache: false,
                    data: {
                        level_proses_ti: level_proses_ti.items,
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log(response.item_level_process_entry);
                            process_entry_ti.clear();
                            process_entry_ti.clearOptions();
                            response.item_level_process_entry.forEach((level, key) => {
                                process_entry_ti.addOption({
                                    value: level.process_entry_id,
                                    text: level.process_entry.work_description,
                                });
                            });
                            if (process_entry_id != undefined) {
                                process_entry_ti.addItem(process_entry_id);
                            }
                        }
                    }
                })
            };
        }

        //                                  param ini hanya untuk edit
        function getCodeComponentTI(item_component_ti) {
            if (level_proses_ti.items.length == 0 && process_entry_ti.items.length == 0) {
                kode_komponen_ti.clear();
            } else {
                $.ajax({
                    url: `/master/input/ti/getCodeComponentTI`,
                    type: "POST",
                    cache: false,
                    data: {
                        level_proses_ti: level_proses_ti.items,
                        process_entry_id: process_entry_ti.items[0]
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log(response);

                            // // console.log(response.item_component_process_entry);
                            let items = response.item_level_process_entry;
                            kode_komponen_ti.clear();
                            kode_komponen_ti.clearOptions();
                            items.forEach((item, key) => {
                                item.item_components.forEach((item_component, key) => {
                                    kode_komponen_ti.addOption({
                                        value: item_component.pivot
                                            .item_component_process_entry_id,
                                        text: `${item_component.item_number} (LV ${item.item_level.level})`
                                    });
                                });
                            });
                            //cek apakah edit kalau iya show kode komponen

                            // kode_komponen_ti.addItem(1);
                            // kode_komponen_ti.addItem(2);
                            if (item_component_ti != undefined) {
                                item_component_ti.forEach(item => {
                                    let options = kode_komponen_ti.options;
                                    Object.keys(options).forEach(key => {
                                        if (options[key].text.includes(item.item_number)) {
                                            kode_komponen_ti.addItem(key);
                                        }
                                    });
                                });
                            }
                        }
                    }
                });
            }
        }

        function getComponentTI() {
            if (kode_komponen_ti.items.length == 0) {
                $("#komponen_ti").html("");
            } else {
                $.ajax({
                    url: `/master/input/ti/getComponentTI`,
                    type: "POST",
                    cache: false,
                    data: {
                        item_component_process_entry_ids: kode_komponen_ti.items
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log(response.item_component_process_entry);
                            let items = response.item_component_process_entry;
                            $("#komponen_ti").html("");
                            items.forEach((item, key) => {
                                $("#komponen_ti").append(`<tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    ${key+1}
                                </th>
                                <td class="px-6 py-4">
                                    ${item.item_component.item_number}
                                </td>
                                <td class="px-6 py-4">
                                    ${item.item_component.item_description}
                                </td>
                                <td class="px-6 py-4">
                                    Level ${item.item_level_process_entry.item_level.level} ${item.item_level_process_entry.item_level.name}
                                </td>
                            </tr>`);
                            });
                        }
                    }
                });
            }
        }

        function getUserDefinedDescTI() {
            $.ajax({
                url: `/master/input/ti/getUserDefinedDescTI`,
                type: "POST",
                cache: false,
                data: {
                    user_defined_id: user_defined_ti.items[0]
                },
                success: function(response) {
                    if (response.success) {
                        try {
                            $("#description_ti").val(response.user_defined.desc);
                        } catch (error) {

                        }
                    }
                }
            });
        }

        function loadKodeTI(nomor_laporan, input_ti_id) {
            $("#nama_ti").val("");
            $("#kode_ti").val("");
            if (!nomor_laporan) {
                resetDataTI();
                return true;
            }
            // resetDataTI()
            $.ajax({
                url: `/master/input/ti/loadKodeTI`,
                type: "POST",
                cache: false,
                data: {
                    nomor_laporan: nomor_laporan
                },
                success: function(response) {
                    if (response.success) {
                        console.log('response loadkodeti');
                        console.log(response);
                        $('#kode_ti').val(response.kode_ti);
                        if (input_ti_id != undefined) {
                            loadInputTI(response.kode_ti, input_ti_id);
                        } else {
                            loadInputTI(response.kode_ti, response.input_ti_id);
                        }
                    }
                }
            });
        }

        function loadInputTI(kode_ti, input_ti_id, form_report_ti, isEdit) {
            // nomor_laporan_ti.addItem("LAP/0004/BW/AP/III/2023");
            console.log(form_report_ti);
            $.ajax({
                url: `/master/input/ti/loadInputTI`,
                type: "POST",
                cache: false,
                data: {
                    kode_ti: kode_ti,
                    input_ti_id: input_ti_id
                },
                success: function(response) {
                    if (response.success) {
                        console.log(response);

                        // show nama_ti
                        $("#nama_ti").val(response.input_ti.nama_ti);
                        //show level_proses dulu, process entry dulu, show komponen
                        setTimeout(() => {
                            getLevelProsesTI(response.input_ti.nomor_laporan, response.input_ti
                                .level_process_input_ti, response.input_ti.item_component_ti,
                                response.input_ti
                                .process_entry_id);
                        }, 100);


                        //show diperiksa_oleh / checkby
                        response.input_ti.checked_by_ti.forEach(user => {
                            // console.log(diperiksa_oleh);
                            diperiksa_oleh.addItem(user.user_id);
                        });
                        //show user_defined
                        console.log("user_defined");
                        for (const user_defined of response.input_ti.user_defined) {
                            user_defined_ti.addItem(user_defined.user_defined_id);
                        }
                        // setTimeout(() => {
                        //     $("#description_ti").val(response.input_ti.user_defined.desc);
                        // }, 500);

                        //show all of approvedby
                        //refresh cb_ti
                        $('input[type=checkbox].cb_ti').each(function() {
                            $(this).prop('checked', false);
                        });
                        $('input[type=checkbox].cb_ti').each(function() {
                            var cb_ti = $(this);
                            response.input_ti.approved_by_ti.forEach(department => {
                                if (cb_ti.val() == department.department_id) {
                                    // alert("true");
                                    cb_ti.prop('checked', true);
                                }
                            })
                        });
                    }
                }
            });
        }

        function submitTI() {
            let cb_ti = $('input[type=checkbox].cb_ti:checked');
            if (cb_ti.length == 0) {
                alert("Pilih setidaknya approved by 1 departemen ");
            } else {
                $("#submit_ti").click();
            }
        }

        function submitGT() {
            let cb_ti = $('input[type=checkbox].cb_gt:checked');
            if (cb_ti.length == 0) {
                alert("Pilih setidaknya approved by 1 departemen ");
            } else {
                $("#submit_gt").click();
            }
        }

        function resetDataTI() {
            level_proses_ti.clear();
            level_proses_ti.clearOptions();
            kode_komponen_ti.clear();
            kode_komponen_ti.clearOptions();
            diperiksa_oleh.clear();
            process_entry_ti.clearOptions();
            process_entry_ti.clear();
            $('input[type=checkbox].cb_ti').each(function() {
                $(this).prop('checked', false);
            });
            user_defined_ti.clear();
            getCodeComponentTI();
            getComponentTI();
            $("#description_ti").val("");
            $("#komponen_ti").html("");
        }


        // kode_ti_gt = generateTom("#kode_ti_gt")
        // diperiksa_oleh_gt = generateTom("#diperiksa_oleh_gt")
        // kode_komponen_gt = generateTom("#kode_komponen_gt")
        // user_defined_gt = generateTom("#user_defined_gt")
        // function loadKodeGT(){

        // }

        function getGTByKodeTI(kode_ti) {
            $.ajax({
                url: `/master/input/gt/getGTByKodeTI`,
                type: "POST",
                cache: false,
                data: {
                    kode_ti: kode_ti
                },
                success: function(response) {
                    if (response.success) {
                        $("#nomor_laporan_gt").val(response.input_ti.nomor_laporan);
                        //item_components
                        console.log(response.input_ti);
                        let items = response.input_ti.item_component_ti;
                        kode_komponen_gt.clear();
                        kode_komponen_gt.clearOptions();
                        items.forEach((item, key) => {
                            //masih salah
                            kode_komponen_gt.addOption({
                                value: {
                                    item_component_code_ti_id: item.pivot
                                        .item_component_code_ti_id
                                },
                                text: item.item_number
                            });
                        });
                    }
                }
            });
        }

        var item_level_id_gt;
        var level_gt;

        //alur paling pertama setelah nomor_laporan langsung ambil process entry
        //apabila edit cek apakah ada input_gt kalau ada langsung tampilkan semua datanya
        function getProcessEntryGT(nomor_laporan) {
            if (!nomor_laporan) {
                resetDataGT();
            }
            return new Promise((resolve, reject) => {
                // alert(nomor_laporan)
                if (nomor_laporan == "tambah") {
                    window.location.href = "/dashboard";
                } else if (nomor_laporan != "") {
                    $.ajax({
                        url: `/master/input/gt/getProcessEntryGT`,
                        type: "POST",
                        cache: false,
                        data: {
                            nomor_laporan: nomor_laporan
                        },
                        success: function(response) {
                            if (response.success) {
                                console.log(response);
                                $("#kode_gt").val(response.kode_gt);
                                item_level_id_gt = response.item_level_id;
                                level_gt = response.level;
                                process_entry_gt.clear();
                                process_entry_gt.clearOptions();
                                response.item_level_process_entry.forEach((item_level, key) => {
                                    process_entry_gt.addOption({
                                        value: item_level.process_entry_id,
                                        text: item_level.process_entry.work_description,
                                    });
                                });
                                // console.log(process_entry_gt.options);
                                if (response.input_gt_detail != undefined) {
                                    loadInputGT(
                                        response.input_gt_detail.kode_ti,
                                        response.input_gt_detail.nama_gt,
                                        response.input_gt_detail.process_entry.process_entry_id,
                                        response.input_gt_detail.item_component.item_number,
                                        response.input_gt_detail.checked_by_gt,
                                        response.input_gt_detail.approved_by_gt,
                                        response.input_gt_detail.user_defined
                                    );
                                }
                                // When the operation is completed successfully, call the resolve function with the result
                                resolve('Operation completed successfully!');
                            }
                        }
                    });
                }
                // When there's an error, call the reject function with the error
                // reject('An error occurred!');
            });
        }

        function getComponentGT(process_entry_id) {
            return new Promise((resolve, reject) => {
                if (process_entry_gt.items.length == 0) {
                    $("#level_proses_gt").val("");
                    $("#nama_komponen_gt").val("");
                } else {
                    $.ajax({
                        url: `/master/input/gt/getComponentGT`,
                        type: "POST",
                        cache: false,
                        data: {
                            process_entry_id: process_entry_gt.items[0],
                            item_level_id: item_level_id_gt
                        },
                        success: function(response) {
                            if (response.success) {
                                console.log(response.item_components);
                                // alert(response.item_components.length)
                                kode_komponen_gt.clear();
                                kode_komponen_gt.clearOptions();
                                response.item_components.forEach(item_component => {
                                    kode_komponen_gt.addOption({
                                        value: item_component.item_number,
                                        // item_description: item_component.item_description,
                                        text: `Level ${level_gt} ${item_component.item_number}`
                                    });
                                })
                                // When the operation is completed successfully, call the resolve function with the result
                                resolve('Operation completed successfully!');
                            }
                        }
                    });
                }

                // When there's an error, call the reject function with the error
                // reject('An error occurred!');
            });
        }

        function getDetailComponentGT(item_number) {
            $.ajax({
                url: `/master/input/gt/getDetailComponentGT`,
                type: "POST",
                cache: false,
                data: {
                    item_number: item_number,
                },
                success: function(response) {
                    if (response.success) {
                        console.log(response.item_component);
                        $('#level_proses_gt').val(level_gt);
                        try {
                            $('#nama_komponen_gt').val(response.item_component.item_description);
                            $('#item_component_id').val(response.item_component.item_component_id);
                        } catch (error) {

                        }
                    }
                }
            });
        }

        function getDetailComponentModel(item_id) {
            if (item_id != "") {
                $.ajax({
                    url: `/master/input/model/getDetailComponentModel`,
                    type: "POST",
                    cache: false,
                    data: {
                        item_component_id: item_id,
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#nama_komponen_model').val(response.item_component.item_description);
                        }
                    }
                });
            }
        }

        //menampilkan detail gambar teknik
        function loadInputGT(kode_ti, nama_gt, process_entry_id, item_number, checked_by_gt, approved_by_gt,
            user_defined, item_level_process_entry) {
            console.log(process_entry_id)
            console.log(item_number)
            console.log(kode_ti)
            console.log(nama_gt)
            $('#kode_ti_gt').val(kode_ti);
            $('#nama_gt').val(nama_gt);

            // console.log(item_level_process_entry)
            // $('#process_entry_gt').val(input_gt_detail.process_entry.process_entry_id);

            //untuk lihat approve saja cek apakah daftar process entrynya ada
            //karena kalau edit bisa didapat dari onchange nomor_laporan_gt sedangkan approve langsung lihat tidak berubah dari onchange
            if (item_level_process_entry != undefined) {
                process_entry_gt.clear();
                process_entry_gt.clearOptions();
                item_level_process_entry.forEach((item_level, key) => {
                    process_entry_gt.addOption({
                        value: item_level.process_entry_id,
                        text: item_level.process_entry.work_description,
                    });
                });
            }
            process_entry_gt.addItem(process_entry_id);
            // console.log($('#process_entry_gt').val())
            // console.log(process_entry_gt.items[0])
            setTimeout(() => {
                getComponentGT(process_entry_gt.items[0]).then(result => {
                    kode_komponen_gt.addItem(item_number)
                }).catch(error => {});
            }, 1000);

            //diperiksa_oleh_gt
            checked_by_gt.forEach(user => {
                // console.log(diperiksa_oleh);
                diperiksa_oleh_gt.addItem(user.user_id);
            });

            //show all of approvedby
            //refresh cb_ti
            $('input[type=checkbox].cb_gt').each(function() {
                $(this).prop('checked', false);
            });
            $('input[type=checkbox].cb_gt').each(function() {
                var cb_ti = $(this);
                approved_by_gt.forEach(department => {
                    if (cb_ti.val() == department.department_id) {
                        cb_ti.prop('checked', true);
                    }
                })
            });

            for (const u_d of user_defined) {
                user_defined_gt.addItem(u_d.user_defined_id);
            }
        }

        function getDetailGTModel(gt_id) {
            if (gt_id != "") {
                $.ajax({
                    url: `/master/input/model/getDetailGTModel`,
                    type: "POST",
                    cache: false,
                    data: {
                        gt_id: gt_id,
                    },
                    success: function(response) {
                        if (response.success) {
                            let gt = response.gt[0];
                            console.log(gt);
                            // $('#level_proses_gt').val(level_gt);
                            // $('#nama_komponen_gt').val(response.item_component.item_description);
                            $('#user_defined_model').val(gt.user_defined.name);
                            $("#desc_model").val(gt.user_defined.desc);
                        }
                    }
                });
            }
        }

        function getUserDefinedDescGT(user_defined_id) {
            $.ajax({
                url: `/master/input/gt/getUserDefinedDescGT`,
                type: "POST",
                cache: false,
                data: {
                    user_defined_id: user_defined_id
                },
                success: function(response) {
                    if (response.success) {
                        $("#description_gt").val(response.user_defined.desc);
                    }
                }
            });
        }

        function approveTI() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var input_ti_id = document.getElementById("input_ti_id").value;
            if (username == "" || password == "") {
                alert("Username dan password harus terisi!");
            } else {
                $.ajax({
                    url: `/dashboard/report/konfirmasi`,
                    type: "POST",
                    cache: false,
                    data: {
                        "username": username,
                        "password": password,
                        "input_ti_id": input_ti_id,
                    },
                    success: function(response) {
                        if (!response.success) {
                            alert("Data kredensial salah!");
                        } else {
                            $('#btn_approve_ti').click();
                        }
                    }
                });
            }
        }

        function approveGT() {
            var username = document.getElementById("username_gt").value;
            var password = document.getElementById("password_gt").value;
            if (username == "" || password == "") {
                alert("Username dan password harus terisi!");
            } else {
                $.ajax({
                    url: `/dashboard/report/konfirmasi`,
                    type: "POST",
                    cache: false,
                    data: {
                        "username": username,
                        "password": password,
                    },
                    success: function(response) {
                        if (!response.success) {
                            alert("Data kredensial salah!");
                        } else {
                            $('#btn_approve_gt').click();
                        }
                    }
                });
            }
        }

        function resetDataGT() {
            $("#kode_gt").val("");
            $("#level_proses_gt").val("");
            process_entry_gt.clear();
            diperiksa_oleh_gt.clear();
            kode_komponen_gt.clear();
            user_defined_gt.clear();
            $('input[type=checkbox].cb_gt').each(function() {
                $(this).prop('checked', false);
            });
            user_defined_gt.clear();
            $("#description_gt").val("");
            $("#komponen_gt").html("");
        }

        // function loadInputGT(input_gt, ) {
        //     console.log(input_gt);
        // }
    </script>
@endsection
