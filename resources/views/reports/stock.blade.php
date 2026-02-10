@extends('layouts.main')
@section('container')
    <div class="flex-1 overflow-auto">
        <div class="p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Laporan Stok Barang</h1>
                <p class="text-gray-500 mt-1">Monitoring stok real-time warehouse</p>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-gray-500 text-sm font-medium mb-2">Total Produk</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalProducts }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-gray-500 text-sm font-medium mb-2">Total Item</h3>
                    <p class="text-2xl font-bold text-gray-900">{{ $totalItems }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-gray-500 text-sm font-medium mb-2">Nilai Stok</h3>
                    <p id="stockValue" class="text-2xl font-bold text-gray-900">Rp
                        {{ number_format($priceStock, 0, ',', '.') }}</p>
                </div>
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-gray-500 text-sm font-medium mb-2">Stok Menipis</h3>
                    <p class="text-2xl font-bold text-orange-600">{{ $lowStock }}</p>
                </div>
            </div>

            <!-- Filter and Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="relative flex-1">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" id="searchInput" placeholder="Cari produk..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                                onkeyup="filterProducts()" />
                        </div>
                        <select id="categoryFilter"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                            onchange="filterProducts()">
                            <option value="all">Semua Kategori</option>
                        </select>
                        <select id="statusFilter"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                            onchange="filterProducts()">
                            <option value="all">Semua Status</option>
                            <option value="normal">Stok Normal</option>
                            <option value="low">Stok Menipis</option>
                        </select>
                        <button onclick="exportCSV()"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition whitespace-nowrap">
                            <i class="fas fa-download"></i>
                            Export CSV
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Satuan</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Stok</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Min. Stok</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Harga</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Total Nilai
                                </th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($products as $p)
                                <tr>
                                    <td class="px-6 py-4">{{ $p->code }}</td>
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $p->name }}</td>
                                    <td class="px-6 py-4 text-left">{{ $p->unit }}</td>
                                    <td class="px-6 py-4 text-right">{{ $p->stock }}</td>
                                    <td class="px-6 py-4 text-right">{{ $p->min_stock }}</td>
                                    <td class="px-6 py-4 text-right">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 text-right">
                                        Rp {{ number_format($p->stock * $p->price, 0, ',', '.') }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        @if ($p->stock <= $p->min_stock)
                                            <span
                                                class="px-3 py-1 rounded-full text-xs bg-orange-100 text-orange-700 font-semibold">
                                                Menipis
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700 font-semibold">
                                                Normal
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div id="emptyState" class="text-center py-12 text-gray-500 hidden">
                        <i class="fas fa-file-alt text-5xl text-gray-300 mb-3"></i>
                        <p>Tidak ada data yang ditemukan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
