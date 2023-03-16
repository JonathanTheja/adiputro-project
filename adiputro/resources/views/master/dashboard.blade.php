@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Dashboard</h1>

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
    <div class="accordion pointer-events-none" id="accordionReport">
        <div class="accordion-item bg-white border border-gray-200 rounded-lg">
            <h2 class="accordion-header mb-0" id="headingTwo">
                <button
                    class="accordion-button collapsed relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
            bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                    type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                    aria-controls="collapseTwo">
                    <h1 class="text-xl text-gray-800">
                        Report
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
                            <label for="full_name"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Nomor
                                Laporan</label>
                            <div class="w-4"></div>
                            <input disabled type="text" id="full_name" name="nomor" value="{{ $nomor_laporan }}"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Nomor Laporan" required>
                            <input type="text" id="full_name" name="nomor_laporan" value="{{ $nomor_laporan }}"
                                class="hidden shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 w-full p-2.5"
                                placeholder="Nomor Laporan" required>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col justify-start">
                            <label for="full_name"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Tanggal</label>
                            <div class="w-4"></div>
                            <input disabled type="text" id="full_name" name="tanggal" value="{{ $tanggal }}"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                placeholder="Nomor Laporan">
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="full_name"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Pelapor</label>
                            <div class="w-4"></div>
                            <input disabled type="text" id="full_name" name="pelapor"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                value="{{ $pelapor->full_name }}" placeholder="Pelapor" required>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="full_name"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Departemen</label>
                            <div class="w-4"></div>
                            <input disabled type="text" id="full_name" name="departemen"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                value="{{ $pelapor->department->name }}" placeholder="Departemen" required>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="full_name"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Jenis</label>
                            <div class="w-4"></div>
                            <select id="jenis" name="jenis"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                <option value="TI">TI</option>
                                <option value="Gambar Teknik">Gambar Teknik</option>
                                <option value="Process Entry">Process Entry</option>
                            </select>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="full_name"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Kategori</label>
                            <div class="w-4"></div>
                            <select id="kategori_report" name="kategori_report_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                @foreach ($kategori_report as $kategori)
                                    <option value="{{ $kategori->kategori_report_id }}">{{ $kategori->name }}</option>
                                @endforeach
                                {{-- @foreach ($roles as $role)
                                    <option value="{{ $role->access }}">{{ $role->name }}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                            <label for="full_name"
                                class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Temuan</label>
                            <div class="w-4"></div>
                            <input type="text" id="full_name" name="temuan"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5 "
                                placeholder="Temuan" required>
                        </div>
                        <button type="submit" class="hidden" id="submitReport"></button>
                        <label for="my-modal-konfirmasi"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5 cursor-pointer">Tambah
                            report baru</label>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="w-full flex min-h-[60vh] mt-4">
        <div class="w-3/12 shadow-md bg-white px-1 max-h-screen h-fit overflow-x-auto" id="sidenavExample">
            @foreach ($item_levels as $item_level)
                <x-level-item :item="$item_level" />
            @endforeach
        </div>
        <div class="w-9/12 bg-slate-200 rounded-lg p-5">
            <div id="loadingDashboard" class="hidden h-fit">@include('loading2')</div>
            <div id="dashboard_container" class="hidden">
                <h1 class="text-lg" id="component_name">Name</h1>
                <h1>Gambar Komponen</h1>
                <div id="photosLoader" class="mb-4"></div>
                <div id="table_container">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                            <tbody id="tableCol">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hidden" id="modalKonfirmasi">
        <input type="checkbox" id="my-modal-konfirmasi" class="modal-toggle" />
        <label for="my-modal-konfirmasi" class="modal cursor-pointer">
            <label class="modal-box relative" for="">
                <label for="my-modal-konfirmasi" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="text-lg font-bold" id="titleModal">Konfirmasi Tambah Laporan</h3>
                <div class="py-4" id="bodyModal">Username</div>
                <input type="text" name="username" id="username"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Username" required>
                <div class="py-4" id="bodyModal">Password</div>
                <input type="password" name="password" id="password"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Password" required>
                <button type="submit" onclick="konfirmasi()"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Konfirmasi</button>
            </label>
        </label>
    </div>

    <script>
        function updateLevelData(item_level_id) {
            //ajax call
            document.getElementById("loadingDashboard").classList.remove("hidden");
            document.getElementById("dashboard_container").classList.add("hidden");
            $.ajax({
                url: `/master/data/getData`,
                type: "POST",
                cache: false,
                data: {
                    "item_level_id": item_level_id
                },
                success: function(response) {
                    // //fill data to form
                    $('#component_name').text(response.data.item_level.name);
                    $("#tableCol").html("");
                    $.each(response.data.item_components, function(key, value) {
                        $('#tableCol').append(`<tr class="bg-white border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    ` + (key + 1) + `
                                </th>
                                <td class="px-6 py-4">
                                    ` + value.item_number + `
                                </td>
                                <td class="px-6 py-4">
                                    ` + value.item_description + `
                                </td>
                            </tr>`);
                    })

                    $("#photosLoader").html("");
                    $.each(response.data.all_photos, function(key, value) {
                        let id_target_left = key - 1;
                        let id_target_right = key + 1;
                        let boleh = false;
                        if (key == 0) {
                            boleh = true;
                            id_target_left = response.data.all_photos.length - 1;
                        }
                        if (key == response.data.all_photos.length - 1) {
                            id_target_right = 0;
                        }
                        $('#photosLoader').append(
                            `<div id='img${key}' class='w-full flex items-center justify-between ${!boleh && "hidden"}'>
                                <div class="text-center cursor-pointer" onclick='slideImg(${key},${id_target_left})'>
                                    <i class="bi bi-caret-left-fill text-4xl rounded-lg text-white p-1 bg-gray-700"></i>
                                </div>
                                <img src="{{ asset('storage/`+value+`') }}" alt="" class='h-[500px]' style='-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;''>
                                <div class="text-center cursor-pointer" onclick='slideImg(${key},${id_target_right})'>
                                    <i class="bi bi-caret-right-fill text-4xl rounded-lg text-white p-1 bg-gray-700"></i>
                                </div>
                            </div>`
                        );
                    })

                    document.getElementById("loadingDashboard").classList.add("hidden");
                    document.getElementById("dashboard_container").classList.remove("hidden");
                    document.getElementById("accordionReport").classList.remove("pointer-events-none");
                    document.getElementById("item_level_id").value = item_level_id;
                }
            });
        }

        function konfirmasi() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            if (username == "" || password == "") {
                alert("Username dan password harus terisi!");
            } else {
                $.ajax({
                    url: `/dashboard/report/konfirmasi`,
                    type: "POST",
                    cache: false,
                    data: {
                        "username": username,
                        "password": password,
                    },
                    success: function(response) {
                        if (!response.success) {
                            alert("Data kredensial salah!");
                        } else {
                            document.getElementById("submitReport").click();
                        }
                    }
                });
            }
        }

        function openMenu(sideNav, btnDown) {
            document.getElementById(sideNav).classList.toggle("hidden");
            // document.getElementById(btnDown).classList.toggle("rotate-180");
        }

        function slideImg(id_this, id_target) {
            document.getElementById(`img${id_this}`).classList.add("hidden");
            document.getElementById(`img${id_target}`).classList.remove("hidden");
        }

        setTimeout(() => {
            document.getElementById("modalKonfirmasi").classList.remove("hidden");
        }, 1000);
        // document.getElementById("modalKonfirmasi").click();

        function selectDashboard(e) {
            var menus = document.getElementsByClassName("sidemenuDashboard");
            Array.prototype.forEach.call(menus, function(menu) {
                menu.classList.remove("bg-gray-200");
            });

            e.classList.add("bg-gray-200");
        }

        function selectDashboard2(id) {
            let selectedDashboard = document.getElementById(`sideNav${id}`);
            selectDashboard(document.getElementById(`sidemenuDashboard${id}`));
            while (selectedDashboard.parentNode) {
                let selected = selectedDashboard.parentNode;
                try {
                    if (selected.classList.contains("hidden")) {
                        selected.classList.remove("hidden");
                    }
                } catch (error) {

                }
                selectedDashboard = selectedDashboard.parentNode;
            }
            setTimeout(() => {
                updateLevelData(id);
            }, 500);
        }

        function selectedDashboard() {
            var url = window.location.href;
            getId = url.split("/dashboard/");
            getId = getId[1];
            if (getId != "") {
                selectDashboard2(getId);
            }
        }
        selectedDashboard();
    </script>
@endsection
