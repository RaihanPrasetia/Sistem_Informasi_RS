<div id="addServiceModal" class="fixed inset-0 items-center justify-center hidden bg-gray-900/50 overflow-y-auto">
    <div class="bg-white rounded-lg shadow-lg w-1/3">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-lg font-semibold">Tambah Layanan</h3>
            <button data-close-modal="addServiceModal" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times hover:text-red-500 hover:cursor-pointer text-2xl"></i>
            </button>
        </div>
        <div class="p-4">
            <form action="{{ route('service.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-4">
                    <!-- Nama Layanan -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Layanan</label>
                        <input type="text" name="name" id="name" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Masukkan nama layanan">
                    </div>

                    <!-- Harga -->
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-600">Rp.</span>
                            <input type="text" name="price" id="price" required
                                class="w-full pl-9 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                                placeholder="0">
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea name="description" id="description" rows="3"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Masukkan deskripsi layanan"></textarea>
                    </div>

                    <!-- Dokter -->
                    <div>
                        <label for="doctor_id" class="block text-sm font-medium text-gray-700">Dokter</label>
                        <select name="doctor_id" id="doctor_id" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white">
                            <option value="" disabled selected>Pilih Dokter</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end mt-4">
                    <button type="button" data-close-modal="addServiceModal"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
