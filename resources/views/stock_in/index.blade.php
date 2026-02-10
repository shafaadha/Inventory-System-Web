@extends('layouts.main')
@section('container')
    <div class="flex-1 overflow-auto">
        <div class="p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Penerimaan Barang</h1>
                <p class="text-gray-500 mt-1">Input barang masuk ke warehouse</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!--form-->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="bg-green-100 p-2 rounded-lg">
                                <i class="fas fa-arrow-down text-xl text-green-600"></i>
                            </div>
                            <h2 class="text-lg font-semibold text-gray-900">Form Penerimaan</h2>
                        </div>
                        @if ($errors->any())
                            <div id="errorAlert"
                                class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm transition-opacity duration-500">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (session('success'))
                            <div id="successAlert"
                                class="mb-4 p-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm transition-opacity duration-500">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form id="stockInForm" class="space-y-4" method="POST" action="{{ route('stock_in.store') }}">
                            @csrf
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Produk</label>
                                <select id="product_id" name="product_id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none"
                                    required>
                                    <option value="">Pilih Produk</option>
                                    @foreach ($products as $p)
                                        <option value="{{ $p->id }}"
                                            {{ old('product_id') == $p->id ? 'selected' : '' }}>
                                            {{ $p->name }} (Stok: {{ $p->stock }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Referensi (PO/Invoice)</label>
                                <input type="text" id="reference_no" name="reference_no"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none"
                                    placeholder="PO-2024-001" required />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                                <input type="number" id="qty" name="qty"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none"
                                    min="1" required />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal</label>
                                <input type="date" id="date" name="date" min=""
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none"
                                    required />
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Catatan</label>
                                <textarea id="note" name="note"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent outline-none resize-none"
                                    rows="3" placeholder="Catatan tambahan..."></textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 rounded-lg transition">
                                Simpan Penerimaan
                            </button>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                        <div class="p-6 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Riwayat Penerimaan Terbaru</h2>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Referensi
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                            Catatan</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center divide-y divide-gray-200">
                                    @foreach ($stockIns as $in)
                                        <tr>
                                            <td class="px-6 py-2 text-left">{{ $in->date }}</td>
                                            <td class="px-6 py-2 text-left">{{ $in->product->name }}</td>
                                            <td class="px-6 py-2 text-left text-green-600">
                                                + {{ $in->qty }}
                                            </td>
                                            <td class="px-6 py-3 text-left">{{ $in->reference_no }}</td>
                                            <td class="px-6 py-3 text-left">{{ $in->note }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div id="emptyState" class="text-center py-12 text-gray-500 hidden">
                                Belum ada transaksi penerimaan
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const successAlert = document.getElementById("successAlert");
            const errorAlert = document.getElementById("errorAlert");

            function autoHide(alertBox) {
                if (alertBox) {
                    setTimeout(() => {
                        alertBox.classList.add("opacity-0");

                        setTimeout(() => {
                            alertBox.remove();
                        }, 500);
                    }, 3000);
                }
            }

            autoHide(successAlert);
            autoHide(errorAlert);
        });
    </script>
@endsection
