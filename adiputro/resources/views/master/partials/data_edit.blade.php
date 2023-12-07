@extends('main')

@section('container')
    <h1 class="text-center text-5xl font-semibold mb-4">Edit Data</h1>

    <div class="overflow-x-auto">
        <form action="/master/data/doUpdate" method="post" enctype="multipart/form-data" id="editForm">
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
            <select id="input-item-kit" multiple autocomplete="off" name="item_kits[]" onchange="updateProcess('0')">
                @foreach ($item_kit as $ikit)
                    <option value="{{ $ikit->item_kit_id }}" @if ($item_level->itemKits->contains($ikit)) selected @endif>
                        {{ $ikit->item_kit_number }} -
                        {{ $ikit->item_kit_description }}</option>
                @endforeach
            </select>
            <label for="input-bom" class="block my-2 text-gray-900">BOM ID</label>
            <select id="input-bom" multiple autocomplete="off" name="boms[]" onchange="updateProcess('0')">
                @foreach ($bom as $b)
                    <option value="{{ $b->bom_id }}" @if ($item_level->boms->contains($b)) selected @endif>
                        {{ $b->bom_number }} - {{ $b->bom_description }}</option>
                @endforeach
            </select>


            <label for="input-kode-process" class="block my-2 text-gray-900">Kode Komponen</label>
            <button type="button"
                class="add_item bg-green-500 hover:bg-green-600 text-white font-bold rounded-r-lg px-4 py-2">Tambah kode
                komponen</button>
            <div id="item_components" class="h-500 overflow-y-auto">
                @foreach ($partial_components as $partial_component)
                    <div class="flex items-center mb-4">
                        <select name="item_components[]" class="rounded-l-lg w-1/2 px-4 py-2 border-r-0 border-gray-300"
                            required>
                            <option value="">Pilih Komponen</option>
                            @foreach ($item_components as $item_component)
                                <option value="{{ $item_component->item_component_id }}"
                                    @if ($item_component->item_component_id == $partial_component->item_component_id) selected @endif>
                                    {{ $item_component->item_number }} -
                                    {{ $item_component->item_description }}</option>
                            @endforeach
                        </select>
                        <input type="number" name="item_components_qty[]"
                            class="rounded-r-lg w-1/2 px-4 py-2 border-gray-300" placeholder="Qty"
                            value={{ $partial_component->pivot->item_component_qty }} required>
                        <button type="button"
                            class="remove_item bg-red-500 hover:bg-red-600 text-white font-bold px-4 py-2 mx-2">-</button>
                        <button type="button"
                            class="confirm_item bg-green-500 hover:bg-green-600 text-white font-bold rounded-r-lg px-4 py-2"
                            onclick="updateProcess('0')">Konfirmasi</button>
                    </div>
                @endforeach
            </div>


            <label class="block mb-2 font-medium text-gray-900 my-2" for="multiple_files">Upload Gambar</label>
            <input
                class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2.5"
                id="multiple_files" type="file" multiple name="photos[]">
            <label class="block mb-2 font-medium text-gray-900 my-2" for="stl_file">Upload STL</label>
            <input
                class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2.5"
                id="stl_file" type="file" name="stl">
            <label for="input-process" class="block my-2 text-gray-900">Process Entry</label>
            <select id="input-process" multiple autocomplete="off" name="process[]" onchange="updateEntryTable()">
                @foreach ($process_entry as $pe)
                    <option value="{{ $pe->process_entry_id }}" @if ($item_level->processEntries->contains($pe)) selected @endif>
                        {{ $pe->work_description }}</option>
                @endforeach
            </select>

            <h2 class="my-4 text-lg font-semibold text-gray-900">Daftar komponen</h2>


            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="min-w-full border text-center text-sm font-light dark:border-neutral-500"
                                id="table_components">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                            No
                                        </th>
                                        <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                            Item Kit ID
                                        </th>
                                        <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                            Bom ID
                                        </th>
                                        <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                            Kode Komponen
                                        </th>
                                        <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                            Nama Komponen
                                        </th>
                                        <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                            Jumlah
                                        </th>
                                        <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                            Total
                                        </th>
                                        <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                            Total Digunakan
                                        </th>
                                        <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                            Total Tersedia
                                        </th>
                                        <th scope="col" class="border-r px-6 py-4 dark:border-neutral-500">
                                            Satuan
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div id="pe_container">

            </div>


            <button type="button"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5"
                onclick="checkSafeSubmit()">Update
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
                    if (id == "#input-item-kit") {
                        if (checkToBeDeleted("item_kit", values)) {
                            return confirm(values.length > 1 ? 'Apakah anda yakin ingin menghapus ' + values
                                .length +
                                ' items?' : 'Apakah anda yakin ingin menghapus?');
                        } else {
                            alert("Item kit terdapat dalam process entry!");
                            return false;
                        }
                    } else if (id == "#input-bom") {
                        if (checkToBeDeleted("bom", values)) {
                            return confirm(values.length > 1 ? 'Apakah anda yakin ingin menghapus ' + values
                                .length +
                                ' items?' : 'Apakah anda yakin ingin menghapus?');
                        } else {
                            alert("BOM terdapat dalam process entry!");
                            return false;
                        }

                    }

                }
            });
        }

        function getDataComponent() {
            $.ajax({
                url: `/master/data/getDataTemp`,
                type: "POST",
                cache: false,
                success: function(response) {

                }
            });
        }
        //------------------

        function reloadComponentListTable(components) {
            $("#table_components tbody").html("");
            let iter = 0;

            $.each(components, function(key, comp) {
                console.log(comp);
                iter++;
                let appendedClass = "border-b dark:border-neutral-500";
                let total_available = comp.item_component_qty - comp.total_item_used;

                let total_available_item_kit = comp.item_kit_count - comp.total_item_kit_used;
                let total_available_bom = comp.bom_count - comp.total_bom_used;
                console.log(total_available_bom);
                let total_available_component = comp.component_count - comp.total_component_used;

                appendedClass = "border-b dark:border-neutral-500 text-black";
                if (comp.total_item_kit_used != 0 || comp.bom_used != 0 || comp.component_used != 0) {
                    appendedClass = "border-b dark:border-neutral-500 bg-yellow-100 text-black";
                }
                if (!comp.is_available) {
                    appendedClass = "border-b dark:border-neutral-500 bg-red-700 text-white";
                }
                let item_kit_numbers = comp.item_kit_numbers.join(", ");
                let bom_numbers = comp.bom_numbers.join(", ");

                if (item_kit_numbers == "") {
                    item_kit_numbers = "-"
                };
                if (bom_numbers == "") {
                    bom_numbers = "-"
                };
                $("#table_components tbody").append(`<tr class="${appendedClass}">
                    <td
                        class="whitespace-nowrap border-r px-6 py-4 font-medium dark:border-neutral-500">
                        ${iter}
                    </td>
                    <td
                        class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                        ${item_kit_numbers}
                    </td>
                    <td
                        class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                        ${bom_numbers}
                    </td>
                    <td
                        class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                        ${comp.item_number}
                    </td>
                    <td
                        class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                        ${comp.item_description}
                    </td>
                    <td
                    class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                    Item kit: ${comp.item_kit_count}<br> BOM: ${comp.bom_count}<br> Komponen: ${comp.component_count}
                    </td>

                    <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">${comp.item_component_qty}</td>
                    <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">
                        Item kit: ${comp.total_item_kit_used}<br> BOM: ${comp.total_bom_used}<br> Komponen: ${comp.total_component_used}
                    </td>
                    <td class="whitespace-nowrap border-r px-6 py-4 dark:border-neutral-500">Item kit: ${total_available_item_kit}<br> BOM: ${total_available_bom}<br> Komponen: ${total_available_component}</td>
                    <td class="whitespace-nowrap px-6 py-4 dark:border-neutral-500">${comp.item_uofm}</td>
                </tr>`);
            });
        }

        //----------------DONE
        function updateProcess(session_status) {
            let item_kits = $("#input-item-kit").val();
            let boms = $("#input-bom").val();

            let code_components = $("select[name=\'item_components[]\']").map(function() {
                return $(this).val();
            }).toArray();
            let qty_components = $("input[name=\'item_components_qty[]\']").map(function() {
                return $(this).val();
            }).toArray();

            let arrComps = [];
            for (let i = 0; i < code_components.length; i++) {
                arrComps.push({
                    id: code_components[i],
                    qty: qty_components[i]
                });
            }

            $.ajax({
                url: `/master/data/getProcessEntryItem`,
                type: "POST",
                cache: false,
                data: {
                    "item_kits": item_kits,
                    "boms": boms,
                    "code_components": arrComps,
                    "session_status": session_status
                },
                success: function(response) {
                    let components = response.data.components;
                    reloadComponentListTable(components);
                }
            });
        }
        //------------------------
        function generateTable(pe_id, pe_text, table_id) {
            $("#pe_container").append(
                `<div class="w-full rounded-lg py-5 pe_table_list" id="pe_${pe_id}">
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

                        <div class="container">
                            <select name="tier_components[]" class="rounded-l-lg w-1/2 px-4 py-2 border-r-0 border-gray-300" id="tier_${table_id}" required>
                                <option value="">Pilih Komponen</option>
                                @foreach ($item_components as $item_component)
                                <option value="{{ $item_component->item_component_id }}">
                                    {{ $item_component->item_number }} -
                                    {{ $item_component->item_description }}</option>
                                @endforeach
                            </select>
                            <input type="text" name="inputan_desc[]" id="input_tier_${table_id}" class="appearance-none bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" placeholder="Masukkan deskripsi">
                            <button class="confirm_item bg-green-500 hover:bg-green-600 text-white font-bold rounded-r-lg px-4 py-2" onclick="placeComponentToProcess('tier_${table_id}','input_tier_${table_id}','${table_id}')" type="button">Submit</button>
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
                                            QTY Item Kit
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            QTY BOM
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            QTY Komponen
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

        function placeComponentToProcess(select_val, input_val, table_id) {
            const selectedComp = $("#" + select_val).val();
            const desc = $("#" + input_val).val();
            console.log("tablenya: " + table_id);
            $.ajax({
                url: `/master/data/placeComponentToProcess`,
                type: "POST",
                cache: false,
                data: {
                    "item_component_id": selectedComp,
                    "desc": desc,
                    "table_id": table_id
                },
                success: function(response) {
                    alert(response.message);
                }
            });
        }

        function checkSafeSubmit() {

            let item_components = $("select[name=\'tier_components[]\']").map(function() {
                return $(this).val();
            }).toArray();
            let desc_components = $("input[name=\'inputan_desc[]\']").map(function() {
                return $(this).val();
            }).toArray();

            let emptySelect = item_components.indexOf("");
            let emptyDesc = desc_components.indexOf("");

            if (emptySelect != -1 || emptyDesc != -1) {
                alert("Harap isi semua komponen dan desc nya pada process entry!");
            } else {
                $.ajax({
                    url: `/master/data/getProcessEntryItem`,
                    type: "POST",
                    cache: false,
                    data: {
                        "session_status": 1
                    },
                    success: function(response) {
                        let components = response.data.components;
                        let isFound = false;
                        for (const [key, value] of Object.entries(components)) {
                            if (value.is_available) {
                                isFound = true;
                                break;
                            }
                        }
                        if (!isFound) {
                            //submit
                            document.getElementById("editForm").submit();
                        } else {
                            alert("Masih terdapat komponen yang belum digunakan!");
                        }
                    }
                });
            }
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

        function updateQTY(input_comp, table_id, item_number, qty, source) {
            $.ajax({
                url: `/master/data/updateQty`,
                type: "POST",
                cache: false,
                data: {
                    "item_number": item_number,
                    "table_id": table_id,
                    "qty": qty,
                    "source": source
                },
                success: function(response) {
                    if (response.success) {
                        reloadComponentListTable(response.components);
                    } else {
                        //failed
                        alert("Total komponen yang tersedia tidak mencukupi!");
                        $(input_comp).val(response.current_qty);
                    }
                }
            });
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
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="QTY" value=${item.item_kit_qty} onchange=updateQTY(this,'${table_id}','${item.item_number}',this.value,"item_kit")>
                </td>
                <td scope="col" class="px-6 py-3">
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="QTY" value=${item.bom_qty} onchange=updateQTY(this,'${table_id}','${item.item_number}',this.value,"bom")>
                </td>
                <td scope="col" class="px-6 py-3">
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="text" placeholder="QTY" value=${item.component_qty} onchange=updateQTY(this,'${table_id}','${item.item_number}',this.value,"component")>
                </td>


                <td scope="col" class="px-6 py-3">
                    <button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" onclick=deleteComponentTable('${table_id}','${item.item_number}',this)>Hapus</button>
                </td>
            </tr>
        `);
        }

        function addComponent(table_id, item_number) {
            console.log("tableku: " + table_id);
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
                        reloadComponentListTable(response.data.components);
                    } else {
                        //failed
                        alert(response.message);
                    }
                }
            });

        }

        function checkToBeDeleted(resource, id) {
            let resp = false;
            $.ajax({
                url: `/master/data/checkToBeDeleted`,
                type: "POST",
                cache: false,
                async: false,
                data: {
                    'resource': resource,
                    'id': id[0]
                },
                success: function(response) {
                    console.log(response);
                    console.log(response);
                    if (response.is_allowed) {
                        resp = true;
                    } else {
                        resp = false;
                    }
                }
            });
            return resp;
        }

        function updateInputTable($table_id, $item_number) {
            $.ajax({
                url: `/master/data/updateInputTable`,
                type: "POST",
                cache: false,
                data: {
                    "item_number": item_number,
                    "table_id": table_id
                },
                success: function(response) {
                    if (response.success) {
                        let item = response.data.item;
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
            console.log("table: " + table_id);
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
                        let tier = response.table_tier;
                        if (tier != null) {
                            $("#input_tier_" + table_id).val(tier.desc);
                            $("#tier_" + table_id).val(tier.item_component_id);
                        }
                        if (items != null) {
                            //foreach
                            $.each(items, function(key, item) {
                                placeComponentToTable(table_id, item);
                            });
                        }
                    } else {
                        //refresh multiple tables
                        let tables = response.tables;
                        let process_entries = response.process_entries;
                        //push tables
                        $.each(process_entries, function(key, pe) {
                            let table_id = 'pe_table_' + pe.process_entry_id;
                            generateTable(pe.process_entry_id, pe.work_description, table_id);


                            let tier = (response.table_tier);
                            if (tier != null) {
                                tier = (response.table_tier)[table_id];
                                $("#input_tier_" + table_id).val(tier.desc);
                                $("#tier_" + table_id).val(tier.item_component_id);
                            }

                            $.each(tables[table_id], function(key, item) {
                                let it = {
                                    item_number: item.item_number,
                                    item_description: item.item_description,
                                    item_component_qty: item.item_component_qty,
                                    item_kit_qty: item.item_kit_qty,
                                    bom_qty: item.bom_qty,
                                    component_qty: item.component_qty
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

            $.ajax({
                url: `/master/data/deleteComponentTable`,
                type: "POST",
                cache: false,
                data: {
                    "item_number": item_number,
                    "table_id": table_id
                },
                success: function(response) {
                    console.log("deleted");
                    if (response.success) {
                        refreshTable(table_id);
                        reloadComponentListTable(response.components);
                    } else {
                        //failed
                        alert(response.message);
                    }
                }
            });
        }

        function callConfirmed(button) {
            updateProcess('0');
            button.parentNode.removeChild(button);

        }

        let addItemButton = document.querySelector('.add_item');
        let itemsContainer = document.querySelector('#item_components');
        let itemInputFields = `<div class="flex items-center mb-4">
                                    <select name="item_components[]" class="rounded-l-lg w-1/2 px-4 py-2 border-r-0 border-gray-300" required>
                                        <option value="">Pilih Komponen</option>
                                        @foreach ($item_components as $item_component)
                                        <option value="{{ $item_component->item_component_id }}">
                                            {{ $item_component->item_number }} -
                                            {{ $item_component->item_description }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="item_components_qty[]" class="rounded-r-lg w-1/2 px-4 py-2 border-gray-300" placeholder="Qty" required>
                                    <button type="button" class="remove_item bg-red-500 hover:bg-red-600 text-white font-bold px-4 py-2 mx-2">-</button>
                                    <button type="button" class="confirm_item bg-green-500 hover:bg-green-600 text-white font-bold rounded-r-lg px-4 py-2" onclick="callConfirmed(this)">Konfirmasi</button>
                                </div>`;
        addItemButton.addEventListener('click', () => {
            itemsContainer.insertAdjacentHTML('beforeend', itemInputFields);
        });


        itemsContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove_item')) {
                event.target.parentNode.remove();
            }
        });

        setTimeout(() => {
            refreshTable("all");
            updateProcess('0');
        }, 1000);

        generateTom("#input-departemen")
        generateTom("#input-komponen")
        generateTom("#input-item-kit")
        generateTom("#input-bom")
        generateTom("#input-process")
        generateTom("#input-kode-process")
    </script>
@endsection
