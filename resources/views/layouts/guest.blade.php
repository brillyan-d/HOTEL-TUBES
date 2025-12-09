<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your Hotel Booking')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLMD/O+sUvG2I1hBq/S5Iq78Fh9O6J4T35j7p5L/5gP8/Qh/W2K+6/Q0zI6x7VqA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="antialiased bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <header class="bg-white shadow-sm sticky top-0 z-10">
        <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}" class="text-2xl font-bold tracking-wider text-red-600 uppercase">
                Your Hotel
            </a>

            <div class="flex items-center space-x-6">
                <a href="{{ url('/') }}" class="text-sm font-medium hover:text-red-600 transition duration-150">Home</a>
                <a href="{{ route('rooms.index') }}" class="text-sm font-medium hover:text-red-600 transition duration-150">Rooms</a>
                
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-sm text-white transition duration-200 bg-red-600 rounded-full hover:bg-red-700">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-4 py-2 text-sm text-red-600 transition duration-200 border border-red-600 rounded-full hover:bg-red-50">
                            Login
                        </a>
                    @endauth
                @endif
            </div>
        </nav>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="bg-gray-800 py-8 mt-auto">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center text-sm text-gray-400">
            &copy; {{ date('Y') }} Your Hotel. All rights reserved. | <span class="text-red-400">Elegance in Every Stay.</span>
        </div>
    </footer>

</body>
</html>
