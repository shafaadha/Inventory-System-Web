@extends('layouts.main')

@section('container')
    <div class="flex-1 overflow-auto">
        <div class="p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
                <p class="text-gray-500 mt-1">Ringkasan inventory warehouse</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="bg-blue-100 p-3 rounded-lg w-fit mb-4">
                        <i class="fas fa-box text-2xl text-blue-600"></i>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Total Produk</h3>
                    <p id="totalProducts" class="text-3xl font-bold text-gray-900">0</p>
                    <p class="text-xs text-gray-400 mt-2">Jenis produk aktif</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="bg-green-100 p-3 rounded-lg w-fit mb-4">
                        <i class="fas fa-dollar-sign text-2xl text-green-600"></i>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Nilai Stok</h3>
                    <p id="stockValue" class="text-3xl font-bold text-gray-900">Rp 0</p>
                    <p class="text-xs text-gray-400 mt-2">Total nilai inventory</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="bg-purple-100 p-3 rounded-lg w-fit mb-4">
                        <i class="fas fa-arrow-down text-2xl text-purple-600"></i>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Barang Masuk (7 Hari)</h3>
                    <p id="stockIn7Days" class="text-3xl font-bold text-gray-900">0</p>
                    <p class="text-xs text-gray-400 mt-2">Total quantity</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="bg-orange-100 p-3 rounded-lg w-fit mb-4">
                        <i class="fas fa-exclamation-triangle text-2xl text-orange-600"></i>
                    </div>
                    <h3 class="text-gray-500 text-sm font-medium mb-1">Stok Menipis</h3>
                    <p id="lowStock" class="text-3xl font-bold text-gray-900">0</p>
                    <p class="text-xs text-gray-400 mt-2">Produk di bawah minimum</p>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <!-- Chart Trend -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Trend Transaksi (7 Hari Terakhir)</h3>
                    <canvas id="trendChart"></canvas>

                    <div class="flex items-center justify-center gap-6 mt-4">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="text-sm text-gray-600">Barang Masuk</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <span class="text-sm text-gray-600">Barang Keluar</span>
                        </div>
                    </div>
                </div>

                <!-- Low Stock Table -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="bg-orange-100 p-2 rounded-lg">
                            <i class="fas fa-exclamation-triangle text-xl text-orange-600"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Peringatan Stok Menipis</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Stok</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Min</th>
                                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($lowStockProducts as $product)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $product->code }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $product->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700 text-right">{{ $product->stock }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700 text-right">{{ $product->min_stock }}</td>
                                        <td class="px-4 py-3 text-center">
                                            <span
                                                class="px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                                Menipis
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center px-4 py-4 text-gray-500 text-sm">
                                            Tidak ada produk stok menipis 🎉
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Statistik
        document.getElementById("totalProducts").innerText = {{ $totalProducts }};
        document.getElementById("stockValue").innerText = "Rp " + new Intl.NumberFormat('id-ID').format({{ $stockValue }});
        document.getElementById("stockIn7Days").innerText = {{ $stockIn7Days }};
        document.getElementById("lowStock").innerText = {{ $lowStockCount }};

        // Data trend transaksi
        const trendLabels = @json($labels);
        const trendStockIn = @json($stockInData);
        const trendStockOut = @json($stockOutData);

        // Chart Trend
        const ctxTrend = document.getElementById('trendChart').getContext('2d');
        new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: trendLabels,
                datasets: [{
                        label: 'Barang Masuk',
                        data: trendStockIn,
                        borderColor: 'green',
                        backgroundColor: 'rgba(0, 128, 0, 0.2)',
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Barang Keluar',
                        data: trendStockOut,
                        borderColor: 'red',
                        backgroundColor: 'rgba(255, 0, 0, 0.2)',
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
