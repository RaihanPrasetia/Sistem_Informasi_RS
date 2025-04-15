@extends('master')

@section('title', 'Peresepan')
@section('content_title', 'Peresepan Obat')
@section('content_subtitle', 'Pilih pasien dari pendaftaran hari ini untuk pemberian obat')

@section('content')
    <div class="w-full mx-auto mt-4">
        <div class="p-6 bg-white shadow-md rounded-lg">
            <h1 class="mb-4 font-semibold text-xl">Data Pendaftaran Hari Ini</h1>

            <!-- Success -->
            @if (session('success'))
                <div id="successMessage"
                    class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg transform transition-transform duration-500 ease-in-out">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error -->
            @if (session('error'))
                <div id="errorMessage"
                    class="fixed top-4 right-4 bg-red-500 text-white px-4 py-2 rounded-md shadow-lg transform transition-transform duration-500 ease-in-out">
                    {{ session('error') }}
                </div>
            @endif

            @include('components.modal.peresepan.add')

            <!-- Tabel Data Pendaftaran -->
            <table class="min-w-full border border-gray-200">
                <thead class="bg-gray-50 text-gray-600">
                    <tr>
                        <th class="px-4 py-2 text-left">#</th>
                        <th class="px-4 py-2 text-left">Nama Pasien</th>
                        <th class="px-4 py-2 text-left">Nomor Pasien</th>
                        <th class="px-4 py-2 text-left">Layanan</th>
                        <th class="px-4 py-2 text-left">Obat-obatan</th>
                        <th class="px-4 py-2 text-left">Tanggal Pendaftaran</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($registrations as $registration)
                        <tr>
                            <td class="px-4 py-2">{{ $loop->iteration }}</td>
                            <td class="px-4 py-2">{{ $registration->patient->name }}</td>
                            <td class="px-4 py-2">{{ $registration->patient->patient_number }}</td>
                            <td class="px-4 py-2">{{ $registration->service->name }}</td>
                            <td class="px-4 py-2">
                                @if ($registration->registrationDrugs->isEmpty())
                                    <span class="text-gray-500">Belum ada resep</span>
                                @else
                                    <ul class="list-disc pl-5">
                                        @foreach ($registration->registrationDrugs as $registrationDrug)
                                            <li>
                                                {{ $registrationDrug->drug->name }} -
                                                {{ $registrationDrug->quantity }} pcs ({{ $registrationDrug->dosage }})
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $registration->registration_date->format('d-m-Y H:i') }}</td>
                            <td class="px-4 py-2 text-center">
                                <!-- Tombol Beri Resep -->
                                <button type="button" data-open-modal="addResepModal"
                                    onclick="openResepModal({{ $registration->id }}, '{{ $registration->patient->name }}', '{{ $registration->service->name }}')"
                                    class="px-2 py-1 bg-blue-400 text-white rounded-md hover:bg-blue-500">
                                    <i class="fas fa-edit"></i> Beri Resep
                                </button>

                                <!-- Tombol Update Resep -->
                                @if (!$registration->registrationDrugs->isEmpty())
                                    <button type="button" data-open-modal="updateResepModal"
                                        onclick="openUpdateModal({{ $registration->id }}, '{{ $registration->patient->name }}', '{{ $registration->service->name }}')"
                                        class="px-2 py-1 bg-yellow-400 text-white rounded-md hover:bg-yellow-500">
                                        <i class="fas fa-sync"></i> Update Resep
                                    </button>
                                @endif
                            </td>
                        </tr>

                        @include('components.modal.peresepan.edit', ['registration' => $registration])
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-2 text-center text-gray-500">Tidak ada pendaftaran hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
