@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Data</h1>

    <button onclick="tambah()" type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center max-w-32 rounded-lg">Tambah LV 0
    </button>
    <br>
    <br>
    @foreach ($item_levels as $item_level)
        <button id="multiLevelDropdownButton" data-dropdown-placement="right-start"
            data-dropdown-toggle="dropdown{{ $item_level->item_level_id }}"
            class="relative w-44 text-white bg-gray-900 hover:bgb-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-800"
            type="button">LV 0 {{ $item_level->name }}

            @if (count($item_level->children) > 0)
            <svg aria-hidden="true" class="w-4 h-4 absolute right-4" fill="currentColor"
                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
            @endif
        </button>
        <div id="dropdown{{ $item_level->item_level_id }}"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700">
            @foreach ($item_level->children as $it)
                <x-menu-item :item="$it" :level=1></x-menu-item>
            @endforeach
        </div>
        <br>
        <br>
    @endforeach

    <div class="overflow-x-auto">
        <table class="border-2 border-collapse border-gray-300">
            <tr class="border-2 border-collapse max-w-32 border-gray-300">
                <td class="border-2 border-collapse border-gray-300">
                    <button onclick="tambah()" type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center max-w-32 rounded-lg">Tambah
                    </button>
                </td>
            </tr>

            @foreach ($item_levels as $item_level)
                <tr class="border-2 border-collapse max-w-32 border-gray-300">
                    <td class="">
                        <button type="submit"
                            class="text-white bg-white hover:bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center max-w-32">
                        </button>
                    </td>
                </tr>
                <x-data-item :item="$item_level" :level=0 :max="$max"></x-data-item>
            @endforeach

        </table>

    </div>

    <div style="display: none" id="showModal">
        @include('modal.add.data')
        {{-- @include('modal.update.data') --}}
    </div>
    <label for="my-modal-add" class="btn hidden" id="modal">open modal</label>
    {{-- <label for="my-modal-update" class="btn hidden" id="modal">open modal</label> --}}

    <!-- Dropdown menu -->
@endsection

<script>
    function tambah(id, name, level) {
        if (id == undefined) {
            document.getElementById("item_level_id").value = "";
            document.getElementById("name").innerText = "";
            document.getElementById("titleModal").innerText = `Tambah Komponen Baru`;
            document.getElementById("bodyModal").innerText = `Tambah Komponen Level 0`;
            document.getElementById("my-modal-add").click();
        } else {
            // alert(id);
            // alert(name);
            // alert(level);
            document.getElementById("item_level_id").value = id;
            document.getElementById("titleModal").innerText = `Tambah Komponen Pada ${name} Level ${(level)}`;
            document.getElementById("bodyModal").innerText = `Tambah Komponen Level ${(parseInt(level)+1)}`;
            document.getElementById("my-modal-add").click();
        }
    }

    function update(id, name, level) {
        document.getElementById("item_level_id_update").value = id;
        document.getElementById("nameUpdate").value = name;
        document.getElementById("titleModalUpdate").innerText = `Update Komponen Pada ${name} Level ${(level)}`;
        // document.getElementById("bodyModalUpdate").innerText = `Update Nama Komponen`;
        document.getElementById("my-modal-update").click();
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

    function openMenu(sideNav, btnDown) {
        document.getElementById(sideNav).classList.toggle("hidden");
        // document.getElementById(btnDown).classList.toggle("rotate-180");
    }
</script>
