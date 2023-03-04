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
            <select id="input-item-kit" multiple autocomplete="off" name="itemkit[]">
                @foreach ($item_kit as $ikit)
                    <option value="{{ $ikit->item_kit_id }}">{{ $ikit->item_kit_number }} - {{ $ikit->item_kit_description }}</option>
                @endforeach
            </select>
            <label for="input-bom" class="block my-2 text-gray-900">BOM ID</label>
            <select id="input-bom" multiple autocomplete="off" name="bom[]">
                @foreach ($bom as $b)
                    <option value="{{ $b->bom_id }}">{{ $b->bom_number }} - {{ $b->bom_description }}</option>
                @endforeach
            </select>
            <label class="block mb-2 font-medium text-gray-900 my-2" for="multiple_files">Upload Gambar</label>
            <input class="block w-full text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none p-2.5" id="multiple_files" type="file" multiple name="photos[]">
            <label for="input-process" class="block my-2 text-gray-900">Process Entry</label>
            <select id="input-process" multiple autocomplete="off" name="process[]">
                @foreach ($process_entry as $pe)
                    <option value="{{ $pe->process_entry_id }}">{{$pe->work_description}}</option>
                @endforeach
            </select>
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
                return confirm(values.length > 1 ? 'Are you sure you want to remove these ' + values.length + ' items?' : 'Are you sure you want to remove "' + values[0] + '"?');
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
