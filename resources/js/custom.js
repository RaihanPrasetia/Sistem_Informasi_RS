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

const addDrugButton = document.getElementById('addDrugButton');
const addDrugModal = document.getElementById('addDrugModal');
const closeModalButton = document.getElementById('closeModalButton');
const cancelButton = document.getElementById('cancelButton');

addDrugButton.addEventListener('click', () => {
    addDrugModal.classList.remove('hidden');
    addDrugModal.classList.add('flex');
    addDrugModal.classList.add('bg-gray-900/50');
});

closeModalButton.addEventListener('click', () => {
    addDrugModal.classList.add('hidden');
});

cancelButton.addEventListener('click', () => {
    addDrugModal.classList.add('hidden');
});

const viewDrugModal = document.getElementById('viewDrugModal');
const closeViewModalButton = document.getElementById('closeViewModalButton');
const closeViewModal = document.getElementById('closeViewModal');

function openViewModal(drug) {
    document.getElementById('viewDrugName').textContent = drug.name;
    document.getElementById('viewDrugType').textContent = drug.type;
    document.getElementById('viewDrugStock').textContent = drug.stock;
    document.getElementById('viewDrugPrice').textContent = `Rp. ${drug.price.toLocaleString('id-ID')}`;
    document.getElementById('viewDrugDescription').textContent = drug.description;
    viewDrugModal.classList.remove('hidden');
    editDrugModal.classList.add('flex');
    editDrugModal.classList.add('bg-gray-900/50');
}

closeViewModalButton.addEventListener('click', () => {
    viewDrugModal.classList.add('hidden');
    editDrugModal.classList.remove('flex');
    editDrugModal.classList.remove('bg-gray-900/50');
});
closeViewModal.addEventListener('click', () => {
    viewDrugModal.classList.add('hidden');
    editDrugModal.classList.add('flex');
    editDrugModal.classList.add('bg-gray-900/50');
});

// Modal Edit
const editDrugModal = document.getElementById('editDrugModal');
const closeEditModalButton = document.getElementById('closeEditModalButton');
const closeEditModal = document.getElementById('closeEditModal');
const editDrugForm = document.getElementById('editDrugForm');

function openEditModal(drug) {
    editDrugForm.action = `/drug/${drug.id}`;
    document.getElementById('editDrugName').value = drug.name;
    document.getElementById('editDrugType').value = drug.type;
    document.getElementById('editDrugStock').value = drug.stock;
    document.getElementById('editDrugPrice').value = drug.price;
    document.getElementById('editDrugDescription').value = drug.description;
    editDrugModal.classList.remove('hidden');
    editDrugModal.classList.add('flex');
    editDrugModal.classList.add('bg-gray-900/50');
}

closeEditModalButton.addEventListener('click', () => {
    editDrugModal.classList.add('hidden');
    editDrugModal.classList.remove('flex');
    editDrugModal.classList.remove('bg-gray-900/50');
});
closeEditModal.addEventListener('click', () => {
    editDrugModal.classList.add('hidden');
    editDrugModal.classList.remove('flex');
    editDrugModal.classList.remove('bg-gray-900/50');
});

document.addEventListener('DOMContentLoaded', () => {
    // Modal Lihat
    const viewDrugModal = document.getElementById('viewDrugModal');
    const closeViewModalButton = document.getElementById('closeViewModalButton');
    const closeViewModal = document.getElementById('closeViewModal');

    function openViewModal(drug) {
        document.getElementById('viewDrugName').textContent = drug.name;
        document.getElementById('viewDrugType').textContent = drug.type;
        document.getElementById('viewDrugStock').textContent = drug.stock;
        document.getElementById('viewDrugPrice').textContent = `Rp. ${new Intl.NumberFormat('id-ID', { maximumFractionDigits: 0 }).format(drug.price)}`;
        document.getElementById('viewDrugDescription').textContent = drug.description;
        viewDrugModal.classList.remove('hidden');
        viewDrugModal.classList.add('flex');
    }

    closeViewModalButton.addEventListener('click', () => {
        viewDrugModal.classList.add('hidden');
    });
    closeViewModal.addEventListener('click', () => {
        viewDrugModal.classList.add('hidden');
    });

    // Modal Edit
    const editDrugModal = document.getElementById('editDrugModal');
    const closeEditModalButton = document.getElementById('closeEditModalButton');
    const closeEditModal = document.getElementById('closeEditModal');
    const editDrugForm = document.getElementById('editDrugForm');

    function openEditModal(drug) {
        editDrugForm.action = `/drug/${drug.id}`;
        document.getElementById('editDrugName').value = drug.name;
        document.getElementById('editDrugType').value = drug.type;
        document.getElementById('editDrugStock').value = drug.stock;
        document.getElementById('editDrugPrice').value = `${new Intl.NumberFormat('id-ID', { maximumFractionDigits: 0 }).format(drug.price)}`;
        document.getElementById('editDrugDescription').value = drug.description;
        editDrugModal.classList.remove('hidden');
        editDrugModal.classList.add('flex');
        editDrugModal.classList.add('bg-gray-900/50');
    }

    closeEditModalButton.addEventListener('click', () => {
        editDrugModal.classList.add('hidden');
    });
    closeEditModal.addEventListener('click', () => {
        editDrugModal.classList.add('hidden');
    });

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



    // Pastikan fungsi openViewModal dan openEditModal tersedia di global scope
    window.openViewModal = openViewModal;
    window.openEditModal = openEditModal;
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

const priceInput = document.getElementById('price');
if (priceInput) {
    priceInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/[^0-9]/g, ''); // Hanya angka
        value = new Intl.NumberFormat('id-ID').format(value); // Format angka
        e.target.value = value;
    });
}
const editPriceInput = document.getElementById('editDrugPrice');
if (editPriceInput) {
    editPriceInput.addEventListener('input', function (e) {
        let value = e.target.value.replace(/[^0-9]/g, ''); // Hanya angka
        value = new Intl.NumberFormat('id-ID').format(value); // Format angka
        e.target.value = value;
    });
}
