@extends('layouts.main')

@section('container')
    <div class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow">
        <h1 class="font-bold text-lg mb-4">Tambah Produk</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block font-medium mb-1">Kode Produk</label>
                <input type="text" name="code" value="{{ old('code') }}" required placeholder="Contoh: PRD-001"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div>
                <label class="block font-medium mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    placeholder="Contoh: Gula Pasir 1Kg"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div>
                <label class="block font-medium mb-1">Deskripsi</label>
                <textarea name="description" rows="3" placeholder="Deskripsi produk (opsional)"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block font-medium mb-1">Satuan</label>
                <input type="text" name="unit" value="{{ old('unit') }}" required
                    placeholder="Contoh: pcs / box / kg"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div>
                <label class="block font-medium mb-1">Stok Awal</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div>
                <label class="block font-medium mb-1">Minimal Stok (Stok Menipis)</label>
                <input type="number" name="min_stock" value="{{ old('min_stock', 0) }}" min="0"
                    placeholder="Contoh: 5"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
                <small class="text-gray-500">
                    Jika stok <= minimal stok, produk dianggap menipis. </small>
            </div>

            <div>
                <label class="block font-medium mb-1">Harga</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', 0) }}" min="0"
                    placeholder="Contoh: 15000"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Simpan
                </button>

                <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
