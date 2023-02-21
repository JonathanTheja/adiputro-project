<input type="checkbox" id="my-modal-add" class="modal-toggle" />
<label for="my-modal-add" class="modal cursor-pointer">
    <label class="modal-box relative" for="">
        <label for="my-modal-add" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
        <form action="/master/data/add" method="post">
            @csrf
            <h3 class="text-lg font-bold" id="titleModal"></h3>
            <div class="py-4" id="bodyModal"></div>
            <input type="text" class="hidden" id="spk_id" name="spk_id">
            <input type="text" name="name" id="name"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Name" required>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Tambah Komponen Baru</button>
        </form>
    </label>
</label>
