import Swal from 'sweetalert2';

const sidebarToggle = document.getElementById('sidebarToggle');
const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');
const sidebarIcon = document.getElementById('sidebarIcon');

sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
    content.classList.toggle('ml-64');
    navbar.classList.toggle('ml-64');

    // Ubah warna ikon menjadi hijau saat sidebar aktif
    if (!sidebar.classList.contains('-translate-x-full')) {
        sidebarIcon.classList.add('text-green-500');
        sidebarIcon.classList.remove('text-gray-700');
    } else {
        sidebarIcon.classList.remove('text-green-500');
        sidebarIcon.classList.add('text-gray-700');
    }
});

document.addEventListener('DOMContentLoaded', () => {
    // Fungsi untuk membuka modal
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            modal.classList.add('bg-gray-900/50');
        }
    }

    // Fungsi untuk menutup modal
    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden');
        }
    }

    // Tambahkan event listener untuk tombol buka modal
    document.querySelectorAll('[data-open-modal]').forEach((button) => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-open-modal');
            openModal(modalId);
        });
    });

    // Tambahkan event listener untuk tombol tutup modal
    document.querySelectorAll('[data-close-modal]').forEach((button) => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-close-modal');
            closeModal(modalId);
        });
    });

    // Fungsi untuk membuka modal edit dengan data
    function openEditDrugModal(drug) {
        const form = document.getElementById('editDrugForm');
        form.action = `/drug/${drug.id}`;
        document.getElementById('editDrugName').value = drug.name;
        document.getElementById('editDrugType').value = drug.type;
        document.getElementById('editDrugStock').value = drug.stock;
        document.getElementById('editDrugPrice').value = drug.price;
        document.getElementById('editDrugDescription').value = drug.description;
    }

    // Fungsi untuk membuka modal edit dengan data negara
    function openEditCountryModal(country) {
        const form = document.getElementById('editCountryForm');
        form.action = `/country/${country.id}`;
        document.getElementById('editCountryName').value = country.name;
    }

    function openEditPatientModal(patient) {
        const form = document.getElementById('editPatientForm');
        form.action = `/patient/${patient.id}`;
        document.getElementById('editPatientNumber').value = patient.patient_number;
        document.getElementById('editPatientName').value = patient.name;
        document.getElementById('editPatientNik').value = patient.nik;
        document.getElementById('editPatientPhone').value = patient.phone;
        document.getElementById('editPatientGender').value = patient.gender;
        document.getElementById('editPatientBirthDate').value = patient.birth_date;
        document.getElementById('editPatientAge').value = patient.age;
        document.getElementById('editPatientAddress').value = patient.address;

        // Buka modal
        document.getElementById('editPatientModal').classList.remove('hidden');
    }


    // Fungsi untuk membuka modal edit dengan data provinsi
    function openEditStateModal(state) {
        const form = document.getElementById('editStateForm');
        form.action = `/state/${state.id}`;
        document.getElementById('editStateName').value = state.name;
    }

    function openEditServiceModal(service) {
        const form = document.getElementById('editServiceForm');
        form.action = `/service/${service.id}`; // Atur URL action untuk form

        document.getElementById('editServiceName').value = service.name;
        document.getElementById('editServicePrice').value = service.price;
        document.getElementById('editServiceDescription').value = service.description;
        document.getElementById('editServiceDoctor').value = service.doctor_id;

        // Buka modal
        document.getElementById('editServiceModal').classList.remove('hidden');
    }

    // Pastikan fungsi tersedia di global scope
    window.openEditServiceModal = openEditServiceModal;
    window.openEditPatientModal = openEditPatientModal;
    window.openEditStateModal = openEditStateModal;
    window.openEditCountryModal = openEditCountryModal;
    window.openEditDrugModal = openEditDrugModal;

    // Fungsi untuk membuka modal view dengan data
    function openViewModal(modalId, data) {
        const modal = document.getElementById(modalId);
        if (modal) {
            // Isi data ke dalam elemen view di modal
            Object.keys(data).forEach((key) => {
                const element = modal.querySelector(`[data-view="${key}"]`);
                if (element) {
                    element.textContent = data[key];
                }
            });
            openModal(modalId);
        }
    }

    document.getElementById('country_id').addEventListener('change', function () {
        const countryId = this.value;
        const stateSelect = document.getElementById('state_id');
        const citySelect = document.getElementById('city_id');

        // Reset dropdown state dan city
        stateSelect.innerHTML = '<option value="" disabled selected>(Pilih Negara Terlebih Dahulu)</option>';
        citySelect.innerHTML = '<option value="" disabled selected>(Pilih Provinsi Terlebih Dahulu)</option>';
        citySelect.disabled = true;

        if (countryId) {
            stateSelect.disabled = false;
            fetch(`/api/states?country_id=${countryId}`)
                .then(response => response.json())
                .then(data => {
                    stateSelect.innerHTML = '<option value="" disabled selected>Pilih Provinsi</option>';
                    data.forEach(state => {
                        stateSelect.innerHTML += `<option value="${state.id}">${state.name}</option>`;
                    });
                });
        } else {
            stateSelect.disabled = true;
        }
    });

    document.getElementById('state_id').addEventListener('change', function () {
        const stateId = this.value;
        const citySelect = document.getElementById('city_id');

        // Reset dropdown city
        citySelect.innerHTML = '<option value="" disabled selected>(Pilih Provinsi Terlebih Dahulu)</option>';

        if (stateId) {
            citySelect.disabled = false;
            fetch(`/api/cities?state_id=${stateId}`)
                .then(response => response.json())
                .then(data => {
                    citySelect.innerHTML = '<option value="" disabled selected>Pilih Kota</option>';
                    data.forEach(city => {
                        citySelect.innerHTML += `<option value="${city.id}">${city.name}</option>`;
                    });
                });
        } else {
            citySelect.disabled = true;
        }
    });

    // Fungsi untuk konfirmasi hapus
    function confirmDelete(deleteUrl) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data ini akan dihapus secara permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                // Buat form untuk mengirimkan permintaan DELETE
                const form = document.createElement('form');
                form.action = deleteUrl;
                form.method = 'POST';

                // Tambahkan CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);

                // Tambahkan metode DELETE
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                // Tambahkan form ke body dan submit
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    // Pastikan fungsi tersedia di global scope
    window.openModal = openModal;
    window.closeModal = closeModal;
    window.openEditModal = openEditModal;
    window.openViewModal = openViewModal;
    window.confirmDelete = confirmDelete;
});

const successMessage = document.getElementById('successMessage');
if (successMessage) {
    // Tampilkan pesan dengan animasi
    successMessage.classList.remove('translate-x-full');
    successMessage.classList.add('translate-x-0');

    // Sembunyikan pesan setelah 3 detik
    setTimeout(() => {
        successMessage.classList.add('translate-x-full');
        setTimeout(() => {
            successMessage.classList.add('hidden'); // Sembunyikan elemen sepenuhnya setelah animasi
        }, 500); // Waktu untuk animasi keluar
    }, 3000); // Waktu tampil pesan
}
const errorMessage = document.getElementById('errorMessage');
if (errorMessage) {
    // Tampilkan pesan dengan animasi
    errorMessage.classList.remove('translate-x-full');
    errorMessage.classList.add('translate-x-0');

    // Sembunyikan pesan setelah 3 detik
    setTimeout(() => {
        errorMessage.classList.add('translate-x-full');
        setTimeout(() => {
            errorMessage.classList.add('hidden'); // Sembunyikan elemen sepenuhnya setelah animasi
        }, 500); // Waktu untuk animasi keluar
    }, 3000); // Waktu tampil pesan
}

const priceInput = document.getElementById('price');
if (priceInput) {
    priceInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/[^0-9]/g, ''); // Hanya angka
        if (value) {
            value = new Intl.NumberFormat('id-ID').format(value); // Format angka
            e.target.value = `${value}`; // Tambahkan awalan "Rp."
        } else {
            e.target.value = ''; // Kosongkan jika tidak ada angka
        }
    });

    // Hapus format sebelum form dikirim
    priceInput.addEventListener('blur', function (e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, ''); // Hapus pemisah ribuan dan awalan "Rp."
    });
}

const editPriceInput = document.getElementById('editDrugPrice');
if (editPriceInput) {
    editPriceInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/[^0-9]/g, ''); // Hanya angka
        if (value) {
            value = new Intl.NumberFormat('id-ID').format(value); // Format angka
            e.target.value = `${value}`; // Tambahkan awalan "Rp."
        } else {
            e.target.value = ''; // Kosongkan jika tidak ada angka
        }
    });

    // Hapus format sebelum form dikirim
    editPriceInput.addEventListener('blur', function (e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, ''); // Hapus pemisah ribuan dan awalan "Rp."
    });
}
