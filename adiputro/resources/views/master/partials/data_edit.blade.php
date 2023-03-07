@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Edit Data</h1>

    <div class="overflow-x-auto">
        <form action="/master/data/doUpdate" method="post" enctype="multipart/form-data">
            @csrf
            <h3 class="text-lg font-bold" id="titleModalUpdate"></h3>
            <div class="py-4" id="bodyModalUpdate"></div>
            <input type="text" class="hidden" id="item_level_id_update" name="item_level_id" value="{{ $item_level->item_level_id }}">
            <label for="nameUpdate" class="block my-2 text-gray-900">Nama Komponen</label>
            <input type="text" name="name" id="nameUpdate" value="{{ $item_level->name }}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Name" required>


            <label for="input-departemen" class="block my-2 text-gray-900">Departemen</label>
            <select id="input-departemen" multiple autocomplete="off" name="departments[]">
                @foreach ($departments as $department)
                    <option value="{{ $department->department_id }}">{{ $department->name }}</option>
                @endforeach
            </select>
            <label for="input-komponen" class="block my-2 text-gray-900">Komponen</label>
            <select id="input-komponen" multiple autocomplete="off" name="components[]">
                @foreach ($item_components as $item_component)
                    <option value="{{ $item_component->item_component_id }}">{{ $item_component->item_number }} - {{ $item_component->item_description }}</option>
                @endforeach
            </select>
            <label for="input-item-kit" class="block my-2 text-gray-900">Item Kit</label>
            <select id="input-item-kit" multiple autocomplete="off" name="itemkits[]" onchange="updateProcess()">
                @foreach ($item_kit as $ikit)
                    <option value="{{ $ikit->item_kit_id }}">{{ $ikit->item_kit_number }} - {{ $ikit->item_kit_description }}</option>
                @endforeach
            </select>
            <label for="input-bom" class="block my-2 text-gray-900">BOM ID</label>
            <select id="input-bom" multiple autocomplete="off" name="boms[]" onchange="updateProcess()">
                @foreach ($bom as $b)
                    <option value="{{ $b->bom_id }}">{{ $b->bom_number }} - {{ $b->bom_description }}</option>
                @endforeach
            </select>
            <label class="block mb-2 font-medium text-gray-900 my-2" for="multiple_files">Upload Gambar</label>
            <input class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2.5" id="multiple_files" type="file" multiple name="photos[]">
            <label for="input-process" class="block my-2 text-gray-900">Process Entry</label>
            <select id="input-process" multiple autocomplete="off" name="process[]" onchange="updateEntryTable()">
                @foreach ($process_entry as $pe)
                    <option value="{{ $pe->process_entry_id }}">{{$pe->work_description}}</option>
                @endforeach
            </select>


            <h2 class="my-4 text-lg font-semibold text-gray-900">Daftar komponen</h2>
            <ol class="max-w-md space-y-1 text-gray-500 list-decimal list-inside" id="ol-components">
                {{-- <li>
                    <span class="font-semibold text-gray-900">(Kode Komponen) -  (Nama Komponen) - </span><span class="font-semibold text-gray-900"> (Jumlah) </span>
                </li> --}}
            </ol>

            <div id="process_entries_container">

            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Update Komponen</button>

        </form>
    </div>



<script src="{{ asset('js/tom-select.complete.min.js') }}"></script>

<script>


    function generateTom(id) {
        return new TomSelect(id,{
            plugins: {
                remove_button:{
                    title:'Remove this item',
                }
            },
            persist: false,
            // create: true,
            onDelete: function(values) {
                return confirm(values.length > 1 ? 'Apakah anda yakin ingin menghapus ' + values.length + ' items?' : 'Apakah anda yakin ingin menghapus?');
            }
        });
    }

    function updateProcess(){
        let item_kits = $("#input-item-kit").val();
        let boms = $("#input-bom").val();
        $.ajax({
            url: `/master/data/getProcessEntry`,
            type: "POST",
            cache: false,
            data: {
                "item_kits":item_kits,
                "boms":boms
            },
            success: function(response) {
                $("#ol-components").html("");
                let components = response.data.components;

                $.each(components,function(key,comp) {
                    $("#ol-components").append(`<li>
                    <span class="font-semibold text-gray-900">`+comp.item_number+` - `+comp.item_description+` - </span><span class="font-semibold text-gray-900"> `+comp.item_qty+` PCS </span>
                    </li>`);
                });
            }
        });
    }

    function updateEntryTable(){
        let selected_processes = $("#input-process").val();
        // $("#process_entries_container").html("");
        $("#input-process option:selected").each(function () {
            //generate table
            let body_name = "process_entry_body_"+$(this).val();
            $("#process_entries_container").append(
                `<div class="w-9/12 rounded-lg py-5">
                    <h1 class="text-lg my-3">Tabel Process Entry `+$(this).text()+`</h1>
                    <div>
                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="component_input_`+$(this).val()+`" type="text" placeholder="Kode Komponen">
                            </div>
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none" onclick="addRowTable('`+body_name+`','`+$(this).val()+`')">+</button>
                            </div>
                        </div>

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
                                        <th scope="col" class="px-6 py-3">
                                            QTY
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="process_entry_body_`+$(this).val()+`">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>`
            );

            // var $this = $(this);
            // if ($this.length) {
            //     var selText = $this.text();
            //     console.log(selText);
            // }
        });
    }

    function addRowTable(id,table_number){
        let component_code = $("#component_input_"+table_number).val();

        console.log(component_code);
        $.ajax({
            url: `/master/data/getSpecComponent`,
            type: "POST",
            cache: false,
            data: {
                "item_number":component_code
            },
            success: function(response) {
              console.log(response.data);
               let item = response.data.item;
               var rowCount = $('#'+id+' tr').length;

                $("#"+id).append(`
                    <tr>
                        <td scope="col" class="px-6 py-3">
                            `+(rowCount+1)+`
                        </td>
                        <td scope="col" class="px-6 py-3">
                            `+item.item_number+`
                        </td>
                        <td scope="col" class="px-6 py-3">
                            `+item.item_description+`
                        </td>
                        <td scope="col" class="px-6 py-3">
                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="QTY" value=`+item.item_qty+`>
                        </td>
                    </tr>
                `);
            }
        });


    }

    generateTom("#input-departemen")
    generateTom("#input-komponen")
    generateTom("#input-item-kit")
    generateTom("#input-bom")
    generateTom("#input-process")
</script>
@endsection
