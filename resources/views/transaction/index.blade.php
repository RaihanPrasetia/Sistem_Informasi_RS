@extends('master')

@section('title', 'Transaksi')
@section('content_title', 'Transaksi')
@section('content_subtitle', 'Pilih pasien dari pendaftaran hari ini untuk konfirmasi transaksi')

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
        </div>

        <!-- Tabel Data Pendaftaran -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <table>
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">Nama Pasien</th>
                        <th class="border border-gray-300 px-4 py-2">Nomor Pasien</th>
                        <th class="border border-gray-300 px-4 py-2">Layanan</th>
                        <th class="border border-gray-300 px-4 py-2">Tanggal Pendaftaran</th>
                        <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($registrations as $registration)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-center">{{ $loop->iteration }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $registration->patient->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $registration->patient->patient_number }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $registration->service->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $registration->registration_date->format('d-m-Y H:i') }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <a href="{{ route('transaction.show', $registration->id) }}"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                    Proses
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="border border-gray-300 px-4 py-2 text-center text-gray-500">
                                Tidak ada data pendaftaran hari ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
