@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Data</h1>

    <button onclick="tambah()" type="submit"
        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center max-w-32 rounded-md">Tambah
        LV 0
    </button>
    <br>
    <br>
    @foreach ($item_levels as $item_level)
        <button id="multiLevelDropdownButton" data-dropdown-placement="right-start"
            data-dropdown-toggle="dropdown{{ $item_level->item_level_id }}"
            class="relative w-[128.837] text-white bg-gray-900 hover:bgb-gray-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-t-md text-sm px-4 text-left py-2.5 inline-flex items-center dark:focus:ring-gray-800 mr-2"
            type="button">
            <div class="w-full flex items-center justify-between min-h-fit">
                L0 {{ $item_level->name }}
            </div>

            @if (count($item_level->children) > 0)
                <svg aria-hidden="true" class="w-4 h-4 absolute right-1" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd"></path>
                </svg>
            @endif
        </button>
        <div class="flex w-fit bg-gray-700 rounded-b-md">
            <button onclick="tambah('{{ $item_level->item_level_id }}', '{{ $item_level->name }}', '0');" type="submit"
                class="text-white bg-blue-700 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-xs px-1 py-2.5 text-center max-w-32 rounded-bl-md">Tambah
            </button>
            <form action="/master/data/update" method="get" class="m-0">
                <input type="text" class="hidden" value="{{ $item_level->item_level_id }}" name="item_level_id">
                <button type="submit"
                    class="text-white bg-yellow-600 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium text-xs px-1 py-2.5 text-center">Edit
                </button>
            </form>
            <form action="/master/data/delete" method="post" class="m-0">
                @csrf
                <input type="text" class="hidden" value="{{ $item_level->item_level_id }}" name="item_level_id">
                <div onclick="confirmDelete({{ $item_level->item_level_id }})"
                    class="text-white bg-red-700 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium text-xs px-1 py-2.5 text-center max-w-32 cursor-pointer rounded-br-md">
                    Hapus
                </div>
                <button type="submit" id="btnDelete{{ $item_level->item_level_id }}"></button>
            </form>
        </div>
        <div id="dropdown{{ $item_level->item_level_id }}"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-md shadow dark:bg-gray-700">
            @foreach ($item_level->children as $it)
                <x-menu-item :item="$it" :level=1></x-menu-item>
            @endforeach
        </div>
        <br>
    @endforeach

    <div class="overflow-x-auto">
        <table class="border-2 border-collapse border-gray-300">
            <tr class="border-2 border-collapse max-w-32 border-gray-300">
                <td class="border-2 border-collapse border-gray-300">
                    <button onclick="tambah()" type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center max-w-32 rounded-md">Tambah
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
