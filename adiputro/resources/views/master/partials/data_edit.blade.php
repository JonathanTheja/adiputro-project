@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Edit Data</h1>

    <div class="overflow-x-auto">
        <form action="/master/data/doUpdate" method="post" enctype="multipart/form-data">
            @csrf
            <h3 class="text-lg font-bold" id="titleModalUpdate"></h3>
            <div class="py-4" id="bodyModalUpdate"></div>
            <input type="text" class="hidden" id="item_level_id_update" name="item_level_id"
                value="{{ $item_level->item_level_id }}">
            <label for="nameUpdate" class="block my-2 text-gray-900">Nama Komponen</label>
            <input type="text" name="name" id="nameUpdate" value="{{ $item_level->name }}"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Name" required>

            <label for="input-departemen" class="block my-2 text-gray-900">Departemen</label>
            <select id="input-departemen" multiple autocomplete="off" name="departments[]">
                @foreach ($departments as $department)
                    <option value="{{ $department->department_id }}" @if ($item_level->departments->contains($department)) selected @endif>
                        {{ $department->name }}</option>
                @endforeach
            </select>
            <label for="input-komponen" class="block my-2 text-gray-900">Komponen</label>
            <select id="input-komponen" multiple autocomplete="off" name="components[]">
                @foreach ($item_components as $item_component)
                    <option value="{{ $item_component->item_component_id }}"
                        @if ($item_level->itemComponents->contains($item_component)) selected @endif>{{ $item_component->item_number }} -
                        {{ $item_component->item_description }}</option>
                @endforeach
            </select>
            <label for="input-item-kit" class="block my-2 text-gray-900">Item Kit</label>
            <select id="input-item-kit" multiple autocomplete="off" name="item_kits[]" onchange="updateProcess(false)">
                @foreach ($item_kit as $ikit)
                    <option value="{{ $ikit->item_kit_id }}" @if ($item_level->itemKits->contains($ikit)) selected @endif>
                        {{ $ikit->item_kit_number }} -
                        {{ $ikit->item_kit_description }}</option>
                @endforeach
            </select>
            <label for="input-bom" class="block my-2 text-gray-900">BOM ID</label>
            <select id="input-bom" multiple autocomplete="off" name="boms[]" onchange="updateProcess(false)">
                @foreach ($bom as $b)
                    <option value="{{ $b->bom_id }}" @if ($item_level->boms->contains($b)) selected @endif>
                        {{ $b->bom_number }} - {{ $b->bom_description }}</option>
                @endforeach
            </select>
            <label class="block mb-2 font-medium text-gray-900 my-2" for="multiple_files">Upload Gambar</label>
            <input
                class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2.5"
                id="multiple_files" type="file" multiple name="photos[]">
            <label for="input-process" class="block my-2 text-gray-900">Process Entry</label>
            <select id="input-process" multiple autocomplete="off" name="process[]" onchange="updateEntryTable()">
                @foreach ($process_entry as $pe)
                    <option value="{{ $pe->process_entry_id }}" @if ($item_level->processEntries->contains($pe)) selected @endif>
                        {{ $pe->work_description }}</option>
                @endforeach
            </select>

            <h2 class="my-4 text-lg font-semibold text-gray-900">Daftar komponen</h2>
            <ol class="max-w-md space-y-1 text-gray-500 list-decimal list-inside" id="ol-components">

            </ol>

            <div id="pe_container">

            </div>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Update
                Komponen</button>
            <button onclick="getDataComponent()"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5"
                type="button">Get component</button>

        </form>
    </div>


    <script src="{{ asset('js/tom-select.complete.min.js') }}"></script>
    <script>
        //----------------DONE
        let boleh = false;

        function generateTom(id) {
            return new TomSelect(id, {
                plugins: {
                    remove_button: {
                        title: 'Remove this item',
                    }
                },
                persist: false,
                // create: true,
                onDelete: function(values) {
                    return confirm(values.length > 1 ? 'Apakah anda yakin ingin menghapus ' + values.length +
                        ' items?' : 'Apakah anda yakin ingin menghapus?');
                }
            });
        }


        function getDataComponent() {
            $.ajax({
                url: `/master/data/getDataTemp`,
                type: "POST",
                cache: false,
                success: function(response) {
                    console.log(response);
                }
            });
        }
        //------------------

        //----------------DONE
        function updateProcess(session_status) {
            let item_kits = $("#input-item-kit").val();
            let boms = $("#input-bom").val();
            $.ajax({
                url: `/master/data/getProcessEntryItem`,
                type: "POST",
                cache: false,
                data: {
                    "item_kits": item_kits,
                    "boms": boms,
                    "session_status": session_status
                },
                success: function(response) {
                    $("#ol-components").html("");
                    let components = response.data.components;
                    $.each(components, function(key, comp) {
                        $("#ol-components").append(`<li>
                    <span class="font-semibold text-gray-900">` + comp.item_number + ` - ` + comp.item_description +
                            ` - </span><span class="font-semibold text-gray-900"> ` + comp
                            .item_component_qty + ` ` + comp.item_uofm + ` </span>
                    </li>`);
                    });
                }
            });
        }
        //------------------------

        function generateTable(pe_id, pe_text, table_id) {
            $("#pe_container").append(
                `<div class="w-9/12 rounded-lg py-5 pe_table_list" id="pe_${pe_id}">
                    <h1 class="text-lg my-3">Tabel Process Entry ${pe_text}</h1>
                    <div>
                        <div class="flex flex-wrap -mx-3 mb-2">
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="input_in_${table_id}" type="text" placeholder="Kode Komponen">
                            </div>
                            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none" onclick="insertToTable('${table_id}',null)">+</button>
                            </div>
                        </div>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500" id="${table_id}">
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
                                        <th scope="col" class="px-6 py-3">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>`
            );
        }

        //-----------------------DONE
        function updateEntryTable() {
            var tableCount = $('#pe_container table').length;
            let selected_processes = $("#input-process option:selected").length;
            if (selected_processes > tableCount) {
                let pe = $("#input-process option:selected").last();
                let pe_id = pe.val();
                let pe_text = pe.text();

                let table_id = "pe_table_" + pe_id;
                //generate table
                generateTable(pe_id, pe_text, table_id);

            } else {
                //remove
                let input_selected = $("#input-process option:selected").last();
                //its not always last :/

                let last_element = $(".pe_table_list").last().remove();
            }
        }

        //DONE
        function placeComponentToTable(table_id, item) {
            var rowCount = $(`#${table_id} tbody tr`).length;
            $(`#${table_id} tbody`).append(`
            <tr>
                <td scope="col" class="px-6 py-3">
                    ${(rowCount+1)}
                </td>
                <td scope="col" class="px-6 py-3">
                    ${item.item_number}
                </td>
                <td scope="col" class="px-6 py-3">
                    ${item.item_description}

                </td>
                <td scope="col" class="px-6 py-3">
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="QTY" value=${item.item_component_qty}>
                </td>
                <td scope="col" class="px-6 py-3">
                    <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" onclick=deleteComponentTable('${table_id}','${item.item_number}')>Hapus</button>
                </td>
            </tr>
        `);
        }

        function addComponent(table_id, item_number) {
            $.ajax({
                url: `/master/data/updateSpecComponent`,
                type: "POST",
                cache: false,
                data: {
                    "item_number": item_number,
                    "table_id": table_id
                },
                success: function(response) {
                    if (response.success) {
                        let item = response.data.item;
                        placeComponentToTable(table_id, item);
                    } else {
                        //failed
                        alert(response.message);
                    }
                }
            });

        }

        function insertToTable(table_id, item_number) {
            //if param doesn't contain the item_number then get item_number from the input_in_(pe_id)
            if (!item_number) {
                item_number = $("#input_in_" + table_id).val();
            }
            addComponent(table_id, item_number);
        }
        //--------------------------------------------------


        //call the placeComponentToTable

        function refreshTable(table_id) {

            $.ajax({
                url: `/master/data/getComponents`,
                type: "POST",
                cache: false,
                data: {
                    "table_id": table_id
                },
                success: function(response) {
                    if (!response.is_multiple) {
                        //just refresh the current table
                        let items = response.items;
                        let table_body = $(`#${table_id} tbody`);
                        table_body.eq(0).html("");

                        //foreach
                        $.each(items, function(key, item) {
                            placeComponentToTable(table_id, item);
                        });

                    } else {
                        //refresh multiple tables
                        let tables = response.tables;
                        let process_entries = response.process_entries;
                        //push tables
                        $.each(process_entries, function(key, pe) {
                            let table_id = 'pe_table_' + pe.process_entry_id;
                            generateTable(pe.process_entry_id, pe.work_description, table_id);

                            $.each(tables[table_id], function(key, item) {
                                let it = {
                                    item_number: item.item_number,
                                    item_description: item.item_description,
                                    item_component_qty: item.item_component_qty
                                };
                                placeComponentToTable(table_id, it);
                            });
                        });
                        //foreach every tables ?

                    }
                }
            });
        }

        function deleteComponentTable(table_id, item_number) {
            console.log(table_id, item_number);
            $.ajax({
                url: `/master/data/deleteComponentTable`,
                type: "POST",
                cache: false,
                data: {
                    "item_number": item_number,
                    "table_id": table_id
                },
                success: function(response) {
                    if (response.success) {
                        refreshTable(table_id);
                    } else {
                        //failed
                        alert(response.message);
                    }
                }
            });
        }

        setTimeout(() => {
            refreshTable("all");
            updateProcess(true);
        }, 1000);

        generateTom("#input-departemen")
        generateTom("#input-komponen")
        generateTom("#input-item-kit")
        generateTom("#input-bom")
        generateTom("#input-process")
    </script>
@endsection
