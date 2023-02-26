@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Master Data</h1>

    <div class="overflow-x-auto">
        <table class="border-2 border-collapse border-gray-300">
            <tr class="border-2 border-collapse w-32 border-gray-300">
                <td class="border-2 border-collapse border-gray-300">
                    <button onclick="tambah()" type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center w-32">Tambah
                    </button>
                </td>
            </tr>
            @foreach ($item_levels as $item_level)
                <tr class="border-2 border-collapse w-32 border-gray-300">
                    <td class="">
                        <button type="submit"
                            class="text-white bg-white hover:bg-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium text-sm px-5 py-2.5 text-center w-32">
                        </button>
                    </td>
                </tr>
                <x-data-item :item="$item_level" :level=0></x-data-item>
            @endforeach
        </table>
    </div>

    <div style="display: none" id="showModal">
        @include('modal.add.data')
        {{-- @include('modal.update.data') --}}
    </div>
    <label for="my-modal-add" class="btn hidden" id="modal">open modal</label>
    {{-- <label for="my-modal-update" class="btn hidden" id="modal">open modal</label> --}}
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
</script>
