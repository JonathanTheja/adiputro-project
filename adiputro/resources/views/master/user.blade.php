{{-- @extends('main')
@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master User</h1>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item bg-white border border-gray-200 rounded-lg">
            <h2 class="accordion-header mb-0" id="headingTwo">
                <button
                    class="accordion-button collapsed relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
            bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    <h1 class="text-xl text-gray-800">
                        Tambah User
                    </h1>
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body py-4 px-5">
                    <form action="{{ url('doRegister') }}" method="POST">
                        @csrf
                        <div class="flex lg:flex-row flex-col">
                            <div class="mb-6 w-full">
                                <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900">Full
                                    Name</label>
                                <input type="text" id="full_name" name="full_name"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5 "
                                    placeholder="Full Name" required>
                                @error('full_name')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-4"></div>
                            <div class="mb-6 w-full">
                                <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                                <input type="text" id="username" name="username"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="Username" required>
                                @error('username')
                                    <span class="text-sm text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex lg:flex-row flex-col">
                            <div class="mb-6 w-full">
                                <label for="department_id"
                                    class="block mb-2 text-sm font-medium text-gray-900">Department</label>
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
                            <input type="password" name="password" id="password"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Password" required>
                            @error('password')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                            <div class="mb-6 mt-6">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Gender</label>
                                <div class="flex">
                                    <div class="flex items-center mr-4">
                                        <input id="inline-radio" type="radio" value="0" name="gender"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="inline-radio"
                                            class="ml-2 text-sm font-medium text-gray-900">Male</label>
                                    </div>
                                    <div class="flex items-center mr-4">
                                        <input id="inline-2-radio" type="radio" value="1" name="gender"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="inline-2-radio"
                                            class="ml-2 text-sm font-medium text-gray-900">Female</label>
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
                        <th class="text-left p-3 px-5">Name</th>
                        <th class="text-left p-3 px-5">Department</th>
                        <th class="text-left p-3 px-5">Role</th>
                        <th class="text-left p-3 px-5">Status</th>
                        <th class="text-center p-3 px-5" colspan="2">Action</th>
                    </tr>
                    @foreach ($users as $key => $user)
                        <tr class="border-b hover:bg-orange-100 bg-gray-100">
                            <form action="/master/user/update" method="post">
                                @csrf
                                <input class="hidden" type="text" name="user_id" value="{{ $user->user_id }}">
                                <td class="p-3 px-5">
                                    <input type="text" value="{{ $user->full_name }}" class="bg-transparent"
                                        name="full_name">
                                </td>
                                <td class="p-3 px-5">
                                    <select value="1" class="bg-transparent" name="department_id">
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->department_id }}"
                                                @if ($department->department_id == $user->department_id) selected @endif>{{ $department->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="p-3 px-5">
                                    <select value="1" class="bg-transparent" name="role_id">
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->role_id }}"
                                                @if ($role->role_id == $user->role_id) selected @endif>{{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" value="{{ $user->status }}" class="sr-only peer"
                                            @if ($user->status == 1) checked @endif
                                            id="status{{ $key }}" name="status">
                                        <div onclick="changeStatus({{ $key }});"
                                            class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                        </div>
                                        <span onclick="changeStatus({{ $key }});"
                                            class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-500"
                                            id="ketStatus{{ $key }}">
                                            @if ($user->status == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </span>
                                    </label>
                                </td>
                                <td class="p-3 px-5"><button type="button"
                                        class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                        onclick="confirmUpdate({{ $key }});">Update</button>
                                </td>
                                <button type="submit" class="hidden" id="btnUpdate{{ $key }}"></button>
                            </form>
                            <form action="/master/user/delete" method="post">
                                @csrf
                                <input class="hidden" type="text" name="user_id" value="{{ $user->user_id }}">
                                <td class="p-3 px-5"><button type="button"
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
    <script>
        function changeStatus(key) {
            if (document.getElementById(`status${key}`).value == 0) {
                document.getElementById(`status${key}`).value = 1;
            } else if (document.getElementById(`status${key}`).value == 1) {
                document.getElementById(`status${key}`).value = 0;
            }

            if (document.getElementById(`ketStatus${key}`).innerText == "Active") {
                document.getElementById(`ketStatus${key}`).innerText = "Inactive";
            } else if (document.getElementById(`ketStatus${key}`).innerText == "Inactive") {
                document.getElementById(`ketStatus${key}`).innerText = "Active";
            }
            // alert(document.getElementById(`status${key}`).value);
        }
    </script>
@endsection --}}

@extends('main')
@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master User</h1>
    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent"
            role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg" id="profile-tab" data-tabs-target="#profile"
                    type="button" role="tab" aria-controls="profile" aria-selected="false">Tambah User</button>
            </li>
            <li class="mr-2" role="presentation">
                <button
                    class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                    id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard"
                    aria-selected="false">Daftar User</button>
            </li>
        </ul>
    </div>
    <div id="myTabContent">
        <div class="hidden p-4 rounded-lg bg-gray-300" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="py-4 px-5">
                <form action="{{ url('doRegister') }}" method="POST">
                    @csrf
                    <div class="flex lg:flex-row flex-col">
                        <div class="mb-6 w-full">
                            <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900">Full
                                Name</label>
                            <input type="text" id="full_name" name="full_name"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5 "
                                placeholder="Full Name" required>
                            @error('full_name')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="w-4"></div>
                        <div class="mb-6 w-full">
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900">Username</label>
                            <input type="text" id="username" name="username"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="Username" required>
                            @error('username')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="flex lg:flex-row flex-col">
                        <div class="mb-6 w-full">
                            <label for="department_id"
                                class="block mb-2 text-sm font-medium text-gray-900">Department</label>
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
                        <input type="password" name="password" id="password"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="Password" required>
                        @error('password')
                            <span class="text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-6 mt-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Gender</label>
                        <div class="flex">
                            <div class="flex items-center mr-4">
                                <input id="inline-radio" type="radio" value="0" name="gender"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="inline-radio" class="ml-2 text-sm font-medium text-gray-900">Male</label>
                            </div>
                            <div class="flex items-center mr-4">
                                <input id="inline-2-radio" type="radio" value="1" name="gender"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="inline-2-radio" class="ml-2 text-sm font-medium text-gray-900">Female</label>
                            </div>
                            @error('gender')
                                <span class="text-sm text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="submit"
                            class="text-white bg-gray-900 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Tambah
                            user baru</button>
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
                                <th class="text-left p-3 px-5">Name</th>
                                <th class="text-left p-3 px-5">Department</th>
                                <th class="text-left p-3 px-5">Role</th>
                                <th class="text-left p-3 px-5">Status</th>
                                <th class="text-center p-3 px-5" colspan="2">Action</th>
                            </tr>
                            @foreach ($users as $key => $user)
                                <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                    <form action="/master/user/update" method="post">
                                        @csrf
                                        <input class="hidden" type="text" name="user_id"
                                            value="{{ $user->user_id }}">
                                        <td class="p-3 px-5">
                                            <input type="text" value="{{ $user->full_name }}" class="bg-transparent"
                                                name="full_name">
                                        </td>
                                        <td class="p-3 px-5">
                                            <select value="1" class="bg-transparent" name="department_id">
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->department_id }}"
                                                        @if ($department->department_id == $user->department_id) selected @endif>
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="p-3 px-5">
                                            <select value="1" class="bg-transparent" name="role_id">
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->role_id }}"
                                                        @if ($role->role_id == $user->role_id) selected @endif>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" value="{{ $user->status }}" class="sr-only peer"
                                                    @if ($user->status == 1) checked @endif
                                                    id="status{{ $key }}" name="status">
                                                <div onclick="changeStatus({{ $key }});"
                                                    class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                </div>
                                                <span onclick="changeStatus({{ $key }});"
                                                    class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-500"
                                                    id="ketStatus{{ $key }}">
                                                    @if ($user->status == 1)
                                                        Active
                                                    @else
                                                        Inactive
                                                    @endif
                                                </span>
                                            </label>
                                        </td>
                                        <td class="p-3 px-5"><button type="button"
                                                class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                                onclick="confirmUpdate({{ $key }});">Update</button>
                                        </td>
                                        <button type="submit" class="hidden"
                                            id="btnUpdate{{ $key }}"></button>
                                    </form>
                                    <form action="/master/user/delete" method="post">
                                        @csrf
                                        <input class="hidden" type="text" name="user_id"
                                            value="{{ $user->user_id }}">
                                        <td class="p-3 px-5"><button type="button"
                                                class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                                onclick="confirmDelete({{ $key }});">Delete</button>
                                        </td>
                                        <button type="submit" class="hidden"
                                            id="btnDelete{{ $key }}"></button>
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
    <script>
        function changeStatus(key) {
            if (document.getElementById(`status${key}`).value == 0) {
                document.getElementById(`status${key}`).value = 1;
            } else if (document.getElementById(`status${key}`).value == 1) {
                document.getElementById(`status${key}`).value = 0;
            }

            if (document.getElementById(`ketStatus${key}`).innerText == "Active") {
                document.getElementById(`ketStatus${key}`).innerText = "Inactive";
            } else if (document.getElementById(`ketStatus${key}`).innerText == "Inactive") {
                document.getElementById(`ketStatus${key}`).innerText = "Active";
            }
            // alert(document.getElementById(`status${key}`).value);
        }
    </script>
@endsection
