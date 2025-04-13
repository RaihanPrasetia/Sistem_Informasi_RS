<div id="sidebar"
    class="fixed top-0 left-0 w-64 h-full bg-gray-300 text-slate-700 transform -translate-x-full transition-transform duration-300">
    <div class="p-4">
        <h2 class="text-lg font-bold text-center">Inova Medikal</h2>
        <ul class="mt-4">
            @php
                $menus = [
                    ['name' => 'Dashboard', 'route' => route('dashboard.index')],
                    ['name' => 'User', 'route' => '#'],
                    ['name' => 'Pegawai', 'route' => '#'],
                    ['name' => 'Wilayah', 'route' => '#'],
                    ['name' => 'Pelayanan', 'route' => '#'],
                    ['name' => 'Obat', 'route' => route('drug.index')],
                ];
            @endphp

            @foreach ($menus as $menu)
                <li>
                    <a href="{{ $menu['route'] }}" class="block p-2 font-semibold hover:bg-gray-700 hover:text-white">
                        {{ $menu['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
