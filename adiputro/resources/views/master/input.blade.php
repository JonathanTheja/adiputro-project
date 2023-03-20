@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Input</h1>
    <div class="accordion accordion_input_ti" id="accordionExample">
        <div class="accordion-item bg-white border border-gray-200 rounded-lg">
            <h2 class="accordion-header mb-0" id="headingTwo">
                <button id="accordion_input_ti"
                    class="accordion-button collapsed relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
                bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <h1 class="text-xl text-gray-800">
                        Tambah Technical Instruction [Input 2]
                    </h1>
                </button>
            </h2>
            <div id="collapseOne" data-te-collapse-item data-te-collapse-show class="accordion-collapse collapse"
                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body py-4 px-5">
                    <form action="{{ url('/master/input/ti/add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input class="hidden" type="text" name="item_level_id" id="item_level_id">

                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="kode_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 flex-shrink-0 w-32">Kode
                                TI</label>
                            <div class="w-4"></div>
                            <input type="text" id="kode_ti" name="kode_ti" oninput="loadKodeTI(this.value)"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Kode TI" required>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nomor_laporan_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Nomor
                                Laporan</label>
                            <div class="w-4"></div>
                            <select id="nomor_laporan_ti" placeholder="Nomor Laporan"
                                class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                autocomplete="off" name="nomor_laporan_ti" required onchange="getLevelProsesTI(this.value)">
                                <option disabled selected value>Pilih Nomor Laporan</option>
                                @foreach ($form_report_ti as $form_report)
                                    <option value="{{ $form_report->nomor_laporan }}">{{ $form_report->nomor_laporan }}
                                    </option>
                                @endforeach
                            </select>
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
                                autocomplete="off" name="level_proses_ti[]" multiple onchange="getCodeComponentTI()">
                                {{-- @foreach ($departments as $department)
                                <option value="{{ $department->department_id }}">{{ $department->name }}</option>
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
                                <input type="text" id="model" name="model" readonly
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
                                @foreach ($diperiksa_oleh as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="accordion mb-4" id="accordionCBApprovedBy">
                            <div class="accordion-item bg-white border border-gray-200 rounded-lg mb-4">
                                <h2 class="accordion-header mb-0" id="headingCB">
                                    <button id="btnApprovedBy1"
                                        class="accordion-button collapsed relative flex items-center w-full py-2 px-5 text-base text-gray-800 text-left
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
                                    <div class="text-center text-xl mb-2">All Minibus</div>
                                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-2">
                                        @foreach ($approved_by_minibus as $department)
                                            {{-- department minibus --}}
                                            <div>
                                                <input id="default-checkbox"
                                                    @if ($pembuat->department->access_database == 'SPK Mini Bus') {{ 'checked' }} @endif
                                                    type="checkbox" name="cb_minibus_ti[]"
                                                    value="{{ $department->department_id }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cb_ti">
                                                <label for="default-checkbox"
                                                    class="ml-2 text-sm font-medium text-gray-900">{{ $department->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- @else --}}
                                    <div class="text-center text-xl mb-2">All Bus</div>
                                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-2">
                                        @foreach ($approved_by_bus as $department)
                                            {{-- department bus --}}
                                            <div>
                                                <input id="default-checkbox"
                                                    @if ($pembuat->department->access_database == 'SPK Bus') {{ 'checked' }} @endif
                                                    type="checkbox" name="cb_bus_ti[]"
                                                    value="{{ $department->department_id }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cb_ti">
                                                <label for="default-checkbox"
                                                    class="ml-2 text-sm font-medium text-gray-900">{{ $department->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- @endif --}}
                                </div>
                            </div>
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="nama_ti"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">User
                                    Defined</label>
                                <div class="w-4"></div>
                                <select id="user_defined_ti" placeholder="User Defined"
                                    class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                    autocomplete="off" name="user_defined_ti" required>
                                    <option disabled selected value>Pilih User Defined</option>
                                    @foreach ($user_defined as $item)
                                        <option value="{{ $item->user_defined_id }}">{{ $item->name }} -
                                            {{ $item->desc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="description"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 flex-shrink-0 w-32">Description</label>
                                <div class="w-4"></div>
                                <input type="text" id="description_ti" name="description"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                    placeholder="Description" required>
                            </div>
                            {{-- saat lihat detail upload photo dimatikan --}}
                            {{-- saat lihat detail button submit dimatikan --}}
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
                            </div>
                            @yield('photos_ti')
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="accordion mt-4 accordion_input_gt" id="accordionExample">
        <div class="accordion-item bg-white border border-gray-200 rounded-lg">
            <h2 class="accordion-header mb-0" id="headingTwo">
                <button
                    class="accordion-button collapsed relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
                bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    <h1 class="text-xl text-gray-800">
                        Tambah Gambar Teknik [Input 3]
                    </h1>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body py-4 px-5">
                    <form action="{{ url('/master/input/gt/add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input class="hidden" type="text" name="item_level_id" id="item_level_id">

                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="kode_gt"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 flex-shrink-0 w-32">Kode
                                Gambar</label>
                            <div class="w-4"></div>
                            <input type="text" id="kode_gt" name="nomor"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Kode Gambar" required>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="kode_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 flex-shrink-0 w-32">Kode
                                TI</label>
                            <div class="w-4"></div>
                            {{-- kode_ti_gt -> kode_ti punya gt --}}
                            <select id="kode_ti_gt" placeholder="Kode TI" required onchange="getGTByKodeTI(this.value)"
                                class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                autocomplete="off" name="kode_ti_gt">
                                <option disabled selected value>Pilih Kode TI</option>
                                @foreach ($input_ti as $input)
                                    <option value="{{ $input->kode_ti }}">{{ $input->kode_ti }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nomor_laporan"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Nomor
                                Laporan</label>
                            <div class="w-4"></div>
                            <input type="text" id="nomor_laporan_gt" name="nomor_laporan_gt" readonly
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Nomor Laporan" required>
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
                            <label for="nama_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Kode
                                Komponen</label>
                            <div class="w-4"></div>
                            <select id="kode_komponen_gt" placeholder="Kode Komponen" required onchange="getComponentGT()"
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
                                <input type="text" readonly id="name" name="nama_komponen_gt"
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
                                @foreach ($diperiksa_oleh as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="accordion mb-4" id="accordionCB">
                            <div class="accordion-item bg-white border border-gray-200 rounded-lg mb-4">
                                <h2 class="accordion-header mb-0" id="headingCB">
                                    <button id="btnApprovedBy2"
                                        class="accordion-button collapsed relative flex items-center w-full py-2 px-5 text-base text-gray-800 text-left
                                bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseCB2"
                                        aria-expanded="false" aria-controls="collapseTwo">
                                        <h1 class="text-md text-gray-800">
                                            Approved By
                                        </h1>
                                    </button>
                                </h2>
                                <div id="collapseCB2" class="p-4" data-te-collapse-item data-te-collapse-show
                                    aria-labelledby="headingCB" data-bs-parent="#accordionCB">
                                    {{-- @if ($pembuat->department->access_database == 'SPK Mini Bus') --}}
                                    <div class="text-center text-xl mb-2">All Minibus</div>
                                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-2">
                                        @foreach ($approved_by_minibus as $department)
                                            {{-- department minibus --}}
                                            <div>
                                                <input id="default-checkbox"
                                                    @if ($pembuat->department->name == $department->name) {{ 'checked' }} @endif
                                                    type="checkbox" name="cb_minibus_gt[]"
                                                    value="{{ $department->department_id }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cb_ti">
                                                <label for="default-checkbox"
                                                    class="ml-2 text-sm font-medium text-gray-900">{{ $department->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- @else --}}
                                    <div class="text-center text-xl mb-2">All Bus</div>
                                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-2">
                                        @foreach ($approved_by_bus as $department)
                                            {{-- department bus --}}
                                            <div>
                                                <input id="default-checkbox"
                                                    @if ($pembuat->department->name == $department->name) {{ 'checked' }} @endif
                                                    type="checkbox" name="cb_minibus_gt[]"
                                                    value="{{ $department->department_id }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cb_ti">
                                                <label for="default-checkbox"
                                                    class="ml-2 text-sm font-medium text-gray-900">{{ $department->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    {{-- @endif --}}
                                </div>
                            </div>
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">

                                <label for="nama_ti"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">User
                                    Defined</label>
                                <div class="w-4"></div>
                                <select id="user_defined_gt" placeholder="User Defined"
                                    class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                    autocomplete="off" name="user_defined_gt" required>
                                    <option disabled selected value>Pilih User Defined</option>
                                    @foreach ($user_defined as $item)
                                        <option value="{{ $item->user_defined_id }}">{{ $item->name }} -
                                            {{ $item->desc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="description"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Description</label>
                                <div class="w-4"></div>
                                <input type="text" id="description" name="description"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                    placeholder="Description" required>
                            </div>
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="description"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Gambar
                                    Teknik</label>
                                <div class="w-4"></div>
                                <input
                                    class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2.5"
                                    id="multiple_files" type="file" multiple name="photos[]">
                            </div>
                            <button type="submit" class="hidden" id="submit_ti"></button>
                            <div onclick="submitGT()"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-fit cursor-pointer">
                                Input Gambar Teknik
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/tom-select.complete.min.js') }}"></script>
    <script>
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

        let level_proses_ti, diperiksa_oleh, diperiksa_oleh_gt, kode_komponen_ti, nomor_laporan_ti,
            user_defined_ti, user_defined_gt, kode_komponen_gt, kode_ti_gt;

        function refreshInput() {
            diperiksa_oleh = generateTom("#diperiksa_oleh")
            kode_komponen_ti = generateTom("#kode_komponen_ti")
            level_proses_ti = generateTom("#level_proses_ti")
            nomor_laporan_ti = generateTom("#nomor_laporan_ti")
            user_defined_ti = generateTom("#user_defined_ti")

            kode_ti_gt = generateTom("#kode_ti_gt")
            diperiksa_oleh_gt = generateTom("#diperiksa_oleh_gt")
            kode_komponen_gt = generateTom("#kode_komponen_gt")
            user_defined_gt = generateTom("#user_defined_gt")
        }
        refreshInput()

        //                                                  param    ini         dan     ini hanya untuk edit
        function getLevelProsesTI(nomor_laporan_ti, level_process_input_ti, item_component_ti) {
            //setiap kali nomor laporan diganti, reset
            resetDataTI();
            $.ajax({
                url: `/master/input/ti/getLevel`,
                type: "POST",
                cache: false,
                data: {
                    nomor_laporan_ti: nomor_laporan_ti
                },
                success: function(response) {
                    if (response.success) {
                        console.log(response.item_level_ti);
                        console.log(level_proses_ti);
                        level_proses_ti.clear();
                        level_proses_ti.clearOptions();
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
                            getCodeComponentTI(item_component_ti);
                        }
                    }
                }
            });
        }

        //                                  param ini hanya untuk edit
        function getCodeComponentTI(item_component_ti) {
            if (level_proses_ti.items.length == 0) {
                kode_komponen_ti.clear();
            } else {
                $.ajax({
                    url: `/master/input/ti/getCodeComponent`,
                    type: "POST",
                    cache: false,
                    data: {
                        level_proses_ti: level_proses_ti.items
                    },
                    success: function(response) {
                        if (response.success) {
                            console.log(response.level_proses_ti);
                            // console.log(response.item_component_process_entry);
                            let items = response.item_component_process_entry;
                            kode_komponen_ti.clear();
                            kode_komponen_ti.clearOptions();
                            items.forEach((item, key) => {
                                kode_komponen_ti.addOption({
                                    value: item.item_component_id,
                                    text: item.item_number
                                });
                            });
                            //cek apakah edit kalau iya show kode komponen
                            if (item_component_ti != undefined) {
                                // alert(item_component_ti.length);
                                item_component_ti.forEach(item => {
                                    kode_komponen_ti.addItem(item.item_component_id);
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
                    url: `/master/input/ti/getComponent`,
                    type: "POST",
                    cache: false,
                    data: {
                        item_component_ids: kode_komponen_ti.items
                    },
                    success: function(response) {
                        if (response.success) {
                            let items = response.item_components;
                            $("#komponen_ti").html("");
                            items.forEach((item, key) => {
                                $("#komponen_ti").append(`<tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    ${key+1}
                                </th>
                                <td class="px-6 py-4">
                                    ${item.item_number}
                                </td>
                                <td class="px-6 py-4">
                                    ${item.item_description}
                                </td>
                            </tr>`);
                            });
                        }
                    }
                });
            }
        }

        function loadKodeTI(kode_ti) {
            // nomor_laporan_ti.addItem("LAP/0004/BW/AP/III/2023");
            $.ajax({
                url: `/master/input/ti/loadInputTI`,
                type: "POST",
                cache: false,
                data: {
                    kode_ti: kode_ti
                },
                success: function(response) {
                    if (response.success) {
                        console.log(response.input_ti);
                        //show nomor_laporan_ti
                        nomor_laporan_ti.addItem(response.input_ti.nomor_laporan);
                        //show nama_ti
                        $("#nama_ti").val(response.input_ti.nama_ti);
                        //show level_proses dulu baru show kode komponen
                        getLevelProsesTI(response.input_ti.nomor_laporan, response.input_ti
                            .level_process_input_ti, response.input_ti.item_component_ti);
                        //show diperiksa_oleh / checkby
                        response.input_ti.checked_by_ti.forEach(user => {
                            // console.log(diperiksa_oleh);
                            diperiksa_oleh.addItem(user.user_id);
                        });
                        //show user_defined
                        user_defined_ti.addItem(response.input_ti.user_defined.user_defined_id);
                        $("#description_ti").val(response.input_ti.description);

                        //show all of approvedby
                        //refresh cb_ti
                        $('input[type=checkbox].cb_ti').each(function() {
                            $(this).prop('checked', false);
                            $(this).prop('disabled', false);
                        });
                        $('input[type=checkbox].cb_ti').each(function() {
                            var cb_ti = $(this);
                            response.input_ti.approved_by_ti.forEach(department => {
                                if (cb_ti.val() == department.department_id) {
                                    // alert("true");
                                    cb_ti.prop('checked', true);
                                    cb_ti.prop('disabled', true);
                                } else if (!cb_ti.prop('disabled')) {
                                    cb_ti.prop('checked', false);
                                    cb_ti.prop('disabled', false);
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

        function resetDataTI() {
            level_proses_ti.clear();
            level_proses_ti.clearOptions();
            kode_komponen_ti.clear();
            kode_komponen_ti.clearOptions();
            diperiksa_oleh.clear();
            $('input[type=checkbox].cb_ti').each(function() {
                $(this).prop('checked', false);
                $(this).prop('disabled', false);
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
                                    item_component_code_ti_id: item.pivot.item_component_code_ti_id
                                },
                                text: item.item_number
                            });
                        });
                    }
                }
            });
        }

        function getComponentGT() {
            if (kode_komponen_gt.items.length == 0) {
                $("#level_proses_gt").val("");
                $("#nama_komponen_gt").val("");
            } else {
                $.ajax({
                    url: `/master/input/gt/getComponent`,
                    type: "POST",
                    cache: false,
                    data: {
                        item_component_id: kode_komponen_gt.items[0]
                    },
                    success: function(response) {
                        if (response.success) {
                            //masih salah
                            console.log(response.request.item_component_id);
                            let items = response.request;

                        }
                    }
                });
            }
        }

        //accordion agak bug
        setTimeout(() => {
            document.getElementById("btnApprovedBy1").click();
            document.getElementById("btnApprovedBy2").click();
        }, 500);
    </script>
@endsection
