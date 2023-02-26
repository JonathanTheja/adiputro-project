@extends('main')
@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Form Report</h1>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item bg-white border border-gray-200 rounded-lg">
            <h2 class="accordion-header mb-0" id="headingTwo">
                <button
                    class="accordion-button collapsed relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
            bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    <h1 class="text-xl text-gray-800">
                        Tambah Report
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
                            </div>
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
        <div class="px-3 py-4 flex justify-center">

            <table class="w-full text-md bg-white shadow-md rounded mb-4">
                <tbody>
                    <tr class="border-b">
                        <th class="text-left p-3 px-5">Name</th>
                        <th class="text-left p-3 px-5">Department</th>
                        <th class="text-left p-3 px-5">Role</th>
                        <th class="text-left p-3 px-5">Status</th>
                        <th class="text-center p-3 px-5" colspan="2">Action</th>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
