@extends('layouts.main')

@section('container')
    <div class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow">

        <h1 class="text-xl font-bold text-gray-800 mb-6">
            ➕ Tambah Barang Masuk
        </h1>

        {{-- Error --}}
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-700 rounded-md">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('stock-in.store') }}" class="space-y-4">
            @csrf

            {{-- Produk --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Produk
                </label>
                <select name="product_id" id="product_id"
                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                    @foreach ($products as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Jumlah --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="qty">
                    Jumlah
                </label>
                <input type="number" name="qty" id="qty" min="1"
                    class="w-full rounded-md p-1 border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Masukkan jumlah">
            </div>

            {{-- Tanggal --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tanggal
                </label>
                <input type="date" name="date" value="{{ now()->toDateString() }}"
                    class="w-full rounded-md border-gray-300 p-1 focus:border-blue-500 focus:ring-blue-500">
            </div>

            {{-- Catatan --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="note">
                    Catatan
                </label>
                <textarea name="note" id="note" rows="3"
                    class="w-full rounded-md border-gray-300 p-1 focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Catatan tambahan (opsional)"></textarea>
            </div>

            {{-- Button --}}
            <div class="flex justify-end gap-2">
                <a href="{{ route('stock-in.index') }}" class="px-4 py-2 rounded-md border text-gray-600 hover:bg-gray-100">
                    Batal
                </a>

                <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
