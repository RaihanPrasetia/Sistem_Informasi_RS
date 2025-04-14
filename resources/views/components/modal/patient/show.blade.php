<div id="viewDrugModal" class="fixed inset-0 bg-gray-900/50 bg-opacity-50 items-center justify-center hidden">
    <div class="bg-white rounded-lg shadow-lg w-1/3">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-lg font-semibold text-gray-700">Detail Drug</h3>
            <button id="closeViewModalButton" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-4">
            <p class="mb-2"><strong>Nama:</strong> <span id="viewDrugName" class="text-gray-700"></span></p>
            <p class="mb-2"><strong>Jenis:</strong> <span id="viewDrugType" class="text-gray-700"></span></p>
            <p class="mb-2"><strong>Stok:</strong> <span id="viewDrugStock" class="text-gray-700"></span></p>
            <p class="mb-2"><strong>Harga:</strong> <span id="viewDrugPrice" class="text-gray-700"></span></p>
            <p class="mb-4"><strong>Deskripsi:</strong> <span id="viewDrugDescription" class="text-gray-700"></span>
            </p>
            <div class="flex justify-end">
                <button id="closeViewModal"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Tutup</button>
            </div>
        </div>
    </div>
</div>
