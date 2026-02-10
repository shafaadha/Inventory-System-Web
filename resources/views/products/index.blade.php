@extends('layouts.main')

@section('container')
    <div class="flex-1 overflow-auto">
        <div class="p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Master Produk</h1>
                <p class="text-gray-500 mt-1">Kelola data produk warehouse</p>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4 justify-between">
                        <div class="relative flex-1 max-w-md">
                            <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                            <input type="text" id="searchInput" placeholder="Cari produk..."
                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                                onkeyup="filterProducts()" />
                        </div>
                        <a href="{{ route('products.create') }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition"><i
                                class="fas fa-plus"></i>Tambah Produk</a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Satuan</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Stok</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Min. Stok
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Harga</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($products as $p)
                                <tr>
                                    <td class="px-6 py-4">
                                        {{ $p->code }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $p->name }}
                                    </td>
                                    <td class="px-6 py-4 text-left">
                                        {{ $p->unit }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        {{ $p->stock }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        {{ $p->min_stock }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        {{ $p->price }}
                                    </td>

                                    <td class="px-6 py-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('products.edit', $p->id) }}"
                                                class="p-2 text-blue-600
                                                hover:bg-blue-50 rounded-lg transition">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $p->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus produk?')"
                                                    class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="emptyState" class="text-center py-12 text-gray-500 hidden">
                        Tidak ada produk yang ditemukan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
