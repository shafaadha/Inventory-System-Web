@extends('layouts.main')

@section('container')
    <div class="flex-1 overflow-auto">
        <div class="p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Laporan Transaksi</h1>
                <p class="text-gray-500 mt-1">Riwayat barang masuk dan keluar</p>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="bg-green-100 p-2 rounded-lg">
                            <i class="fas fa-arrow-down text-xl text-green-600"></i>
                        </div>
                        <h3 class="text-gray-500 text-sm font-medium">Transaksi Masuk</h3>
                    </div>
                    <p id="transactionsIn" class="text-2xl font-bold text-gray-900">0</p>
                    <p id="totalIn" class="text-sm text-gray-500 mt-1">Total: 0 items</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="bg-red-100 p-2 rounded-lg">
                            <i class="fas fa-arrow-up text-xl text-red-600"></i>
                        </div>
                        <h3 class="text-gray-500 text-sm font-medium">Transaksi Keluar</h3>
                    </div>
                    <p id="transactionsOut" class="text-2xl font-bold text-gray-900">0</p>
                    <p id="totalOut" class="text-sm text-gray-500 mt-1">Total: 0 items</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-gray-500 text-sm font-medium mb-2">Total Transaksi</h3>
                    <p id="totalTransactions" class="text-2xl font-bold text-gray-900">0</p>
                </div>

                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                    <h3 class="text-gray-500 text-sm font-medium mb-2">Selisih</h3>
                    <p id="difference" class="text-2xl font-bold">0</p>
                </div>
            </div>

            <!-- Filter and Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col lg:flex-row gap-4">
                        <div class="relative flex-1">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" id="searchInput" placeholder="Cari transaksi..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                                onkeyup="filterTransactions()" />
                        </div>
                        <select id="typeFilter"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                            onchange="filterTransactions()">
                            <option value="all">Semua Tipe</option>
                            <option value="in">Barang Masuk</option>
                            <option value="out">Barang Keluar</option>
                        </select>
                        <input type="date" id="startDate"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                            onchange="filterTransactions()" />
                        <input type="date" id="endDate"
                            class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                            onchange="filterTransactions()" />
                        <button onclick="exportCSV()"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition whitespace-nowrap">
                            <i class="fas fa-download"></i>
                            Export
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Tipe</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Catatan</th>
                            </tr>
                        </thead>
                        <tbody id="transactionTable" class="divide-y divide-gray-200"></tbody>
                    </table>
                    <div id="emptyState" class="text-center py-12 text-gray-500 hidden">
                        <i class="fas fa-chart-bar text-5xl text-gray-300 mb-3"></i>
                        <p>Tidak ada transaksi yang ditemukan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        const transactions = @json($transactions);

        function renderTable(data) {
            const tableBody = document.getElementById("transactionTable");
            const emptyState = document.getElementById("emptyState");

            tableBody.innerHTML = "";

            if (data.length === 0) {
                emptyState.classList.remove("hidden");
                return;
            }

            emptyState.classList.add("hidden");

            data.forEach(trx => {
                const badgeClass = trx.type === "in" ?
                    "bg-green-100 text-green-700" :
                    "bg-red-100 text-red-700";

                const row = `
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 text-sm text-gray-700">${trx.datetime}</td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold ${badgeClass}">
                            ${trx.type_label}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-700">${trx.code}</td>
                    <td class="px-6 py-4 text-sm font-medium text-gray-900">${trx.product}</td>
                    <td class="px-6 py-4 text-sm text-right font-semibold text-gray-900">${trx.qty}</td>
                    <td class="px-6 py-4 text-sm text-gray-700">${trx.note}</td>
                </tr>
            `;

                tableBody.innerHTML += row;
            });
        }

        function updateSummary(data) {
            const inTransactions = data.filter(t => t.type === "in");
            const outTransactions = data.filter(t => t.type === "out");

            const totalIn = inTransactions.reduce((sum, t) => sum + parseInt(t.qty), 0);
            const totalOut = outTransactions.reduce((sum, t) => sum + parseInt(t.qty), 0);

            document.getElementById("transactionsIn").innerText = inTransactions.length;
            document.getElementById("transactionsOut").innerText = outTransactions.length;
            document.getElementById("totalTransactions").innerText = data.length;

            document.getElementById("totalIn").innerText = `Total: ${totalIn} items`;
            document.getElementById("totalOut").innerText = `Total: ${totalOut} items`;

            const diff = totalIn - totalOut;
            const diffElement = document.getElementById("difference");

            diffElement.innerText = diff;

            if (diff >= 0) {
                diffElement.className = "text-2xl font-bold text-green-600";
            } else {
                diffElement.className = "text-2xl font-bold text-red-600";
            }
        }

        function filterTransactions() {
            const searchValue = document.getElementById("searchInput").value.toLowerCase();
            const typeValue = document.getElementById("typeFilter").value;
            const startDate = document.getElementById("startDate").value;
            const endDate = document.getElementById("endDate").value;

            let filtered = transactions.filter(trx => {
                const matchesSearch =
                    String(trx.product ?? "").toLowerCase().includes(searchValue) ||
                    String(trx.code ?? "").toLowerCase().includes(searchValue) ||
                    String(trx.type_label ?? "").toLowerCase().includes(searchValue) ||
                    String(trx.reference ?? "").toLowerCase().includes(searchValue) ||
                    String(trx.note ?? "").toLowerCase().includes(searchValue);

                const matchesType = (typeValue === "all") || (trx.type === typeValue);

                const trxDate = trx.date;
                const matchesStart = !startDate || trxDate >= startDate;
                const matchesEnd = !endDate || trxDate <= endDate;

                return matchesSearch && matchesType && matchesStart && matchesEnd;
            });

            renderTable(filtered);
            updateSummary(filtered);
        }

        function exportCSV() {
            let csv = "Tanggal,Tipe,Kode,Nama Produk,Jumlah,Referensi,Catatan\n";

            transactions.forEach(trx => {
                csv +=
                    `${trx.datetime},${trx.type_label},${trx.code},${trx.product},${trx.qty},${trx.reference},${trx.note}\n`;
            });

            const blob = new Blob([csv], {
                type: "text/csv;charset=utf-8;"
            });
            const link = document.createElement("a");
            link.href = URL.createObjectURL(blob);
            link.download = "laporan_transaksi.csv";
            link.click();
        }

        document.addEventListener("DOMContentLoaded", () => {
            renderTable(transactions);
            updateSummary(transactions);
        });
    </script>
@endsection
