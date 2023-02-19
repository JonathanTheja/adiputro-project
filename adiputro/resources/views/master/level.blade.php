@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Level</h1>

    <form class="flex items-center my-4">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            <input type="text" id="simple-search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                placeholder="Search" required>
        </div>
        <button type="submit"
            class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-900 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <span class="sr-only">Search</span>
        </button>
    </form>

    {{-- <div class="w-60 h-full shadow-md bg-white px-1 overflow-x-auto" id="sidenavExample">
        <div>
            <div class="flex items-center min-w-full">
                <a class="flex items-center pl-4 text-sm py-2 text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-gray-900 hover:bg-gray-100 transition duration-300 ease-in-out cursor-pointer min-w-[150px]"
                    data-mdb-ripple="true" data-mdb-ripple-color="dark" data-bs-toggle="collapse"
                    data-bs-target="#collapseSidenavEx1" aria-expanded="true" aria-controls="collapseSidenavEx1">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3 mr-3" role="img"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M216 0h80c13.3 0 24 10.7 24 24v168h87.7c17.8 0 26.7 21.5 14.1 34.1L269.7 378.3c-7.5 7.5-19.8 7.5-27.3 0L90.1 226.1c-12.6-12.6-3.7-34.1 14.1-34.1H192V24c0-13.3 10.7-24 24-24zm296 376v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h146.7l49 49c20.1 20.1 52.5 20.1 72.6 0l49-49H488c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z">
                        </path>
                    </svg>
                    <span>Click here 1</span>
                </a>
                <svg aria-hidden="true" focusable="false" data-prefix="fas"
                    class="rounded-md w-6 h-6 ml-2 mr-4 bg-gray-200 hover:bg-gray-400 cursor-pointer rotate-180"
                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="btnDown1"
                    onclick="openMenu('sideNav1', 'btnDown1')">
                    <path fill="currentColor"
                        d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z">
                    </path>
                </svg>
            </div>
            <div class="pl-4 hidden" id="sideNav1">
                <div class="flex items-center min-w-full">
                    <a class="flex items-center pl-4 text-sm py-2 text-gray-700 text-ellipsis whitespace-nowrap rounded hover:text-gray-900 hover:bg-gray-100 transition duration-300 ease-in-out cursor-pointer min-w-[150px]"
                        data-mdb-ripple="true" data-mdb-ripple-color="dark" data-bs-toggle="collapse"
                        data-bs-target="#collapseSidenavEx1" aria-expanded="true" aria-controls="collapseSidenavEx1">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" class="w-3 h-3 mr-3" role="img"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor"
                                d="M216 0h80c13.3 0 24 10.7 24 24v168h87.7c17.8 0 26.7 21.5 14.1 34.1L269.7 378.3c-7.5 7.5-19.8 7.5-27.3 0L90.1 226.1c-12.6-12.6-3.7-34.1 14.1-34.1H192V24c0-13.3 10.7-24 24-24zm296 376v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h146.7l49 49c20.1 20.1 52.5 20.1 72.6 0l49-49H488c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z">
                            </path>
                        </svg>
                        <span>Click here 1</span>
                    </a>
                    <svg aria-hidden="true" focusable="false" data-prefix="fas"
                        class="rounded-md w-6 h-6 ml-2 mr-4 bg-gray-200 hover:bg-gray-400 cursor-pointer rotate-180"
                        role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" id="btnDown1"
                        onclick="openMenu('sideNav1', 'btnDown1')">
                        <path fill="currentColor"
                            d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z">
                        </path>
                    </svg>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="w-full flex h-screen">
        <div class="w-3/12 shadow-md bg-white px-1 max-h-screen h-fit overflow-x-auto" id="sidenavExample">
            @foreach ($spks as $spk)
                <x-spk-item :spk="$spk" />
            @endforeach
        </div>
        <div class="w-9/12 bg-slate-400 rounded-lg">
            <img src="{{ asset('img/bus_wall_1.jpg') }}" alt="" style="width:70%" class="mx-auto mt-10 rounded-lg">
        </div>
    </div>

    <script>
        function openMenu(sideNav, btnDown) {
            document.getElementById(sideNav).classList.toggle("hidden");
            document.getElementById(btnDown).classList.toggle("rotate-180");
        }
    </script>
@endsection
