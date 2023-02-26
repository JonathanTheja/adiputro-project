<input type="checkbox" id="my-modal-update" class="modal-toggle" />
<label for="my-modal-update" class="modal cursor-pointer">
    <label class="modal-box relative" for="">
        <label for="my-modal-update" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
        <form action="/master/data/update" method="post">
            @csrf
            <h3 class="text-lg font-bold" id="titleModalUpdate"></h3>
            <div class="py-4" id="bodyModalUpdate"></div>
            <input type="text" class="hidden" id="item_level_id_update" name="item_level_id">
            <label for="nameUpdate" class="block my-2 text-gray-900">Nama Komponen</label>
            <input type="text" name="name" id="nameUpdate"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Name" required>

            <label for="input-departemen" class="block my-2 text-gray-900">Departemen</label>
            <select id="input-departemen" multiple autocomplete="off">
                @foreach ($departments as $department)
                    <option value="{{ $department->department_id }}">{{ $department->name }}</option>
                @endforeach
            </select>
            <label for="input-komponen" class="block my-2 text-gray-900">Komponen</label>
            <select id="input-komponen" multiple autocomplete="off">
                @foreach ($departments as $department)
                    <option value="{{ $department->department_id }}">{{ $department->name }}</option>
                @endforeach
            </select>

            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Update Komponen</button>
        </form>
    </label>
</label>
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

</script>
