<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 h-screen w-64 bg-white shadow-lg z-50 transform -translate-x-full transition-transform duration-300 md:translate-x-0 md:relative md:shadow-none">
        <div class="p-6">
            <h1 class="text-2xl font-bold mb-6">My Sidebar</h1>
            <ul>
                <li class="mb-4">
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'font-semibold text-blue-600' : 'text-gray-700' }}">
                        Dashboard
                    </a>
                </li>

                <li class="mb-4">
                    <a href="{{ route('products.index') }}"
                        class="{{ request()->routeIs('products.*') ? 'font-semibold text-blue-600' : 'text-gray-700' }}">
                        Products
                    </a>
                </li>

                <li class="mb-4">
                    <a href="{{ route('transaction.index') }}"
                        class="{{ request()->routeIs('transaction.*') ? 'font-semibold text-blue-600' : 'text-gray-700' }}">
                        Transaction
                    </a>
                </li>

                <li class="mt-auto pt-4 border-t border-gray-200">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-gray-700 hover:text-red-500">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main content -->
    <div class="flex-1 md:ml-10 min-h-screen">
        <!-- Navbar Mobile -->
        <nav class="flex items-center justify-between bg-white p-4 shadow-md md:hidden">
            <button id="toggleSidebar" class="text-gray-700 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16">
                    </path>
                </svg>
            </button>
            <span class="font-bold text-lg">{{ $title ?? 'Dashboard' }}</span>
        </nav>

        <!-- Page content -->
        <div class="p-6 pl-4 md:pl-10">
            @yield('container')
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggleSidebar');

        toggleBtn?.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
            sidebar.classList.toggle('translate-x-0');
        });
    </script>
</body>

</html>
