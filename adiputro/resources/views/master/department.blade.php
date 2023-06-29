{{-- @extends('main')


@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Departemen</h1>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item bg-white border border-gray-200 rounded-lg">
            <h2 class="accordion-header mb-0" id="headingTwo">
                <button
                    class="accordion-button collapsed relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
                bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    <h1 class="text-xl text-gray-800">
                        Tambah Departemen
                    </h1>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body py-4 px-5">
                    <form action="{{ url('/master/departemen/add') }}" method="post">
                        @csrf
                        <div class="flex lg:flex-row flex-col">
                            <div class="mb-4 w-full">
                                <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                <input type="text" id="name" name="name"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Name" required>
                            </div>
                            <div class="w-4"></div>
                            <div class="mb-4 w-full">
                                <label for="access" class="block mb-2 text-sm font-medium text-gray-900">Access
                                    Database</label>
                                <select id="access" name="access_database"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="SPK Mini Bus">SPK Mini Bus</option>
                                    <option value="SPK Bus">SPK Bus</option>
                                </select>
                            </div>
                        </div>
                        <div class="text-left pt-1 mb-6 pb-1">
                            <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah
                                departemen baru</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="text-gray-900">
        <div class="p-4 flex">
            <h1 class="text-3xl">
                Daftar Departemen
            </h1>
        </div>
        <div class="py-4 flex justify-start overflow-x-auto">
            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Department ID</th>
                        <th class="text-left p-3 px-5">Name</th>
                        <th class="text-left p-3 px-5">Access Database</th>
                        <th class="text-center p-3 px-5" colspan="2">Action</th>
                    </tr>
                    @foreach ($departments as $key => $department)
                        <tr class="border-b hover:bg-orange-100 bg-gray-100">
                            <form action="/master/departemen/update" method="post">
                                @csrf
                                <td class="p-3 px-5"><input type="text" value="{{ $department->department_id }}"
                                        class="bg-transparent" name="department_id"></td>
                                <td class="p-3 px-5"><input type="text" value="{{ $department->name }}"
                                        class="bg-transparent" name="name"></td>
                                <td class="p-3 px-5">
                                    <select class="bg-transparent" name="access_database">
                                        <option value="SPK Mini Bus">SPK Mini Bus</option>

                                        <option value="SPK Bus"
                                            @if ($department->access_database == 'SPK Bus') {{ 'selected' }} @endif>SPK Bus</option>
                                    </select>
                                </td>
                                <td class="p-3"><button type="button"
                                        class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                        onclick="confirmUpdate({{ $key }});">Update</button>
                                </td>
                                <button type="submit" class="hidden" id="btnUpdate{{ $key }}"></button>
                            </form>
                            <form action="/master/departemen/delete" method="post">
                                @csrf
                                <input type="text" value="{{ $department->department_id }}" class="bg-transparent hidden"
                                    name="department_id">
                                <td class="p-3 px-5">
                                    <button type="button"
                                        class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                        onclick="confirmDelete({{ $key }});">Delete</button>
                                </td>
                                <button type="submit" class="hidden" id="btnDelete{{ $key }}"></button>
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="{{ asset('js/updatedelete.js') }}"></script>
@endsection --}}


@extends('main')


@section('container')
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <h1 class="text-center text-5xl font-semibold mb-4">Master Departemen</h1>
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent"
            role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">Tambah
                    Departemen</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">Daftar Departemen</button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        <div class="hidden p-4 rounded-lg bg-gray-300" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="py-4 px-5">
                <form action="{{ url('/master/departemen/add') }}" method="post">
                    @csrf
                    <div class="flex lg:flex-row flex-col">
                        <div class="mb-4 w-full">
                            <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                            <input type="text" id="name" name="name"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                placeholder="Name" required>
                        </div>
                        <div class="w-4"></div>
                        <div class="mb-4 w-full">
                            <label for="access" class="block mb-2 text-sm font-medium text-gray-900">Access
                                Database</label>
                            <select id="access" name="access_database"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <option value="SPK Mini Bus">SPK Mini Bus</option>
                                <option value="SPK Bus">SPK Bus</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Tambah
                            departemen baru</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="hidden p-4 rounded-lg bg-gray-300" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
            <div class="text-gray-900">
                <div class="py-4 flex justify-start overflow-x-auto">
                    <table class="w-full text-md bg-white shadow-md rounded mb-4">
                        <tbody>
                            <tr class="border-b">
                                <th class="text-left p-3 px-5">Department ID</th>
                                <th class="text-left p-3 px-5">Name</th>
                                <th class="text-left p-3 px-5">Access Database</th>
                                <th class="text-center p-3 px-5" colspan="2">Action</th>
                            </tr>
                            @foreach ($departments as $key => $department)
                                <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                    <form action="/master/departemen/update" method="post">
                                        @csrf
                                        <td class="p-3 px-5"><input type="text" value="{{ $department->department_id }}"
                                                class="bg-transparent" name="department_id"></td>
                                        <td class="p-3 px-5"><input type="text" value="{{ $department->name }}"
                                                class="bg-transparent" name="name"></td>
                                        <td class="p-3 px-5">
                                            <select class="bg-transparent" name="access_database">
                                                <option value="SPK Mini Bus">SPK Mini Bus</option>

                                                <option value="SPK Bus"
                                                    @if ($department->access_database == 'SPK Bus') {{ 'selected' }} @endif>SPK Bus
                                                </option>
                                            </select>
                                        </td>
                                        <td class="p-3"><button type="button"
                                                class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                                onclick="confirmUpdate({{ $key }});">Update</button>
                                        </td>
                                        <button type="submit" class="hidden" id="btnUpdate{{ $key }}"></button>
                                    </form>
                                    <form action="/master/departemen/delete" method="post">
                                        @csrf
                                        <input type="text" value="{{ $department->department_id }}"
                                            class="bg-transparent hidden" name="department_id">
                                        <td class="p-3 px-5">
                                            <button type="button"
                                                class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                                onclick="confirmDelete({{ $key }});">Delete</button>
                                        </td>
                                        <button type="submit" class="hidden" id="btnDelete{{ $key }}"></button>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/updatedelete.js') }}"></script>
@endsection
