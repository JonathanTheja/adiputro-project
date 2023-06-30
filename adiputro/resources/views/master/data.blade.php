@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Data</h1>
    <div>
        <button onclick="tambah()"
            class="bg-blue-500 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 text-white font-medium text-sm px-5 py-2.5 text-center max-w-32 rounded-md">
            Tambah
        </button>
    </div>
    <br>
    <div class="w-full shadow-md bg-white px-1 max-h-screen h-fit overflow-x-auto" id="sidenavExample">
        @foreach ($item_levels as $item_level)
            <x-data-level :item="$item_level" :level=0 :max="$max" />
        @endforeach
    </div>
    {{-- <div class="bg-gray-100 flex items-center justify-center">
        <div class="w-full max-w-5xl px-4">
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <tr class="border border-gray-300">
                        <td class="border border-gray-300">
                            <button onclick="tambah()"
                                class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 text-white font-medium text-sm px-5 py-2.5 text-center max-w-32 rounded-md">
                                Tambah
                            </button>
                        </td>
                    </tr>

                    @foreach ($item_levels as $item_level)
                        <tr class="border border-gray-300">
                            <td>
                                <button
                                    class="bg-white hover:bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 text-white font-medium text-sm px-5 py-2.5 text-center max-w-32">
                                </button>
                            </td>
                        </tr>
                        <x-data-item :item="$item_level" :level=0 :max="$max"></x-data-item>
                    @endforeach
                </table>
            </div>
        </div>
    </div> --}}


    <div class="hidden" id="showModal">
        @include('modal.add.data')
    </div>
    <label for="my-modal-add" class="btn hidden" id="modal">open modal</label>

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
