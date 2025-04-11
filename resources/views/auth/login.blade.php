<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- Font Awesome Icons --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded shadow-md w-full max-w-lg">
        <div class="text-center mb-6">
            <img src="{{ asset('images/logo/logo.png') }}" alt="Logo" class="mx-auto h-16 w-16 mb-4">
            <h1 class="text-2xl font-bold text-green">Masuk ke Akun Anda</h1>
            <p class="mt-2 text-gray-600">
                Masukkan kredensial Anda untuk mengakses sistem
            </p>
        </div>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter Username"
                    class="mt-1 block p-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 active:ring-green-600 active:border-green-600"
                    required>
            </div>
            <div class="mb-6">
                <div class="flex justify-between items-center">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <a href="#" class="text-sm text-green-500 hover:text-green-700">Lupa Password?</a>
                </div>
                <div class="relative">
                    <input type="password" id="password" name="password" placeholder="Enter Password"
                        class="mt-1 block p-2 w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 active:ring-green-600 active:border-green-600"
                        required>
                    <button type="button" id="togglePassword"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>
            </div>
            <div class="mb-6 flex items-center">
                <input type="checkbox" id="remember" name="remember"
                    class="h-4 w-4 text-green-500 border-gray-300 rounded focus:ring-green-500">
                <label for="remember" class="ml-2 block text-sm text-gray-700">Ingatkan Saya</label>
            </div>
            <button type="submit"
                class="w-full bg-green-500 text-white font-bold py-3 px-4 rounded hover:bg-green-600 active:bg-green-700">
                Masuk
            </button>
        </form>
    </div>
</body>

<script>
    // Toggle visibility of password
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordField = document.getElementById('password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Change icon
        const icon = this.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
</script>

</html>
