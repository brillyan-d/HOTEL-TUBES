<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Hotel Booking') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            body { font-family: sans-serif; }
            .hero-bg { background: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('https://picsum.photos/1920/1080?random=1') center center; background-size: cover; }
        </style>
    @endif
</head>
<body class="antialiased bg-gray-50">
    <div class="relative min-h-screen hero-bg">

        <header class="absolute top-0 left-0 right-0 z-10 p-6">
            <nav class="flex items-center justify-between mx-auto max-w-7xl">
                <a href="{{ url('/') }}" class="text-2xl font-bold tracking-wider text-white uppercase">
                    Your Hotel
                </a>

                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm text-white transition duration-200 border border-transparent rounded-full hover:border-white/50">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm text-white transition duration-200 border border-transparent rounded-full hover:bg-white hover:text-gray-800">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 text-sm text-gray-900 transition duration-200 bg-white rounded-full hover:bg-gray-200">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>
        </header>

        <main class="flex items-center justify-center min-h-screen px-4 py-16">
            <div class="w-full max-w-4xl text-center">
                <h1 class="text-5xl font-extrabold text-white sm:text-6xl md:text-7xl">
                    Discover Your Perfect Stay.
                </h1>
                <p class="mt-4 text-xl text-white/90">
                    Book the best rooms at the best price.
                </p>

                <div class="p-4 mt-10 bg-white rounded-lg shadow-2xl md:p-8">
                    <form action="#" method="GET" class="grid grid-cols-1 gap-4 md:grid-cols-5">
                        <div class="col-span-1 md:col-span-2">
                            <label for="check_in" class="block mb-1 text-sm font-medium text-gray-700 text-left">Check-in / Check-out</label>
                            <div class="flex space-x-2">
                                <input type="date" id="check_in" name="check_in" required class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                <input type="date" id="check_out" name="check_out" required class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div class="col-span-1">
                            <label for="guests" class="block mb-1 text-sm font-medium text-gray-700 text-left">Guests</label>
                            <select id="guests" name="guests" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                <option value="1">1 Adult</option>
                                <option value="2" selected>2 Adults</option>
                                <option value="3">3+ Adults</option>
                            </select>
                        </div>

                        <div class="col-span-1">
                            <label for="rooms" class="block mb-1 text-sm font-medium text-gray-700 text-left">Rooms</label>
                            <select id="rooms" name="rooms" class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                                <option value="1" selected>1 Room</option>
                                <option value="2">2 Rooms</option>
                            </select>
                        </div>

                        <div class="col-span-1 flex items-end">
                            <button type="submit" class="w-full px-4 py-2 text-sm font-semibold text-white transition duration-200 bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                SEARCH
                            </button>
                        </div>
                    </form>
                </div>
                </div>
        </main>
        <section class="py-20 bg-gray-50">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 text-center mb-10">Featured Rooms</h2>
                <div class="grid gap-8 md:grid-cols-3">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img class="h-48 w-full object-cover" src="https://picsum.photos/400/300?random=2" alt="Room 1">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900">Standard King Room</h3>
                            <p class="text-gray-600 mt-2">Spacious comfort for a perfect retreat.</p>
                            <span class="text-2xl font-bold text-red-600 mt-4 block">IDR 500k</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img class="h-48 w-full object-cover" src="https://picsum.photos/400/300?random=3" alt="Room 2">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900">Deluxe City View</h3>
                            <p class="text-gray-600 mt-2">Enjoy the stunning city skyline.</p>
                            <span class="text-2xl font-bold text-red-600 mt-4 block">IDR 850k</span>
                        </div>
                    </div>
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <img class="h-48 w-full object-cover" src="https://picsum.photos/400/300?random=4" alt="Room 3">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900">Presidential Suite</h3>
                            <p class="text-gray-600 mt-2">Unmatched luxury and space.</p>
                            <span class="text-2xl font-bold text-red-600 mt-4 block">IDR 2.5 Jt</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="bg-gray-800 py-6">
            <div class="mx-auto max-w-7xl px-4 text-center text-sm text-gray-400">
                &copy; {{ date('Y') }} Your Hotel. All rights reserved.
            </div>
        </footer>

    </div>
</body>
</html>
