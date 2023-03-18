@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Input</h1>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item bg-white border border-gray-200 rounded-lg">
            <h2 class="accordion-header mb-0" id="headingTwo">
                <button
                    class="accordion-button collapsed relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
                bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <h1 class="text-xl text-gray-800">
                        Tambah Technical Instruction
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
                            <input type="text" id="kode_ti" name="kode_ti"
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
                                autocomplete="on" name="nomor_laporan_ti" required onchange="getLevelProsesTI(this.value)">
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
                            <input type="text" id="nomor_laporan" name="nama_ti"
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
                            <table class="w-full text-sm text-left text-gray-500">
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
                                <div id="collapseCB1" class="accordion-collapse collapse p-4" aria-labelledby="headingCB"
                                    data-te-collapse-item data-te-collapse-show data-bs-parent="#accordionCBApprovedBy">
                                    <div class="text-center text-xl mb-2">All Minibus</div>
                                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-2">
                                        @foreach ($approved_by_minibus as $department)
                                            {{-- department minibus --}}
                                            <div>
                                                <input id="default-checkbox" type="checkbox" name="cb_minibus_ti[]"
                                                    value="{{ $department->department_id }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cb_ti">
                                                <label for="default-checkbox"
                                                    class="ml-2 text-sm font-medium text-gray-900">{{ $department->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="text-center text-xl mb-2">All Bus</div>
                                    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-2">
                                        @foreach ($approved_by_bus as $department)
                                            {{-- department bus --}}
                                            <div>
                                                <input id="default-checkbox" type="checkbox" name="cb_bus_ti[]"
                                                    value="{{ $department->department_id }}"
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 cb_ti">
                                                <label for="default-checkbox"
                                                    class="ml-2 text-sm font-medium text-gray-900">{{ $department->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="nama_ti"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">User
                                    Defined</label>
                                <div class="w-4"></div>
                                <select id="user_defined_ti" placeholder="User Defined"
                                    class="text-gray-900 text-sm mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                    autocomplete="on" name="user_defined_ti" required>
                                    <option disabled selected value>Pilih User Defined</option>
                                    @foreach ($user_defined as $item)
                                        <option value="{{ $item->user_defined_id }}">{{ $item->name }} - {{ $item->desc }}</option>
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
                                    TI</label>
                                <div class="w-4"></div>
                                <input
                                    class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2.5"
                                    id="multiple_files" type="file" multiple name="photos[]" required>
                            </div>
                            <button type="submit" class="hidden" id="submit_ti"></button>
                            <div onclick="submitTI()"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center w-fit cursor-pointer">Input
                                TI</div>
                    </form>
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
                        Tambah Gambar Teknik
                    </h1>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body py-4 px-5">
                    <form action="{{ url('/dashboard/report/add') }}" method="POST">
                        @csrf
                        <input class="hidden" type="text" name="item_level_id" id="item_level_id">

                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="kode_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 flex-shrink-0 w-32">Kode
                                Gambar</label>
                            <div class="w-4"></div>
                            <input type="text" id="kode_ti" name="nomor"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Kode Gambar" required>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nomor_laporan"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Nomor
                                Laporan</label>
                            <div class="w-4"></div>
                            <input type="text" id="nomor_laporan" name="nomor_laporan"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Nomor Laporan" required>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nama_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Nama
                                Gambar</label>
                            <div class="w-4"></div>
                            <input type="text" id="nomor_laporan" name="nama_gambar"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Nama Gambar">
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nama_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Level
                                Proses</label>
                            <div class="w-4"></div>
                            <select id="level_proses" name="level_proses" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="">Kosong</option>
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

                                <select id="input-component-gambar-teknik" placeholder="Kode Komponen" required
                                    class="text-gray-900 text-sm mt-1 ml-1 focus:ring-blue-500 focus:border-blue-500 block w-full"
                                    autocomplete="off" name="components">
                                    <option value="1">Kosong</option>
                                    <option value="2">Kosong2</option>
                                    {{-- @foreach ($departments as $department)
                                        <option value="{{ $department->department_id }}">{{ $department->name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="w-8"></div>
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="nama_ti"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-52">Nama
                                    Komponen</label>
                                <div class="w-4"></div>
                                <input type="text" readonly id="name" name="nama_komponen"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Nama Komponen" required>
                            </div>
                        </div>
                        <div class="flex lg:flex-row flex-col">
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
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="nama_ti"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Diperiksa
                                Oleh</label>
                            <div class="w-4"></div>
                            <select id="diperiksa_oleh_gambar_teknik" name="diperiksa_oleh[]" required
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full"
                                multiple>
                                <option value="1">Kosong</option>
                                <option value="2">Kosong2</option>
                                {{-- @foreach ($departments as $department)
                                    <option value="{{ $department->department_id }}">{{ $department->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="accordion mb-4" id="accordionCB">
                            <div class="accordion-item bg-white border border-gray-200 rounded-lg mb-4">
                                <h2 class="accordion-header mb-0" id="headingCB">
                                    <button
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
                                    <div class="text-center text-xl mb-2">All Minibus</div>
                                    <div class="grid grid-cols-5 gap-4 mb-2">
                                        <div>
                                            <input id="default-checkbox" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="default-checkbox"
                                                class="ml-2 text-sm font-medium text-gray-900">Default
                                                checkbox</label>
                                        </div>
                                        <div>
                                            <input id="default-checkbox" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="default-checkbox"
                                                class="ml-2 text-sm font-medium text-gray-900">Default
                                                checkbox</label>
                                        </div>
                                        <div>
                                            <input id="default-checkbox" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="default-checkbox"
                                                class="ml-2 text-sm font-medium text-gray-900">Default
                                                checkbox</label>
                                        </div>
                                        <div>
                                            <input id="default-checkbox" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="default-checkbox"
                                                class="ml-2 text-sm font-medium text-gray-900">Default
                                                checkbox</label>
                                        </div>
                                        <div>
                                            <input id="default-checkbox" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="default-checkbox"
                                                class="ml-2 text-sm font-medium text-gray-900">Default
                                                checkbox</label>
                                        </div>
                                    </div>
                                    <div class="text-center text-xl mb-2">All Bus</div>
                                    <div class="grid grid-cols-5 gap-4 mb-2">
                                        <div>
                                            <input id="default-checkbox" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="default-checkbox"
                                                class="ml-2 text-sm font-medium text-gray-900">Default
                                                checkbox</label>
                                        </div>
                                        <div>
                                            <input id="default-checkbox" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="default-checkbox"
                                                class="ml-2 text-sm font-medium text-gray-900">Default
                                                checkbox</label>
                                        </div>
                                        <div>
                                            <input id="default-checkbox" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="default-checkbox"
                                                class="ml-2 text-sm font-medium text-gray-900">Default
                                                checkbox</label>
                                        </div>
                                        <div>
                                            <input id="default-checkbox" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="default-checkbox"
                                                class="ml-2 text-sm font-medium text-gray-900">Default
                                                checkbox</label>
                                        </div>
                                        <div>
                                            <input id="default-checkbox" type="checkbox" value=""
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="default-checkbox"
                                                class="ml-2 text-sm font-medium text-gray-900">Default
                                                checkbox</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="nama_ti"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">User
                                    Defined</label>
                                <div class="w-4"></div>
                                <input type="text" id="user_defined_ti" name="user_defined_ti"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                    placeholder="User Defined" required>
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
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Merujuk</label>
                                <div class="w-4"></div>
                                <input type="text" id="description" name="description"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                    placeholder="Description" required>
                            </div>
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="description"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900  flex-shrink-0 w-32">Merujuk
                                    TI</label>
                                <div class="w-4"></div>
                                <input
                                    class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2.5"
                                    id="multiple_files" type="file" multiple name="photos[]">
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

        let level_proses_ti, diperiksa_oleh, diperiksa_oleh_gambar_teknik, kode_komponen_ti, nomor_laporan_ti,
            input_component_gambar_teknik, user_defined_ti;

        function refreshInput() {
            diperiksa_oleh = generateTom("#diperiksa_oleh")
            diperiksa_oleh_gambar_teknik = generateTom("#diperiksa_oleh_gambar_teknik")
            kode_komponen_ti = generateTom("#kode_komponen_ti")
            level_proses_ti = generateTom("#level_proses_ti")
            nomor_laporan_ti = dropdownInput("#nomor_laporan_ti")
            user_defined_ti = dropdownInput("#user_defined_ti")
            input_component_gambar_teknik = dropdownInput("#input-component-gambar-teknik")
        }
        refreshInput()

        function getLevelProsesTI(nomor_laporan_ti) {
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
                    }
                }
            });
        }

        function getCodeComponentTI() {
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

        function submitTI(){
            let cb_ti = $('input[type=checkbox].cb_ti:checked');
            if(cb_ti.length == 0){
                alert("Pilih setidaknya approved by 1 departemen ");
            }
            else{
                $("#submit_ti").click();
            }
        }

        function resetDataTI() {
            level_proses_ti.clear();
            level_proses_ti.clearOptions();
            kode_komponen_ti.clear();
            kode_komponen_ti.clearOptions();
            getCodeComponentTI();
            getComponentTI();
            $("#komponen_ti").html("");
        }
    </script>
@endsection
