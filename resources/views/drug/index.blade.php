@extends('master')

@section('title', 'Drug')
@section('content_title', 'Daftar Drug')
@section('content_subtitle', 'Daftar semua drug yang tersedia')

@section('content')
    <div class="w-full mx-auto">
        <div class="flex items-center w-full justify-between mb-4">
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

            <!-- Add Drug Button -->
            <div class="flex w-full items-center justify-end">
                <!-- Tombol Tambah Drug -->
                <button data-open-modal="addDrugModal"
                    class="flex items-center px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                    <i class="fas fa-plus mr-2"></i> Tambah Drug
                </button>
            </div>
        </div>

        <!-- Add Modal -->
        @include('components.modal.drug.add')

        <!-- Modal Lihat -->
        @include('components.modal.drug.show')

        <!-- Modal Edit -->
        @include('components.modal.drug.edit')

        <!-- Tabel Data Drug -->
        <div class="overflow-x-auto p-6 bg-white shadow-md rounded-lg">
            <div class="flex items-center justify-between mb-4">
                <!-- Row data -->
                <form method="GET" action="{{ route('drug.index') }}" class="flex items-center">
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
                <form method="GET" action="{{ route('drug.index') }}" class="flex items-center">
                    <input type="text" name="search"
                        class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                        placeholder="Cari berdasarkan nama..." value="{{ request('search') }}">
                    <input type="hidden" name="perPage" value="{{ request('perPage', 10) }}">
                    <button type="submit"
                        class="px-4 py-2 font-semibold bg-blue-400 text-white rounded-r-md hover:bg-blue-500">Cari</button>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                        <th>
                            <p class="text-center">Aksi</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($drugs as $drug)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $drug->name }}</td>
                            <td>{{ $drug->type }}</td>
                            <td>{{ $drug->stock }}</td>
                            <td>Rp. {{ number_format($drug->price, 0, ',', '.') }}</td>
                            <td>{{ $drug->description }}</td>
                            <td>
                                <div class="flex space-x-2 items-center justify-center">
                                    <!-- Tombol Lihat -->
                                    <button type="button" data-open-modal="viewDrugModal"
                                        onclick="openViewModal({{ $drug }})"
                                        class="px-2 py-1 bg-blue-400 text-white rounded-md hover:bg-blue-500">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                    <!-- Tombol Edit -->
                                    <button type="button" data-open-modal="editDrugModal"
                                        onclick="openEditDrugModal({{ $drug }})"
                                        class="px-2 py-1 bg-yellow-400 text-white rounded-md hover:bg-yellow-500">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Tombol Delete -->
                                    <button type="button"
                                        onclick="confirmDelete('{{ route('drug.destroy', $drug->id) }}')"
                                        class="px-2 py-1 bg-red-400 text-white rounded-md hover:bg-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-2 text-center text-gray-500">Tidak ada data drug ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!-- Pagination -->
            <div class="mt-4 flex justify-end">
                {{ $drugs->links('vendor.pagination.custom') }}
            </div>
        </div>
    </div>

@endsection
