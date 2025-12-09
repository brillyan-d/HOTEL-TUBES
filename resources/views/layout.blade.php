<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Your Hotel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Gaya Sederhana untuk Scrollbar yang Lebih Halus */
        body::-webkit-scrollbar { width: 8px; }
        body::-webkit-scrollbar-track { background: #f1f1f1; }
        body::-webkit-scrollbar-thumb { background: #888; border-radius: 4px; }
        body::-webkit-scrollbar-thumb:hover { background: #555; }
    </style>
</head>
<body class="bg-gray-100 flex h-screen antialiased">

    <aside class="w-64 bg-gray-900 text-white flex flex-col p-4 shadow-xl z-20">
        <div class="text-xl font-bold uppercase tracking-wider mb-8 text-red-500 border-b border-gray-700 pb-4">
            HOTEL ADMIN
        </div>
        <nav class="flex-grow">
            <ul>
                <li class="mb-2">
                    <a href="{{ url('/admin') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-150">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                        Dashboard
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('kamar.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ Request::is('kamar*') ? 'bg-gray-700 font-semibold' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-4"></path></svg>
                        Manajemen Kamar
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('booking.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ Request::is('booking*') ? 'bg-gray-700 font-semibold' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        Daftar Booking
                    </a>
                </li>
                <li class="mb-2">
                    <a href="{{ route('transaksi.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-700 transition duration-150 {{ Request::is('transaksi*') ? 'bg-gray-700 font-semibold' : '' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        Transaksi
                    </a>
                </li>
            </ul>
        </nav>

        <div class="mt-auto pt-4 border-t border-gray-700">
             <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left flex items-center p-3 rounded-lg text-red-400 hover:bg-red-700 hover:text-white transition duration-150">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="w-full bg-white shadow-md p-4 flex justify-between items-center z-10">
            <h1 class="text-2xl font-semibold text-gray-800">
                @yield('page_title', 'Admin Panel')
            </h1>
            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">
                    Hello, {{ Auth::user()->name ?? 'Admin' }}!
                </span>
            </div>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
