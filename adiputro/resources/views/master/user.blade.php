@extends('main')
@section('container')
    <h1 class="text-center text-5xl font-semibold">Master User</h1>
    <div>
        <div class="p-4 flex">
            <h1 class="text-3xl">
                Tambah user
            </h1>
        </div>

        <div class="px-3 py-4">
            <form action="{{ url('doRegister') }}" method="POST">
                @csrf
                <div class="flex lg:flex-row flex-col">
                    <div class="mb-6 w-full">
                        <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900">Full Name</label>
                        <input type="text" id="full_name" name="full_name"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                            placeholder="Full Name" required>
                        @error('full_name')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-4"></div>
                    <div class="mb-6 w-full">
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                        <input type="text" id="username" name="username"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Username"
                            required>
                        @error('username')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex lg:flex-row flex-col">
                    <div class="mb-6 w-full">
                        <label for="department_id" class="block mb-2 text-sm font-medium text-gray-900">Department</label>
                        <select id="department_id" name="department_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @foreach ($departments as $department)
                                <option value="{{ $department->department_id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-4"></div>
                    <div class="mb-6 w-full">
                        <label for="role_id" class="block mb-2 text-sm font-medium text-gray-900">Role</label>
                        <select id="role_id" name="role_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            @foreach ($roles as $role)
                                <option value="{{ $role->role_id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


            <div class="mb-6">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                <input type="password" name="password" id="password" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                @error('password')
                <span class="text-sm text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900">Gender</label>
                <div class="flex">
                    <div class="flex items-center mr-4">
                        <input id="inline-radio" type="radio" value="0" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-radio" class="ml-2 text-sm font-medium text-gray-900">Male</label>
                    </div>
                    <div class="flex items-center mr-4">
                        <input id="inline-2-radio" type="radio" value="1" name="gender" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="inline-2-radio" class="ml-2 text-sm font-medium text-gray-900">Female</label>
                    </div>
                    @error('gender')
                        <span class="text-sm text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Tambah
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
