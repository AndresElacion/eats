<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

    <div class="relative min-h-screen flex flex-col items-center justify-center">
        <div class="relative w-full max-w-7xl px-6 lg:px-10">
            <header class="flex justify-between items-center py-6">
                @if (Route::has('login'))
                    <nav class="flex space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-black ring-1 ring-transparent transition hover:ring-[#FF2D20] hover:text-[#FF2D20] focus:outline-none">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-black ring-1 ring-transparent transition hover:ring-[#FF2D20] hover:text-[#FF2D20] focus:outline-none">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 text-black ring-1 ring-transparent transition hover:ring-[#FF2D20] hover:text-[#FF2D20] focus:outline-none">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </header>

            <main class="mt-8">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-extrabold text-gray-800">Welcome to TCU EATS</h1>
                    <p class="text-lg text-gray-600 mt-4">Discover delicious food from the best local shops</p>
                </div>

                <!-- Display all shops -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10">
                    @foreach ($shops as $shop)
                        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                            <img src="{{ $shop->image_url ?? 'https://via.placeholder.com/400x200' }}" alt="{{ $shop->name }}" class="w-full h-56 object-cover">
                            <div class="p-6">
                                <h3 class="font-semibold text-xl text-gray-800 dark:text-white mb-2">
                                    <a href="{{ route('shop.show', $shop->id) }}" class="hover:text-[#FF2D20]">
                                        {{ $shop->name }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">{{ $shop->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </main>

            <footer class="py-8 text-center text-sm text-gray-600 mt-12">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </footer>
        </div>
    </div>

</body>
</html>
