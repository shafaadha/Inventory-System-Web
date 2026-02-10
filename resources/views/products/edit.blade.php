@extends('layouts.main')

@section('container')
    <div class="p-4 max-w-lg">
        <h1 class="font-bold text-lg mb-4">Edit Produk</h1>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('products.update', $product->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block font-medium mb-1">Kode Produk</label>
                <input type="text" name="code" value="{{ old('code', $product->code) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div>
                <label class="block font-medium mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div>
                <label class="block font-medium mb-1">Satuan</label>
                <input type="text" name="unit" value="{{ old('unit', $product->unit) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div>
                <label class="block font-medium mb-1">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>
            <div>
                <label class="block font-medium mb-1">Miniman Stok</label>
                <input type="number" name="min_stock" value="{{ old('stock', $product->min_stock) }}"
                    class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Update
                </button>

                <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Kembali
                </a>
            </div>
        </form>
    </div>
@endsection
