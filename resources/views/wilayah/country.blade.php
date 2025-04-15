@extends('wilayah.index')

@section('wilayah-section')
    <div class="overflow-x-auto p-6 bg-white shadow-md rounded-lg mt-4">
        <h2 class="text-2xl w-max font-normal mb-4">Daftar Provinsi</h2>
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-4">


                <form method="GET" action="{{ route('country.index') }}" class="flex items-center">
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

                <form method="GET" action="{{ route('country.index') }}" class="flex items-center">
                    <input type="text" name="search"
                        class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-300"
                        placeholder="Cari berdasarkan nama..." value="{{ request('search') }}">
                    <input type="hidden" name="perPage" value="{{ request('perPage', 5) }}">
                    <button type="submit"
                        class="px-4 py-2 font-semibold bg-blue-400 text-white rounded-r-md hover:bg-blue-500">Cari</button>
                </form>

            </div>

            <!-- Add Country Button -->
            <div class="flex items-center justify-end">
                <button id="addCountryButton" data-open-modal="addCountryModal"
                    class="flex items-center hover:cursor-pointer px-4 py-2 text-wrap bg-green-400 text-white font-semibold rounded-md hover:bg-green-600">
                    <i class="fas fa-plus mr-2"></i> Tambah Negara
                </button>
            </div>
        </div>

        <!-- Add Modal -->
        @include('components.modal.country.add')

        <!-- Edit Modal -->
        @include('components.modal.country.edit')

        <!-- Table Data Country -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Negara</th>
                    <th>
                        <p class="text-center">Aksi</p>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($countries as $country)
                    <tr>
                        <td class="w-12">{{ $loop->iteration }}</td>
                        <td>{{ $country->name }}</td>
                        <td>
                            <div class="flex space-x-2 items-center justify-center">
                                <!-- Tombol Edit -->
                                <button type="button" data-open-modal="editCountryModal"
                                    onclick="openEditCountryModal({{ $country }})"
                                    class="px-2 py-1 bg-yellow-400 text-white rounded-md hover:bg-yellow-500">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Tombol Delete -->
                                <button type="button"
                                    onclick="confirmDelete('{{ route('country.destroy', $country->id) }}')"
                                    class="px-2 py-1 bg-red-400 text-white rounded-md hover:bg-red-600">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 flex justify-end">
            {{ $countries->links('vendor.pagination.custom') }}
        </div>
    </div>
@endsection
