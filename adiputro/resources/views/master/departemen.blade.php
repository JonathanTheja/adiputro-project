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
                    <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                    <input type="text" id="full_name" name="full_name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Name" required>
                </div>
                <div class="w-4"></div>
                <div class="mb-4 w-full">
                    <label for="role_id" class="block mb-2 text-sm font-medium text-gray-900">Access Database</label>
                    <select id="role_id" name="role_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Tidak ada</option>
                        {{-- @foreach ($roles as $role)
                            <option value="{{ $role->role_id }}">{{ $role->name }}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>
            <div class="text-left pt-1 mb-12 pb-1">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah
                    departemen baru</button>
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
