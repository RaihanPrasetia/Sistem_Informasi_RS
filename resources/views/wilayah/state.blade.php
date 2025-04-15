@extends('wilayah.index')

@section('wilayah-section')
    <div class="w-full mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6 mb-4">

            <div class="flex items-end justify-between space-x-4 mb-4">
                <div class="mb-4">
                    <h2 class="text-2xl font-normal">Daftar Provinsi</h2>
                    <p class="text-sm text-red-400 ">Pilih Negara terlebih dahulu sebelum menambahkan provinsi</p>
                </div>
                <!-- Dropdown Country -->
                <div class="w-1/2 flex items-end justify-end space-x-4">
                    <form method="GET" action="{{ route('state.index') }}" class="w-1/3">
                        <label for="country_id" class="block text-sm font-medium text-gray-700">Pilih Negara</label>
                        <select name="country_id" id="country_id" onchange="this.form.submit()"
                            class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                            <option value="">-- Pilih Negara --</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}"
                                    {{ request('country_id') == $country->id ? 'selected' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>


            <div class="flex w-full items-center space-x-4 justify-end mb-4">
                <!-- Form Pencarian -->
                @if (count($states) > 0)
                    <form method="GET" action="{{ route('state.index') }}" class="flex items-end w-1/4">
                        <input type="hidden" name="country_id" value="{{ request('country_id') }}">
                        <label for="search" class="sr-only">Cari Provinsi</label>
                        <input type="text" name="search" id="search" placeholder="Cari nama provinsi..."
                            value="{{ request('search') }}"
                            class="w-full p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-r-md hover:bg-blue-600">
                            Cari
                        </button>
                    </form>
                @endif

                @if (!empty($states))
                    <!-- Add State Button -->
                    <button data-open-modal="addStateModal"
                        class="flex items-center px-4 py-2 text-wrap bg-green-400 text-white font-semibold rounded-md hover:bg-green-600">
                        <i class="fas fa-plus mr-2"></i> Tambah Provinsi
                    </button>
                    <!-- Add Modal -->
                    @include('components.modal.state.add')

                    <!-- Edit Modal -->
                    @include('components.modal.state.edit')
                @endif
            </div>




            <!-- Tabel Data State -->
            @if (!empty($states) && count($states) > 0)
                <div class="overflow-x-auto">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-12">No</th>
                                <th>Nama Provinsi</th>
                                <th>
                                    <p class="text-center">Aksi</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($states as $state)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $state->name }}</td>
                                    <td>
                                        <div class="flex space-x-2 items-center justify-center">
                                            <!-- Tombol Edit -->
                                            <button type="button" data-open-modal="editStateModal"
                                                onclick="openEditStateModal({{ $state }})"
                                                class="px-2 py-1 bg-yellow-400 text-white rounded-md hover:bg-yellow-500">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Tombol Delete -->
                                            <button type="button"
                                                onclick="confirmDelete('{{ route('state.destroy', $state->id) }}')"
                                                class="px-2 py-1 bg-red-400 text-white rounded-md hover:bg-red-600">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-4 flex justify-end">
                    {{ $states->links('vendor.pagination.custom') }}
                </div>
            @else
                <div class="text-center text-gray-500 mt-6">
                    <p>{{ request('country_id') ? 'Tidak ada data provinsi untuk negara yang dipilih.' : 'Silakan pilih negara terlebih dahulu.' }}
                    </p>
                </div>
            @endif


        </div>
    </div>
@endsection
