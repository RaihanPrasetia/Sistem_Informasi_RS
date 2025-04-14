<div id="sidebar"
    class="fixed top-0 left-0 w-64 h-full bg-gray-50 text-gray-800 shadow-lg transform -translate-x-full transition-transform duration-300">
    <div class="p-4">
        <h2 class="text-xl font-bold text-center text-gray-700">Inova Medikal</h2>
        <ul class="mt-6">

            @php
                $menus = [
                    ['name' => 'Dashboard', 'route' => route('dashboard.index'), 'icon' => 'fa-solid fa-house'],
                    ['name' => 'Pasien', 'route' => route('patient.index'), 'icon' => 'fa-solid fa-user'],
                    ['name' => 'Pegawai', 'route' => '#', 'icon' => 'fa-solid fa-users'],
                    ['name' => 'Wilayah', 'route' => '#', 'icon' => 'fa-solid fa-map'],
                    ['name' => 'Pelayanan', 'route' => '#', 'icon' => 'fa-solid fa-stethoscope'],
                    ['name' => 'Obat', 'route' => route('drug.index'), 'icon' => 'fa-solid fa-pills'],
                ];
            @endphp

            @foreach ($menus as $menu)
                <li>
                    <a href="{{ $menu['route'] }}"
                        class="flex items-center gap-3 p-3 mb-2 text-base font-medium rounded-lg transition-colors duration-200 {{ request()->url() === $menu['route'] ? 'bg-blue-100 text-blue-600' : 'hover:bg-blue-50 hover:text-blue-500' }}">
                        <i class="{{ $menu['icon'] }} w-8 text-blue-500"></i>
                        {{ $menu['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
