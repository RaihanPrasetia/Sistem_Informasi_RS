<div id="addResepModal" class="fixed inset-0 hidden bg-gray-900/50 items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-lg font-semibold">Beri Resep</h3>
            <button type="button" onclick="closeModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times hover:text-red-500 hover:cursor-pointer text-2xl"></i>
            </button>
        </div>
        <div class="p-4">
            <!-- Informasi Pendaftaran -->
            <div class="mb-4">
                <p><strong>Nama Pasien:</strong> <span id="modalPatientName" class="text-gray-700"></span></p>
                <p><strong>Layanan:</strong> <span id="modalServiceName" class="text-gray-700"></span></p>
            </div>

            <form id="formResep" action="{{ route('peresepan.store') }}" method="POST">
                @csrf
                <input type="hidden" name="registration_id" id="registration_id">
                <!-- Daftar Obat -->
                <div id="drugList">
                    <div class="drug-item mb-4">
                        <div class="flex justify-center items-end space-x-2">
                            <!-- Pilih Obat -->
                            <div class="w-full">
                                <label for="drug_id_0" class="block text-sm font-medium text-gray-700">Pilih
                                    Obat</label>
                                <select name="drugs[0][id]" id="drug_id_0" required
                                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white">
                                    <option value="" disabled selected>Pilih Obat</option>
                                    @foreach ($drugs as $drug)
                                        <option value="{{ $drug->id }}">{{ $drug->name }} - {{ $drug->type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Jumlah -->
                            <div>
                                <label for="quantity_0" class="block text-sm font-medium text-gray-700">Jumlah</label>
                                <input type="number" name="drugs[0][quantity]" id="quantity_0" required
                                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                                    placeholder="Masukkan jumlah obat">
                            </div>

                            <!-- Dosis -->
                            <div>
                                <label for="dosage_0" class="block text-sm font-medium text-gray-700">Dosis</label>
                                <input type="text" name="drugs[0][dosage]" id="dosage_0" required
                                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                                    placeholder="Masukkan dosis obat">
                            </div>

                            <!-- Tombol Delete -->
                            <div>
                                <button type="button" onclick="deleteDrugRow(this)"
                                    class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">Hapus</button>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- Tombol Tambah Obat -->
                <div class="mb-4">
                    <button type="button" onclick="addDrugRow()"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Tambah Obat</button>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end mt-4">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="updateResepModal" class="fixed inset-0 hidden bg-gray-900/50 items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl">
        <div class="flex justify-between items-center border-b p-4">
            <h3 class="text-lg font-semibold">Update Resep</h3>
            <button type="button" onclick="closeUpdateModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-times hover:text-red-500 hover:cursor-pointer text-2xl"></i>
            </button>
        </div>
        <div class="p-4">
            <!-- Informasi Pendaftaran -->
            <div class="mb-4">
                <p><strong>Nama Pasien:</strong> <span id="updateModalPatientName" class="text-gray-700"></span></p>
                <p><strong>Layanan:</strong> <span id="updateModalServiceName" class="text-gray-700"></span></p>
            </div>

            <form id="updateFormResep" action="{{ route('peresepan.update', ['peresepan' => 'registration_id']) }}"
                method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="registration_id" id="updateRegistrationId">
                <!-- Daftar Obat -->
                <div id="updateDrugList">
                    <!-- Obat yang sudah ada akan dimuat di sini melalui JavaScript -->
                </div>

                <!-- Tombol Tambah Obat -->
                <div class="mb-4">
                    <button type="button" onclick="addDrugRow()"
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Tambah Obat</button>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end mt-4">
                    <button type="button" onclick="closeUpdateModal()"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 mr-2">Batal</button>
                    <button type="submit"
                        class="px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    let drugIndex = 1;

    function addDrugRow() {
        const drugList = document.getElementById('drugList');
        const newDrugRow = document.createElement('div');
        newDrugRow.classList.add('drug-item', 'mb-4');
        newDrugRow.innerHTML = `
        <div class="flex justify-evenly items-end space-x-2">
            <!-- Pilih Obat -->
            <div class="w-full">
                <label for="drug_id_${drugIndex}" class="block text-sm font-medium text-gray-700">Pilih Obat</label>
                <select name="drugs[${drugIndex}][id]" id="drug_id_${drugIndex}" required
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white">
                    <option value="" disabled selected>Pilih Obat</option>
                    @foreach ($drugs as $drug)
                        <option value="{{ $drug->id }}">{{ $drug->name }} - {{ $drug->type }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Jumlah -->
            <div>
                <label for="quantity_${drugIndex}" class="block text-sm font-medium text-gray-700">Jumlah</label>
                <input type="number" name="drugs[${drugIndex}][quantity]" id="quantity_${drugIndex}" required
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                    placeholder="Masukkan jumlah obat">
            </div>

            <!-- Dosis -->
            <div>
                <label for="dosage_${drugIndex}" class="block text-sm font-medium text-gray-700">Dosis</label>
                <input type="text" name="drugs[${drugIndex}][dosage]" id="dosage_${drugIndex}" required
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                    placeholder="Masukkan dosis obat">
            </div>

              <!-- Tombol Delete -->
             <div class="text-right flex items-center justify-center mb-0">
                            <button type="button" onclick="deleteDrugRow(this)"
                                class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">Hapus</button>
              </div>
        </div>
    `;
        drugList.appendChild(newDrugRow);
        drugIndex++;
    }

    function openUpdateModal(registrationId, patientName, serviceName) {
        const modal = document.getElementById('updateResepModal');
        const registrationIdInput = document.getElementById('updateRegistrationId');
        const modalPatientName = document.getElementById('updateModalPatientName');
        const modalServiceName = document.getElementById('updateModalServiceName');
        const drugList = document.getElementById('updateDrugList');

        if (modal && registrationIdInput && modalPatientName && modalServiceName && drugList) {
            // Isi data ke modal
            registrationIdInput.value = registrationId;
            modalPatientName.textContent = patientName;
            modalServiceName.textContent = serviceName;

            // Kosongkan daftar obat sebelumnya
            drugList.innerHTML = '';

            // Ambil data resep dan semua obat dari server
            fetch(`/api/registration/${registrationId}/drugs`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    const {
                        selectedDrugs,
                        allDrugs
                    } = data;

                    selectedDrugs.forEach((drug, index) => {
                        const drugRow = document.createElement('div');
                        drugRow.classList.add('drug-item', 'mb-4');
                        drugRow.innerHTML = `
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label for="drug_id_${index}" class="block text-sm font-medium text-gray-700">Pilih Obat</label>
                                <select name="drugs[${index}][id]" id="drug_id_${index}" required
                                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white">
                                    ${allDrugs.map(drugOption => `
                                        <option value="${drugOption.id}" ${drugOption.id === drug.id ? 'selected' : ''}>
                                            ${drugOption.name}
                                        </option>
                                    `).join('')}
                                </select>
                            </div>
                            <div>
                                <label for="quantity_${index}" class="block text-sm font-medium text-gray-700">Jumlah</label>
                                <input type="number" name="drugs[${index}][quantity]" id="quantity_${index}" value="${drug.quantity}" required
                                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                            </div>
                            <div>
                                <label for="dosage_${index}" class="block text-sm font-medium text-gray-700">Dosis</label>
                                <input type="text" name="drugs[${index}][dosage]" id="dosage_${index}" value="${drug.dosage}" required
                                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                            </div>
                        </div>

                        <!-- Tombol Delete -->
                        <div class="mt-2 text-right">
                            <button type="button" onclick="deleteDrugRow(this)"
                                class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600">Hapus</button>
                        </div>
                    `;
                        drugList.appendChild(drugRow);
                    });
                })
                .catch(error => console.error('Error fetching drugs:', error));

            // Tampilkan modal
            modal.classList.remove('hidden');
        } else {
            console.error('Modal atau elemen terkait tidak ditemukan.');
        }
    }

    function closeUpdateModal() {
        const modal = document.getElementById('updateResepModal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    function openResepModal(registrationId, patientName, serviceName) {
        const modal = document.getElementById('addResepModal');
        const registrationIdInput = document.getElementById('registration_id');
        const modalPatientName = document.getElementById('modalPatientName');
        const modalServiceName = document.getElementById('modalServiceName');

        if (modal && registrationIdInput && modalPatientName && modalServiceName) {
            // Isi data ke modal
            registrationIdInput.value = registrationId;
            modalPatientName.textContent = patientName;
            modalServiceName.textContent = serviceName;

            // Tampilkan modal
            modal.classList.remove('hidden');
        } else {
            console.error('Modal atau elemen terkait tidak ditemukan.');
        }
    }

    function closeModal() {
        const modal = document.getElementById('addResepModal');
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    function deleteDrugRow(button) {
        const drugRow = button.closest('.drug-item');
        if (drugRow) {
            drugRow.remove();
        }
    }
</script>
