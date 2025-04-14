<div id="editDrugModal" class="fixed inset-0 items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-1/3">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-lg font-semibold">Edit Drug</h3>
            <button id="closeEditModalButton" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="p-4">
            <form id="editDrugForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="editDrugName" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" id="editDrugName" required
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
                <div class="mb-4">
                    <label for="editDrugType" class="block text-sm font-medium text-gray-700">Jenis</label>
                    <select name="type" id="editDrugType" required
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white">
                        <option value="Tablet">Tablet</option>
                        <option value="Kapsul">Kapsul</option>
                        <option value="Sirup">Sirup</option>
                        <option value="Salep">Salep</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="editDrugStock" class="block text-sm font-medium text-gray-700">Stok</label>
                    <input type="number" name="stock" id="editDrugStock" required
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                </div>
                <div class="mb-4">
                    <label for="editDrugPrice" class="block text-sm font-medium text-gray-700">Harga</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-600">Rp.</span>
                        <input type="text" name="price" id="editDrugPrice" required
                            class="w-full pl-9 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="0">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="editDrugDescription" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                    <textarea name="description" id="editDrugDescription" rows="3" required
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeEditModal"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
