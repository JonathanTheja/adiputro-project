@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Dashboard</h1>

    {{-- @if (Session::has('qrcode'))
        <script>
            alert('{{ Session::has('qrcode') }}')
        </script>
        {{ Session::get('qrcode') }}
    @endif --}}

    <div id="searchNavbar" class="w-[72.3vw] relative bg-white z-50">
        <form class="flex items-center my-4">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                                <label for="kode"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Kode</label>
                                <div class="w-4"></div>
                                <input type="text" id="full_name" name="kode"
                                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 block w-full p-2.5"
                                    value="" placeholder="Kode" required>
                            </div>
                            <div class="lg:mb-4 mb-2 w-full flex lg:flex-row flex-col">
                                <label for="full_name"
                                    class="flex items-center justify-start mb-2 lg:mb-0 text-md font-medium text-gray-900 w-40">Kategori</label>
                                <div class="w-4"></div>
                                <select id="kategori_report" name="kategori_report_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2"
                                    onchange="tambahUpdate(this.value)" required>
                                    <option disabled selected value="belumDipilih">Belum Dipilih</option>
                                    @foreach ($kategori_report as $kategori)
                                        <option value="{{ $kategori->kategori_report_id }}">{{ $kategori->name }}
                                        </option>
                                    @endforeach
                                    <option value="tambahUpdate" id="tambahUpdate">Tambah /
                                        Update Kategori</option>
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
    </div>

    <div id="content">
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



                    <h1 class="my-4">Gambar Komponen</h1>
                    <div id="photosLoader" class="mb-4"></div>
                    <div id="photosPagination" class="mb-4 flex justify-center"></div>

                    <div id="pe_container">
                    </div>
                    <div id="myModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                        <div class="absolute inset-0 bg-black opacity-50" id="modal-overlay"></div>
                        <div class="relative bg-white rounded-lg p-8 w-3/5">
                            <h2 class="text-2xl mb-4" id="item_component_number_modal"></h2>
                            <p id="item_component_name_modal"></p>
                            <div id="photosLoaderModal" class="mb-4"></div>
                            <div id="photosPaginationModal" class="mb-4 flex justify-center"></div>

                            <button id="closeModal"
                                class="mt-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600"
                                onclick="removeModal()">Tutup</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('modal.konfirmasi')

    <div class="hidden" id="modalKategori">
        <input type="checkbox" id="my-modal-kategori" class="modal-toggle" />
        <label for="my-modal-kategori" class="modal cursor-pointer">
            <label class="bg-white p-6 rounded-xl max-w-[80vw] max-h-[80vh] relative overflow-y-auto" for="">
                <label for="my-modal-kategori" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                <h3 class="text-lg font-bold mb-2" id="titleModal">Master Kategori Report</h3>
                {{-- accordion --}}
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item bg-white border border-gray-200 rounded-lg">
                        <h2 class="accordion-header mb-0" id="headingTwo">
                            <button
                                class="accordion-button collapsed relative flex items-center w-full py-4 px-5 text-base text-gray-800 text-left
                            bg-gray-200 hover:bg-gray-300 border-0 rounded-lg transition focus:outline-none"
                                type="button" data-bs-toggle="collapse" data-bs-target="#collapseKategori"
                                aria-expanded="false" aria-controls="collapseKategori">
                                <h1 class="text-xl text-gray-800">
                                    Tambah Kategori
                                </h1>
                            </button>
                        </h2>
                        <div id="collapseKategori" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body py-4 px-5">
                                <div class="flex lg:flex-row flex-col">
                                    <div class="mb-4 w-full">
                                        <label for="full_name"
                                            class="block mb-2 text-sm font-medium text-gray-900">Name</label>
                                        <input type="text" id="name" name="name"
                                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                            placeholder="Name" required>
                                    </div>
                                </div>
                                <div class="text-left pt-1 mb-6 pb-1">
                                    <button type="submit" onclick="tambahKategori($('#name').val())"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah
                                        Kategori baru</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- accordion --}}
                <table class="w-full text-md bg-white shadow-md rounded mb-4 overflow-x-auto">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left p-3 px-5">ID</th>
                            <th class="text-left p-3 px-5">Name</th>
                            <th class="text-center p-3 px-5" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableKategori">

                    </tbody>
                </table>
            </label>
        </label>
    </div>
    <label for="my-modal-kategori" class="" id="labelKategori"></label>
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
                    $("#photosPagination").html("");
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
                            `<div class='img${key} img w-full flex items-center justify-between ${!boleh ? "hidden" : ""}'>
                                <div class="text-center cursor-pointer" onclick='slideImg(${id_target_left})'>
                                    <i class="bi bi-caret-left-fill text-4xl rounded-lg text-white p-1 bg-gray-700"></i>
                                </div>
                                <img src="{{ asset('storage/`+value+`') }}" alt="" class='h-[500px]' style='-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;''>
                                <div class="text-center cursor-pointer" onclick='slideImg(${id_target_right})'>
                                    <i class="bi bi-caret-right-fill text-4xl rounded-lg text-white p-1 bg-gray-700"></i>
                                </div>
                            </div>
                            `
                        );
                        $('#photosPagination').append(
                            `
                            <div id='imgPagination${key}' class='img${key} imgPagination py-1 px-2 cursor-pointer m-1 rounded-lg ${boleh ? "bg-blue-500" : "bg-white"}' onclick='slideImg(${key})'>${key+1}</div>
                            `
                        );
                    })

                    $("#pe_container").html("");
                    loadProcessEntries(response.data.process_entries, response.data.tables, response.data
                        .table_tier);

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
            var kategori = document.getElementById("kategori_report").value;
            if (username == "" || password == "") {
                alert("Username dan password harus terisi!");
            } else if (kategori == "belumDipilih") {
                alert("Kategori belum dipilih!");
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

        function slideImg(id_target) {
            let selectedClass = "bg-blue-500";
            let unselectedClass = "bg-white";
            $(`.img`).addClass("hidden");
            $(`.img${id_target}`).removeClass("hidden");
            $(`.imgPagination`).removeClass(selectedClass);
            $(`.imgPagination`).addClass(unselectedClass);
            $(`#imgPagination${id_target}`).removeClass(unselectedClass);
            $(`#imgPagination${id_target}`).addClass(selectedClass);
            // document.getElementById(`img${id_this}`).classList.add("hidden");
            // document.getElementById(`img${id_target}`).classList.remove("hidden");
        }
        function slideImgModal(id_target) {
            let selectedClass = "bg-blue-500";
            let unselectedClass = "bg-white";
            $(`.imgModal`).addClass("hidden");
            $(`.imgModal${id_target}`).removeClass("hidden");
            $(`.imgPaginationModal`).removeClass(selectedClass);
            $(`.imgPaginationModal`).addClass(unselectedClass);
            $(`#imgPaginationModal${id_target}`).removeClass(unselectedClass);
            $(`#imgPaginationModal${id_target}`).addClass(selectedClass);
            // document.getElementById(`img${id_this}`).classList.add("hidden");
            // document.getElementById(`img${id_target}`).classList.remove("hidden");
        }

        setTimeout(() => {
            document.getElementById("modalKonfirmasi").classList.remove("hidden");
            document.getElementById("modalKategori").classList.remove("hidden");
        }, 1000);
        // document.getElementById("modalKonfirmasi").click();

        function selectDashboard(e) {
            var menus = document.getElementsByClassName("sidemenuDashboard");
            Array.prototype.forEach.call(menus, function(menu) {
                menu.classList.remove("bg-gray-200");
            });

            e.classList.add("bg-gray-200");
        }

        function generateTable(pe_id, pe_text, table_id) {
            $("#pe_container").append(`
                    <div id="pe_${pe_id}">
                        <h1>${pe_text}</h1>
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <div class="flex items-center justify-evenly bg-gray-100 p-4 rounded-lg shadow-md">
                                <div class="text-lg font-medium text-gray-800 mr-4" id="tier_${table_id}">Teks 1</div>
                                <div class="text-lg font-medium text-gray-800 mr-4" id="tier_desc_${table_id}">Teks 2</div>
                            </div>
                            <table class="w-full text-sm text-left text-gray-500" id="${table_id}">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            No
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Kode
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Nama Komponen
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Jumlah
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Satuan
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Keterangan
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Gambar
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tableCol">

                                </tbody>
                            </table>
                        </div>
                </div>`);
        }

        function showModal(item_component_id) {
            $.ajax({
                url: `/master/data/getDataModal`,
                type: "POST",
                cache: false,
                data: {
                    "item_component_id": item_component_id
                },
                success: function(response) {
                    $("#item_component_number_modal").text(response.data.item_component.item_number);
                    $("#item_component_name_modal").text(response.data.item_component.item_description);
                    $("#photosLoaderModal").html("");
                    $("#photosPaginationModal").html("");
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
                        $('#photosLoaderModal').append(
                            `<div class='imgModal${key} imgModal w-full flex items-center justify-between ${!boleh ? "hidden" : ""}'>
                                <div class="text-center cursor-pointer" onclick='slideImgModal(${id_target_left})'>
                                    <i class="bi bi-caret-left-fill text-4xl rounded-lg text-white p-1 bg-gray-700"></i>
                                </div>
                                <img src="{{ asset('storage/`+value+`') }}" alt="" class='h-[500px]' style='-moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;''>
                                <div class="text-center cursor-pointer" onclick='slideImgModal(${id_target_right})'>
                                    <i class="bi bi-caret-right-fill text-4xl rounded-lg text-white p-1 bg-gray-700"></i>
                                </div>
                            </div>
                            `
                        );
                        $('#photosPaginationModal').append(
                            `
                            <div id='imgPaginationModal${key}' class='imgModal${key} imgPaginationModal py-1 px-2 cursor-pointer m-1 rounded-lg ${boleh ? "bg-blue-500" : "bg-white"}' onclick='slideImgModal(${key})'>${key+1}</div>
                            `
                        );
                    })
                    const modal = document.getElementById('myModal');
                    modal.classList.remove('hidden');
                    disableScroll();
                }
            });

        }

        function removeModal() {
            const modal = document.getElementById('myModal');
            modal.classList.add('hidden');
            enableScroll();
        }

        function disableScroll() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
            window.onscroll = function() {
                window.scrollTo(scrollLeft, scrollTop);
            };
        }

        // Aktifkan kembali scroll pada halaman
        function enableScroll() {
            window.onscroll = null;
        }
        //DONE
        function placeComponentToTable(table_id, item) {

            var rowCount = $(`#${table_id} tbody tr`).length;
            $(`#${table_id} tbody`).append(`<tr class="bg-white border-b">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    ` + (rowCount + 1) + `
                </th>
                <td class="px-6 py-4">
                    ` + item.item_number + `
                </td>
                <td class="px-6 py-4">
                    ` + item.item_description + `
                </td>
                <td class="px-6 py-4">
                    ` + (item.item_component_qty) + `
                </td>
                <td class="px-6 py-4">
                    ` + item.item_uofm + `
                </td>
                <td class="px-6 py-4">
                    -
                </td>
                <td class="px-6 py-4">
                    <a href="javascript:void(0)" id="openModal" class="text-blue-500" onclick='showModal(` + item
                .item_component_id + `)'>Detail</a>
                </td>
            </tr>`);
        }

        function loadProcessEntries(process_entries, tables, table_tier) {
            $.each(process_entries, function(key, pe) {
                let table_id = 'pe_table_' + pe.process_entry_id;
                generateTable(pe.process_entry_id, pe.work_description, table_id);


                $("#tier_" + table_id).text(table_tier[table_id].item_component_name);
                $("#tier_desc_" + table_id).text(table_tier[table_id].desc);

                $.each(tables[table_id], function(key, item) {
                    console.log(item);
                    let it = {
                        item_component_id: item.item_component_id,
                        item_number: item.item_number,
                        item_description: item.item_description,
                        item_component_qty: parseInt(item.pivot.item_kit_qty) + parseInt(item.pivot
                            .bom_qty) + parseInt(item.pivot.component_qty),
                        item_uofm: item.item_uofm
                    };
                    placeComponentToTable(table_id, it);
                });
            });
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
            try {
                var url = window.location.href;
                getId = url.split("/dashboard/");
                getId = getId[1];
                if (getId != "") {
                    selectDashboard2(getId);
                }
            } catch (error) {

            }
        }

        selectedDashboard();

        function tambahUpdate(kategori) {
            if (kategori == "tambahUpdate") {
                $('#labelKategori').click();
                $('#kategori_report').val("belumDipilih");
                refreshKategori();
            }
        }

        function tambahKategori(name) {
            $.ajax({
                url: `/dashboard/report/addCategory`,
                type: "POST",
                cache: false,
                data: {
                    name: name
                },
                success: function(response) {
                    if (response.success) {
                        refreshKategori();
                        Swal.fire({
                            // text: "You won't be able to revert this!",
                            icon: 'success',
                            title: 'Berhasil Tambah Kategori!',
                            // showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            // html: `<div class='flex items-center justify-center w-full'>${html}</div>`,
                            // confirmButtonText: 'Yes, Update it!'
                            allowOutsideClick: false
                        })
                    }
                }
            });
        }

        function refreshKategori() {
            $.ajax({
                url: `/dashboard/report/getCategories`,
                type: "POST",
                cache: false,
                data: {},
                success: function(response) {
                    if (response.success) {
                        $('#kategori_report').html("");
                        $('#tableKategori').html("");
                        $('#kategori_report').append(`
                        <option disabled selected value="belumDipilih">Belum Dipilih</option>
                        `);
                        $.each(response.categories, function(key, value) {
                            console.log(value)
                            $('#kategori_report').append(`
                                <option value="${value.kategori_report_id}">${value.name}</option>
                            `);
                            $('#tableKategori').append(`
                                <tr class="border-b hover:bg-orange-100 bg-gray-100">
                                    <td class="p-3 px-5">
                                        <input type="text" value="${value.kategori_report_id}" class="bg-transparent">
                                    </td>
                                    <td class="p-3 px-5">
                                        <input type="text" id='name${value.kategori_report_id}' value="${value.name}" class="bg-transparent">
                                    </td>
                                    <td class="p-3 px-5"><button type="button"
                                            class="mr-3 text-sm bg-blue-500 hover:bg-blue-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                            onclick="confirmUpdate(${value.kategori_report_id});">Update</button>
                                    </td>
                                    <td class="p-3 px-5"><button type="button"
                                            class="text-sm bg-red-500 hover:bg-red-700 text-white py-1 px-2 rounded focus:outline-none focus:shadow-outline"
                                            onclick="confirmDelete(${value.kategori_report_id});">Delete</button>
                                    </td>
                                </tr>
                            `);
                        })
                        $('#kategori_report').append(`
                            <option value="tambahUpdate" id="tambahUpdate">Tambah / Update Kategori</option>
                        `);
                    }
                }
            });
        }

        function confirmUpdate(kategori_report_id) {
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
                    updateKategori(kategori_report_id);
                }
            })
        }

        function confirmDelete(kategori_report_id) {
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
                    deleteKategori(kategori_report_id)
                }
            })
        }

        function updateKategori(kategori_report_id) {
            let name = $(`#name${kategori_report_id}`).val();
            $.ajax({
                url: `/dashboard/report/updateCategory`,
                type: 'POST',
                cache: false,
                data: {
                    name: name,
                    kategori_report_id: kategori_report_id
                },
                success: function(response) {
                    if (response.success) {
                        refreshKategori();
                        Swal.fire({
                            // text: "You won't be able to revert this!",
                            icon: 'success',
                            title: 'Berhasil Update Kategori!',
                            // showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            // html: `<div class='flex items-center justify-center w-full'>${html}</div>`,
                            // confirmButtonText: 'Yes, Update it!'
                            allowOutsideClick: false
                        })
                    }
                }
            })
        }

        function deleteKategori(kategori_report_id) {
            $.ajax({
                url: `/dashboard/report/deleteCategory`,
                type: 'POST',
                cache: false,
                data: {
                    kategori_report_id: kategori_report_id
                },
                success: function(response) {
                    if (response.success) {
                        refreshKategori();
                        Swal.fire({
                            // text: "You won't be able to revert this!",
                            icon: 'success',
                            title: 'Berhasil Delete Kategori!',
                            // showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            // html: `<div class='flex items-center justify-center w-full'>${html}</div>`,
                            // confirmButtonText: 'Yes, Update it!'
                            allowOutsideClick: false
                        })
                    }
                }
            })
        }
    </script>
    <script type="text/javascript">
        var nav = document.getElementById("searchNavbar");
        var content = document.getElementById("content");
        var offset = 125;

        function changeNavbarSize() {
            try {
                if (window.pageYOffset > offset) {
                    nav.style.position = "fixed";
                    nav.style.top = 0;
                    $('#content').css('margin-top', $("#searchNavbar").height() + 10);
                } else {
                    nav.style.position = "relative";
                    nav.style.top = offset;
                    $('#content').css('margin-top', "0px");
                }
                $("#searchNavbar").width($("#content").width());
            } catch (error) {

            }
        }
        window.onscroll = changeNavbarSize;

        setTimeout(() => {
            changeNavbarSize();
        }, 1000);
        window.addEventListener("resize", changeNavbarSize);

        //cek dari return with dalam session
        if ("{{ Session::has('qrcode') }}") {
            let html = `{{ Session::get('qrcode') }}`;
            html = html.split("?>");
            html = html[1];
            setTimeout(() => {
                Swal.fire({
                    // text: "You won't be able to revert this!",
                    icon: 'success',
                    title: 'Berhasil Tambah Report Baru!',
                    // showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    html: `<div class='flex items-center justify-center w-full'>${html}</div>`,
                    // confirmButtonText: 'Yes, Update it!'
                    allowOutsideClick: false
                })
            }, 500);
        }
    </script>
@endsection
