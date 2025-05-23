@extends('master')

@section('title', 'Patient')
@section('content_title', 'Daftar Pasien')
@section('content_subtitle', 'Daftar semua pasien yang telah terdaftar')

@section('content')
    <div class="w-full mx-auto">
        <div class="flex items-center w-full justify-between mb-4">
            <!-- Success -->
            @if (session('success'))
                <div id="successMessage"
                    class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg transform translate-x-full transition-transform duration-500 ease-in-out">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error -->
            @if (session('error'))
                <div id="errorMessage"
                    class="fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-md shadow-lg transform translate-x-full transition-transform duration-500 ease-in-out">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Add Patient Button -->
            <div class="flex w-full items-center justify-end">
                <button data-open-modal="addPatientModal"
                    class="flex items-center px-4 py-2 text-wrap bg-green-400 text-white font-semibold rounded-md hover:bg-green-600">
                    <i class="fas fa-plus mr-2"></i> Tambah Pasien
                </button>
            </div>
        </div>

        <!-- Add Modal -->
        @include('components.modal.patient.add')

        <!-- Modal Edit -->
        @include('components.modal.patient.edit')

        <!-- Tabel Data Patient -->
        <div class="overflow-x-auto p-6 bg-white shadow-md rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <!-- Row data -->
                <form method="GET" action="{{ route('patient.index') }}" class="flex items-center">
                    <label for="perPage" class="mr-2 text-sm font-medium text-gray-700">Tampilkan</label>
                    <select name="perPage" id="perPage" onchange="this.form.submit()"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                    <span class="ml-2 text-sm text-gray-700">data</span>
                    <input type="hidden" name="search" value="{{ request('search') }}">
                </form>

                <!-- Form Pencarian -->
                <form method="GET" action="{{ route('patient.index') }}" class="flex items-center">
                    <input type="text" name="search"
                        class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                        placeholder="Cari berdasarkan nama..." value="{{ request('search') }}">
                    <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">
                    <button type="submit"
                        class="px-4 py-2 font-semibold bg-blue-400 text-white rounded-r-md hover:bg-blue-500">Cari</button>
                </form>
            </div>
            <table class="min-w-full border-gray-200 border">
                <thead class="text-slate-600 border-b border-gray-200 bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">NIK</th>
                        <th class="px-4 py-2 text-left">Nomor Pasien</th>
                        <th class="px-4 py-2 text-left">Jenis Kelamin</th>
                        <th class="px-4 py-2 text-left">Tanggal Lahir</th>
                        <th class="px-4 py-2 text-left">Alamat</th>
                        <th class="px-4 py-2 text-left">Telepon</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($patients as $patient)
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $patient->name }}</td>
                            <td class="px-4 py-2">{{ $patient->nik }}</td>
                            <td class="px-4 py-2">{{ $patient->patient_number }}</td>
                            <td class="px-4 py-2">{{ $patient->gender }}</td>
                            <td class="px-4 py-2">{{ $patient->birth_date }}</td>
                            <td class="px-4 py-2">{{ $patient->address }}</td>
                            <td class="px-4 py-2">{{ $patient->phone }}</td>
                            <td class="px-4 py-2">
                                <div class="flex space-x-2 items-center justify-center">
                                    <!-- Tombol Lihat -->
                                    <button type="button" data-open-modal="viewPatientModal"
                                        onclick="openViewPatientModal({{ $patient }})"
                                        class="px-2 py-1 bg-blue-400 text-white rounded-md hover:bg-blue-500">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Tombol Edit -->
                                    <button type="button" data-open-modal="editPatientModal"
                                        onclick="openEditPatientModal({{ $patient }})"
                                        class="px-2 py-1 bg-yellow-400 text-white rounded-md hover:bg-yellow-500">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Tombol Delete -->
                                    <button type="button"
                                        onclick="confirmDelete('{{ route('patient.destroy', $patient->id) }}')"
                                        class="px-2 py-1 bg-red-400 text-white rounded-md hover:bg-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-4 py-2 text-center text-gray-500">Tidak ada data pasien ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="mt-4 flex justify-end">
                {{ $patients->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>
@endsection
