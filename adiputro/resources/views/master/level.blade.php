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


    <div class="w-full flex h-screen">
        <div class="w-3/12 shadow-md bg-white px-1 max-h-screen h-fit overflow-x-auto" id="sidenavExample">
            @foreach ($item_levels as $item_level)
                <x-level-item :item="$item_level" />
            @endforeach
        </div>
        <div class="w-9/12 bg-slate-200 rounded-lg p-5">
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
            <h1>Gambar Komponen</h1>

            <div id="photosLoader"></div>
        </div>
    </div>

    <script>
        function updateLevelData(item_level_id) {
            //ajax call
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
                        $('#photosLoader').append(
                            `<img src="{{ asset('storage/`+value+`') }}" alt="" style="width:200px;height:200px">`
                            );
                    })

                }
            });

        }

        function openMenu(sideNav, btnDown) {
            document.getElementById(sideNav).classList.toggle("hidden");
            // document.getElementById(btnDown).classList.toggle("rotate-180");
        }
    </script>
@endsection
