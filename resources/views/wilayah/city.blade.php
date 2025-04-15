@extends('wilayah.index')

@section('wilayah-section')
    <div class="w-full mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6 mb-4">

            <div class="flex items-end justify-between space-x-4 mb-4">
                <div>
                    <h2 class="text-2xl font-normal">Daftar Provinsi</h2>
                    <p class="text-sm text-red-400 ">Pilih Negara dan Provinsi terlebih dahulu sebelum menambahkan kota</p>
                </div>


                <!-- Dropdown Country -->
                <div class="w-1/2 flex items-end justify-end space-x-4">
                    <form method="GET" action="{{ route('city.index') }}" class="w-max">
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
                    <!-- Dropdown State -->
                    @if (!empty($states) && count($states) > 0)
                        <div class="flex items-end justify-between space-x-4">
                            <form method="GET" action="{{ route('city.index') }}" class="w-max">
                                <input type="hidden" name="country_id" value="{{ request('country_id') }}">
                                <label for="state_id" class="block text-sm font-medium text-gray-700">Pilih Provinsi</label>
                                <select name="state_id" id="state_id" onchange="this.form.submit()"
                                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}"
                                            {{ request('state_id') == $state->id ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    @endif
                </div>
            </div>



            <!-- Tabel Data City -->
            @if (!empty($cities))
                <div class="flex w-full items-center space-x-4 justify-end mb-4">
                    <!-- Form Pencarian -->
                    <form method="GET" action="{{ route('city.index') }}" class="flex items-end w-1/4">
                        <input type="hidden" name="country_id" value="{{ request('country_id') }}">
                        <input type="hidden" name="state_id" value="{{ request('state_id') }}">
                        <label for="search" class="sr-only">Cari Kota</label>
                        <input type="text" name="search" id="search" placeholder="Cari nama kota..."
                            value="{{ request('search') }}"
                            class="w-full p-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white font-semibold rounded-r-md hover:bg-blue-600">
                            Cari
                        </button>
                    </form>
                    <!-- Add City Button -->
                    @if (!empty($cities))
                        <button data-open-modal="addCityModal"
                            class="flex items-center px-4 py-2 text-wrap bg-green-400 text-white font-semibold rounded-md hover:bg-green-600">
                            <i class="fas fa-plus mr-2"></i> Tambah Kota
                        </button>
                    @endif
                </div>

                <!-- Add Modal -->
                @include('components.modal.city.add')

                <!-- Edit Modal -->
                @include('components.modal.city.edit')

                <div class="overflow-x-auto">
                    <table>
                        <thead>
                            <tr>
                                <th class="w-12">No</th>
                                <th>Nama Kota</th>
                                <th>
                                    <p class="text-center">Aksi</p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cities as $city)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>
                                        <div class="flex space-x-2 items-center justify-center">
                                            <!-- Tombol Edit -->
                                            <button type="button" data-open-modal="editCityModal"
                                                onclick="openEditCityModal({{ $city }})"
                                                class="px-2 py-1 bg-yellow-400 text-white rounded-md hover:bg-yellow-500">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <!-- Tombol Delete -->
                                            <button type="button"
                                                onclick="confirmDelete('{{ route('city.destroy', $city->id) }}')"
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
                    {{ $cities->links('vendor.pagination.custom') }}
                </div>
            @elseif (!empty($states) && count($states) > 0)
                <div class="text-center text-gray-500 mt-6">
                    <p>{{ request('country_id') ? 'Silakan pilih provinsi terlebih dahulu.' : 'Silakan pilih negara terlebih dahulu.' }}
                    </p>
                </div>
            @else
                <div class="text-center text-gray-500 mt-6">
                    <p>{{ request('state_id') ? 'Tidak ada data kota untuk provinsi yang dipilih.' : 'Tidak ada data provinsi untuk negara yang dipilih' }}
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection
