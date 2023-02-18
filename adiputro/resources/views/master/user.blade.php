@extends('main')
@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master User</h1>
    <div class="text-gray-900">
        <div class="p-4 flex">
            <h1 class="text-3xl">
                Tambah User
            </h1>
        </div>
        <div class="px-3 py-4 w-6/12">
            <form action="{{ url('doRegister') }}" method="POST">
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                    <input type="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="John Doe" required>
                </div>
                <div class="mb-6">
                    <label for="text" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                    <input type="text" id="password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        required>
                </div>
                <div class="mb-6">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Department</label>
                    <select id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                    </select>
                </div>
                <div class="mb-6">
                    <label for="countries" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                    <select id="countries"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @foreach ($roles as $role)
                            <option value="{{ $role->role_id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-6">
                    <label for="repeat-password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" id="repeat-password"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        required>
                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah
                    user baru</button>
            </form>
        </div>
    </div>
    <div class="text-gray-900">
        <div class="p-4 flex">
            <h1 class="text-3xl">
                List User
            </h1>
        </div>
        <div class="px-3 py-4 flex justify-center">
            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Name</th>
                        <th class="text-left p-3 px-5">Department</th>
                        <th class="text-left p-3 px-5">Role</th>
                        <th class="text-left p-3 px-5">Status</th>
                        <th class="text-left p-3 px-5">Action</th>
                    </tr>
                    @foreach ($users as $user)
                        <tr class="border-b hover:bg-orange-100 bg-gray-100">
                            <td class="p-3 px-5"><input type="text" value="{{ $user->full_name }}"
                                    class="bg-transparent"></td>
                            <td class="p-3 px-5"><input type="text" value="{{ $user->department_id }}"
                                    class="bg-transparent"></td>
                            <td class="p-3 px-5">
                                <select value="1" class="bg-transparent">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->role_id }}"
                                            @if ($role->role_id == $user->role_id) selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" value="" class="sr-only peer"
                                        @if ($user->status == 1) checked @endif>
                                    <div
                                        class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-500">
                                        @if ($user->status == 1)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </span>
                                </label>
                            </td>
                            <td class="p-3 px-5 flex justify-end"><button type="button"
                                    class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Save</button><button
                                    type="button"
                                    class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
