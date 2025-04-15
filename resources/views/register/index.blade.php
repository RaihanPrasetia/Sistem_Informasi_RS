@extends('master')

@section('title', 'Pendaftaran')
@section('content_title', 'Pendaftaran Kunjungan')
@section('content_subtitle', 'Lakukan pendaftaran pasien baru')

@section('content')
    <div class="w-full mx-auto mt-4">
        <div class="p-6 bg-white shadow-md rounded-lg">
            <div>
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
            </div>
            <div class="flex items-center justify-between mb-4">
                <h1 class="mb-2 font-semibold text-xl text-nowrap">Pendaftaran Pasien</h1>
                <!-- Add Patient Button -->
                <div class="flex w-full items-center justify-end">
                    <button data-open-modal="addPatientModal"
                        class="flex items-center px-4 py-2 text-wrap bg-green-400 text-white font-semibold rounded-md hover:bg-green-600">
                        <i class="fas fa-plus mr-2"></i> Tambah Pasien
                    </button>
                </div>
            </div>

            <!-- Add Modal -->
            @include('components.modal.register.add')

            <form action="{{ route('register.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Pilih Pasien -->
                    <div class="mb-4">
                        <label for="patient_id" class="block text-sm font-medium text-gray-700">Pilih Pasien</label>
                        <select name="patient_id" id="patient_id" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white">
                            <option value="" disabled selected>Pilih Pasien</option>
                            @foreach ($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->patient_number }} - {{ $patient->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pilih Layanan -->
                    <div class="mb-4">
                        <label for="service_id" class="block text-sm font-medium text-gray-700">Pilih Layanan</label>
                        <select name="service_id" id="service_id" required
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white">
                            <option value="" disabled selected>Pilih Layanan</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }} - {{ $service->doctor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Catatan -->
                    <div class="mb-4 md:col-span-2">
                        <label for="notes" class="block text-sm font-medium text-gray-700">Catatan</label>
                        <textarea name="notes" id="notes" rows="3"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                            placeholder="Masukkan catatan tambahan (opsional)"></textarea>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end mt-4">
                    <button type="reset"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 mr-2">Reset</button>
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Daftar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data Pendaftaran Hari Ini -->
    <div class="w-full mx-auto mt-8">
        <div class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="mb-2 font-semibold text-xl">Data Pendaftar</h1>
            <div class="flex justify-between items-center mb-4">
                <!-- Dropdown Per Page -->
                <form method="GET" action="{{ route('register.index') }}" class="flex items-center">
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
                <form method="GET" action="{{ route('register.index') }}" class="flex items-center">
                    <input type="text" name="search" value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                        placeholder="Cari pasien atau layanan...">
                    <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">
                    <button type="submit"
                        class="px-4 py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600">Cari</button>
                </form>


            </div>

            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pasien</th>
                        <th>Layanan</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrations as $registration)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $registration->patient->name }}</td>
                            <td>{{ $registration->service->name }}</td>
                            <td>{{ $registration->registration_date->format('d-m-Y H:i') }}</td>
                            <td>{{ $registration->notes ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-2 text-center text-gray-500">Tidak ada pendaftaran hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $registrations->appends(['search' => request('search'), 'perPage' => request('perPage')])->links() }}
            </div>
        </div>
    </div>
@endsection
