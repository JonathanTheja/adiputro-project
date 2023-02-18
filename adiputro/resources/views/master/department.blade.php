@extends('main')


@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Departemen</h1>
    <div class="text-gray-900">
        <form action="{{ url('/master/departemen/add') }}" method="post">
            @csrf
            <div class="py-4 flex">
                <h1 class="text-3xl">
                    Add Department
                </h1>
            </div>
            <div class="flex lg:flex-row flex-col">
                <div class="mb-4 w-full">
                    <label for="full_name" class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                    <input type="text" id="name" name="name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                        placeholder="Name" required>
                </div>
                <div class="w-4"></div>
                <div class="mb-4 w-full">
                    <label for="access" class="block mb-2 text-sm font-medium text-gray-900">Access Database</label>
                    <select id="access" name="access"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option value="">Tidak ada</option>
                        {{-- @foreach ($roles as $role)
                            <option value="{{ $role->access }}">{{ $role->name }}</option>
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
                        <th class="text-left p-3 px-5">Department ID</th>
                        <th class="text-left p-3 px-5">Name</th>
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
                                <td class="p-3 flex justify-end"><button type="button"
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
    <script>
        function confirmUpdate(key) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`btnUpdate${key}`).click();
                }
            })
        }

        function confirmDelete(key) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`btnDelete${key}`).click();
                }
            })
        }
    </script>
@endsection
