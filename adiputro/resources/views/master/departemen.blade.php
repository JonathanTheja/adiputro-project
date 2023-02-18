@extends('main')


@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Departemen</h1>
    <div class="text-gray-900">
        <form>
            <div class="py-4 flex">
                <h1 class="text-3xl">
                    Add Department
                </h1>
            </div>
            <div class="flex lg:flex-row flex-col">
                <div class="mb-4 w-full">
                    <input type="text"
                        class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="exampleFormControlInput1" placeholder="Nama" />
                </div>
                <div class="w-4"></div>
                <div class="mb-4 w-full">
                    <div class="w-full">
                        <div>
                            <div class="dropup relative w-full">
                                <button
                                    class="dropdown-toggle px-6 py-2.5 bg-blue-600 text-white text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg active:text-white transition duration-150 ease-in-out flex items-center whitespace-nowrap w-full"
                                    type="button" id="dropdownMenuButton1u" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Pilih Akses Database
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-up"
                                        class="w-2 ml-2" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512">
                                        <path fill="currentColor"
                                            d="M288.662 352H31.338c-17.818 0-26.741-21.543-14.142-34.142l128.662-128.662c7.81-7.81 20.474-7.81 28.284 0l128.662 128.662c12.6 12.599 3.676 34.142-14.142 34.142z">
                                        </path>
                                    </svg>
                                </button>
                                <ul class="
                                dropdown-menu
                                min-w-max
                                absolute
                                hidden
                                bg-white
                                text-base
                                z-50
                                float-left
                                py-2
                                list-none
                                text-left
                                rounded-lg
                                shadow-lg
                                mt-1
                                m-0
                                bg-clip-padding
                                border-none
                                "
                                    aria-labelledby="dropdownMenuButton1u">
                                    <li>
                                        <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-black hover:bg-blue-500 hover:text-white p-2"
                                            href="#">SPK MINI BUS</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent text-black hover:bg-blue-500 hover:text-white p-2"
                                            href="#">SPK BUS</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center pt-1 mb-12 pb-1">
                <button
                    class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-slate-200 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3 hover:text-black bg-gray-900"
                    type="button" data-mdb-ripple="true" data-mdb-ripple-color="light">
                    Tambah
                </button>
            </div>
        </form>
        <div class="py-4 flex">
            <h1 class="text-3xl">
                Daftar Departemen
            </h1>
        </div>
        <div class="py-4 flex justify-center overflow-auto">
            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Name</th>
                        <th class="text-left p-3 px-5">Department</th>
                        <th class="text-center p-3 px-5">Role</th>
                        <th class="text-center p-3 px-5">Status</th>
                        <th class="text-center p-3 px-5">Action</th>
                    </tr>
                    <tr class="border-b hover:bg-orange-100 bg-gray-100">
                        <td class="p-3 px-5"><input type="text" value="user.name" class="bg-transparent"></td>
                        <td class="p-3 px-5"><input type="text" value="user.email" class="bg-transparent"></td>
                        <td class="p-3 px-5">
                            <select value="user.role" class="bg-transparent">
                                <option value="user">user</option>
                                <option value="admin">admin</option>
                            </select>
                        </td>
                        <td>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer" checked>
                                <div
                                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Active</span>
                            </label>
                        </td>
                        <td class="p-3 px-5 flex justify-end"><button type="button"
                                class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Update</button><button
                                type="button"
                                class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
