<div id="editPatientModal" class="fixed inset-0 items-center justify-center hidden bg-gray-900/50 overflow-y-auto">
    <div class="bg-white rounded-lg shadow-lg w-1/3">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-lg font-semibold text-gray-700">Edit Pasien</h3>
            <button data-close-modal="editPatientModal" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times hover:text-red-500 hover:cursor-pointer text-2xl"></i>
            </button>
        </div>
        <div class="p-4">
            <form id="editPatientForm" method="POST">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nomor Pasien -->
                    <div class="mb-4">
                        <label for="editPatientNumber" class="block text-sm font-medium text-gray-700">Nomor
                            Pasien</label>
                        <input type="text" name="patient_number" id="editPatientNumber" readonly
                            class="w-full p-2 border border-gray-300 rounded-md bg-gray-100 focus:outline-none"
                            placeholder="Nomor Pasien">
                    </div>

                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="editPatientName" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="editPatientName" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Masukkan nama pasien">
                    </div>

                    <!-- NIK -->
                    <div class="mb-4">
                        <label for="editPatientNik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="number" name="nik" id="editPatientNik" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Masukkan NIK pasien">
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mb-4">
                        <label for="editPatientPhone" class="block text-sm font-medium text-gray-700">Nomor
                            Telepon</label>
                        <input type="text" name="phone" id="editPatientPhone"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Masukkan nomor telepon pasien">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-4">
                        <label for="editPatientGender" class="block text-sm font-medium text-gray-700">Jenis
                            Kelamin</label>
                        <select name="gender" id="editPatientGender" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-4">
                        <label for="editPatientBirthDate" class="block text-sm font-medium text-gray-700">Tanggal
                            Lahir</label>
                        <input type="date" name="birth_date" id="editPatientBirthDate" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                    </div>

                    <!-- Umur -->
                    <div class="mb-4">
                        <label for="editPatientAge" class="block text-sm font-medium text-gray-700">Umur</label>
                        <input type="number" name="age" id="editPatientAge" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Masukkan umur pasien">
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4 md:col-span-2">
                        <label for="editPatientAddress" class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="address" id="editPatientAddress" rows="3" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Masukkan alamat pasien"></textarea>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end mt-4">
                    <button type="button" data-close-modal="editPatientModal"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
