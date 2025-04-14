<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/custom.js', 'resources/js/patient/modal.js'])
    {{-- Styles --}}
    {{-- Font Awesome Icons --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    @include('components.master.navbar')

    <!-- Sidebar -->
    @include('components.master.sidebar')


    <!-- Konten -->
    <div id="content" class="py-4 px-8 transition-all duration-300 ml-0">
        @if (!request()->routeIs('dashboard.index'))
            <h1 class="text-3xl text-start text-slate-700 font-semibold">@yield('content_title')</h1>
            <h3 class="text-lg text-start text-slate-600">@yield('content_subtitle')</h3>
        @endif
        @yield('content')
    </div>
</body>

</html>
