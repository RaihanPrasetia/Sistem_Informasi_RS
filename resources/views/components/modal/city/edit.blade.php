<div id="editCityModal" class="fixed inset-0 items-center justify-center hidden bg-gray-900/50">
    <div class="bg-white rounded-lg shadow-lg w-1/3">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-lg font-semibold text-gray-700">Edit City</h3>
            <button data-close-modal="editCityModal" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times hover:text-red-500 hover:cursor-pointer text-2xl"></i>
            </button>
        </div>
        <div class="p-4">
            <form id="editCityForm" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="state_id" id="state_id" value="{{ request('state_id') }}">

                <!-- Nama -->
                <div class="mb-4">
                    <label for="editCityName" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="editCityName" required
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                        placeholder="Nama City">
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end">
                    <button type="button" data-close-modal="editCityModal"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
