@extends('master')

@section('title', 'Wilayah')
@section('content_title', 'Manajemen Wilayah')
@section('content_subtitle', 'Kelola data negara, provinsi, dan kota')

@section('content')
    <div class="w-full mx-auto">
        <!-- Success Message -->
        @if (session('success'))
            <div id="successMessage"
                class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg transform transition-transform duration-500 ease-in-out">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div id="errorMessage"
                class="fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded-md shadow-lg transform transition-transform duration-500 ease-in-out">
                {{ session('error') }}
            </div>
        @endif

        <!-- Tab Navigation -->
        <div class="flex w-1/3 space-x-4 my-4">
            @php
                $tabs = [
                    ['route' => 'country.index', 'label' => 'Negara'],
                    ['route' => 'state.index', 'label' => 'Provinsi'],
                    ['route' => 'city.index', 'label' => 'Kota'],
                ];
            @endphp

            @foreach ($tabs as $tab)
                <a href="{{ route($tab['route']) }}"
                    class="px-4 py-2 text-center w-full text-[14px] font-medium {{ request()->routeIs($tab['route']) ? 'rounded-lg shadow-md bg-blue-400 text-white' : 'text-gray-500 hover:text-blue-400' }}">
                    {{ $tab['label'] }}
                </a>
            @endforeach
        </div>

        <!-- Section Content -->
        @yield('wilayah-section')

    </div>
@endsection
