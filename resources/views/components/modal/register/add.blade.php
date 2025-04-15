<div id="addPatientModal" class="fixed inset-0 items-center justify-center hidden bg-gray-900/50 overflow-y-auto">
    <div class="bg-white rounded-lg shadow-lg w-1/3">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-lg font-semibold">Tambah Pasien</h3>
        </div>
        <div class="p-4">
            <form action="{{ route('register.patient') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Nama -->
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="name" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                    </div>

                    <!-- NIK -->
                    <div class="mb-4">
                        <label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
                        <input type="number" name="nik" id="nik" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="mb-4">
                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="phone" id="phone"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-4">
                        <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="gender" id="gender" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white">
                            <option value="" disabled selected>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="mb-4">
                        <label for="birth_date" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="birth_date" id="birth_date" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                    </div>

                    <!-- Umur -->
                    <div class="mb-4">
                        <label for="age" class="block text-sm font-medium text-gray-700">Umur</label>
                        <input type="number" name="age" id="age" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Masukkan umur pasien">
                    </div>

                    <!-- Negara -->
                    <div class="mb-4">
                        <label for="country_id" class="block text-sm font-medium text-gray-700">Negara</label>
                        <select name="country_id" id="country_id" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white">
                            <option value="" disabled selected>Pilih Negara</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Provinsi -->
                    <div class="mb-4">
                        <label for="state_id" class="block text-sm font-medium text-gray-700">Provinsi</label>
                        <select name="state_id" id="state_id" required disabled
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white">
                            <option value="" disabled selected>(Pilih Negara Terlebih Dahulu)
                            </option>
                        </select>
                    </div>

                    <!-- Kota -->
                    <div class="mb-4">
                        <label for="city_id" class="block text-sm font-medium text-gray-700">Kota</label>
                        <select name="city_id" id="city_id" required disabled
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white">
                            <option value="" disabled selected>(Pilih Provinsi Terlebih Dahulu)
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Detail Alamat -->
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium text-gray-700">Detail Alamat</label>
                    <textarea name="address" id="address" rows="3" required
                        class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                        placeholder="Masukkan detail alamat"></textarea>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end">
                    <button type="button" data-close-modal="addPatientModal"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
