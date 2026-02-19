<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Dashboard' }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed top-0 left-0 w-64 bg-white shadow-lg z-50 transform -translate-x-full transition-transform duration-300 md:translate-x-0 md:shadow-none h-screen">

        <div class="p-6 h-full flex flex-col">
            <!-- Header -->
            <h1 class="text-2xl font-bold mb-6">Inventory App</h1>

            <!-- Menu -->
            <ul class="flex-1 flex flex-col overflow-y-auto">
                <li class="mb-4">
                    <a href="{{ route('dashboard') }}"
                        class="{{ request()->routeIs('dashboard') ? 'font-semibold text-blue-600' : 'text-gray-700' }}">
                        Dashboard
                    </a>
                </li>

                @role('admin')
                    <li class="mb-4">
                        <a href="{{ route('products.index') }}"
                            class="{{ request()->routeIs('products.*') ? 'font-semibold text-blue-600' : 'text-gray-700' }}">
                            Master Products
                        </a>
                    </li>
                @endrole

                <li class="mb-4">
                    <a href="{{ route('stock_in.index') }}"
                        class="{{ request()->routeIs('stock_in.*') ? 'font-semibold text-blue-600' : 'text-gray-700' }}">
                        Penerimaan Barang
                    </a>
                </li>

                <li class="mb-4">
                    <a href="{{ route('stock_out.index') }}"
                        class="{{ request()->routeIs('stock_out.*') ? 'font-semibold text-blue-600' : 'text-gray-700' }}">
                        Pengeluaran Barang
                    </a>
                </li>

                @role('admin')
                    <li class="mb-4">
                        <a href="{{ route('report.stock') }}"
                            class="{{ request()->routeIs('report.stock') ? 'font-semibold text-blue-600' : 'text-gray-700' }}">
                            Laporan Stok
                        </a>
                    </li>
                @endrole

                @role('admin')
                    <li class="mb-4">
                        <a href="{{ route('report.transaction') }}"
                            class="{{ request()->routeIs('report.transaction') ? 'font-semibold text-blue-600' : 'text-gray-700' }}">
                            Laporan Transaksi
                        </a>
                    </li>
                @endrole

                <li class="mt-auto pt-4 border-t border-gray-200">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-2 rounded-lg transition">
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>


    <!-- Main content -->
    <div class="flex-1 md:ml-64 min-h-screen">
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

    <script src="https://kit.fontawesome.com/8b572ffabd.js" crossorigin="anonymous"></script>

    <script>
        const sidebar = document.getElementById("sidebar");
        const toggleBtn = document.getElementById("toggleSidebar");

        toggleBtn?.addEventListener("click", () => {
            sidebar.classList.toggle("-translate-x-full");
            sidebar.classList.toggle("translate-x-0");
        });
    </script>

</body>

</html>
