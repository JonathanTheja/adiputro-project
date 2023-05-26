<div class="hidden" id="modalKonfirmasi">
    <input type="checkbox" id="my-modal-konfirmasi" class="modal-toggle" />
    <label for="my-modal-konfirmasi" class="modal cursor-pointer">
        <label class="modal-box relative" for="">
            <label for="my-modal-konfirmasi" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <h3 class="text-lg font-bold" id="titleModal">Konfirmasi Tambah Laporan</h3>
            <div class="py-4" id="bodyModal">Username</div>
            <input type="text" name="username" id="username"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Username" required>
            <div class="py-4" id="bodyModal">Password</div>
            <input type="password" name="password" id="password"
                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Password" required>
            <button type="submit" onclick="konfirmasi()"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mt-5">Konfirmasi</button>
        </label>
    </label>
</div>
