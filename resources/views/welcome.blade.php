<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TCU EATS</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

    <div class="relative min-h-screen">
        <!-- Header -->
        <header class="bg-blue-500 text-white py-4">
            <div class="container mx-auto flex justify-between items-center px-6 lg:px-10">
                <div class="border px-3 py-2 rounded-full shadow-md hover:shadow-xl hover:scale-110">
                    <h1 class="text-2xl font-bold hover:scale-110"><span class="text-blue-800 italic">TCU</span> <span class="text-red-700">EATS</span></h1>
                </div>
                @if (Route::has('login'))
                    <nav class="flex space-x-4">
                        @auth
                            <a href="{{ route('cart.index') }}" class="relative inline-block mr-5 mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="9" cy="21" r="1"></circle>
                                    <circle cx="20" cy="21" r="1"></circle>
                                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                </svg>
                                @if($cartCount > 0)
                                    <span class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-600 text-white text-xs font-bold rounded-full px-2 py-0.5">
                                        {{ $cartCount }}
                                    </span>
                                @endif
                            </a>
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 rounded-md bg-white text-red-600 font-medium hover:bg-gray-200">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-nowrap px-4 py-2 rounded-md bg-white text-red-600 font-medium hover:bg-gray-200">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 rounded-md bg-white text-red-600 font-medium hover:bg-gray-200">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <!-- Hero Section -->
        <div class="bg-[#FFF6F6] py-16">
            <div class="container mx-auto text-center px-6 lg:px-10">
                <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Discover Your Next Favorite Meal with TCU EATS</h1>
                <p class="text-lg text-gray-600">Delicious food from the best local shops delivered to your door</p>
            </div>
        </div>

        <!-- Shop Grid -->
        <main class="container mx-auto my-8 px-6 lg:px-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach ($shops as $shop)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl">
                        <img src="{{ asset('storage/' . $shop->image) }}" alt="{{ $shop->name }}" class="w-full h-48 object-cover hover:scale-110">
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-800">
                                <a href="{{ route('shop.show', $shop->id) }}" class="hover:text-red-600">{{ $shop->name }}</a>
                            </h3>
                            <p class="text-sm text-gray-600 mt-2">{{ Str::limit($shop->description, 100, '...') }}</p>
                        </div>
                        <div class="bg-red-600 text-white text-center py-2">
                            <a href="{{ route('shop.show', $shop->id) }}" class="text-sm font-medium uppercase hover:underline">
                                View Shop
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </main>
    </div>

</body>
</html>
