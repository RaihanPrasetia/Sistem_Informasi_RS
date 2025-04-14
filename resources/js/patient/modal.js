document.addEventListener('DOMContentLoaded', () => {
    // Modal Tambah Pasien
    const addPatientButton = document.getElementById('addPatientButton');
    const addPatientModal = document.getElementById('addPatientModal');
    const closeModalButton = document.getElementById('closeModalButton');
    const cancelButton = document.getElementById('cancelButton');

    addPatientButton.addEventListener('click', () => {
        addPatientModal.classList.remove('hidden');
        addPatientModal.classList.add('flex');
        addPatientModal.classList.add('bg-gray-900/50');
    });

    closeModalButton.addEventListener('click', () => {
        addPatientModal.classList.add('hidden');
    });

    cancelButton.addEventListener('click', () => {
        addPatientModal.classList.add('hidden');
    });

    // Modal Edit Pasien
    const editPatientModal = document.getElementById('editPatientModal');
    const closeEditModalButton = document.getElementById('closeEditModalButton');
    const closeEditModal = document.getElementById('closeEditModal');
    const editPatientForm = document.getElementById('editPatientForm');

    function openEditModal(patient) {
        editPatientForm.action = `/patient/${patient.id}`;
        document.getElementById('editPatientName').value = patient.name;
        document.getElementById('editPatientNik').value = patient.nik;
        document.getElementById('editPatientNumber').value = patient.patient_number;
        document.getElementById('editPatientGender').value = patient.gender;
        document.getElementById('editPatientBirthDate').value = patient.birth_date;
        document.getElementById('editPatientAddress').value = patient.address;
        document.getElementById('editPatientPhone').value = patient.phone || '';
        editPatientModal.classList.remove('hidden');
        editPatientModal.classList.add('flex');
        editPatientModal.classList.add('bg-gray-900/50');
    }

    closeEditModalButton.addEventListener('click', () => {
        editPatientModal.classList.add('hidden');
    });

    closeEditModal.addEventListener('click', () => {
        editPatientModal.classList.add('hidden');
    });

    // Konfirmasi Hapus Pasien
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

    // Pastikan fungsi openViewModal, openEditModal, dan confirmDelete tersedia di global scope
    window.openViewModal = openViewModal;
    window.openEditModal = openEditModal;
    window.confirmDelete = confirmDelete;
});
