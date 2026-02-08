@extends('layouts.main')

@section('container')
    <div class="max-w-xl mx-auto p-6 bg-white rounded-xl shadow">
        <h1 class="text-lg font-bold mb-4">{{ $title }}</h1>

        {{-- BARANG MASUK --}}
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold mb-2">Barang Masuk</h2>
            <a href="{{ route('stock-in.create') }}"
                class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                + Tambah Stock
            </a>
        </div>
        <div class="overflow-x-auto rounded-md border mb-6">
            <table class="table-auto w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2">Tanggal</th>
                        <th class="px-3 py-2">Produk</th>
                        <th class="px-3 py-2">Qty</th>
                        <th class="px-3 py-2">Catatan</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($stockIns as $in)
                        <tr class="border-t">
                            <td class="px-3 py-2">{{ $in->date }}</td>
                            <td class="px-3 py-2">{{ $in->product->name }}</td>
                            <td class="px-3 py-2 text-center text-green-600">
                                {{ $in->qty }}
                            </td>
                            <td class="px-3 py-2">{{ $in->note }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="max-w-xl mx-auto p-6 mt-6 bg-white rounded-xl shadow">
        {{-- BARANG KELUAR --}}
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold mb-2">Barang Keluar</h2>
            <a href="{{ route('stock-out.create') }}"
                class="inline-block mb-4 px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                - Kurangi Stock
            </a>
        </div>
        <div class="overflow-x-auto rounded-md border">
            <table class="table-auto w-full">
                <thead class="bg-gray-100 texts">
                    <tr>
                        <th class="px-3 py-2">Tanggal</th>
                        <th class="px-3 py-2">Produk</th>
                        <th class="px-3 py-2">Qty</th>
                        <th class="px-3 py-2">Catatan</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($stockOuts as $out)
                        <tr class="border-t">
                            <td class="px-3 py-2">{{ $out->date }}</td>
                            <td class="px-3 py-2">{{ $out->product->name }}</td>
                            <td class="px-3 py-2 text-center text-red-600">
                                {{ $out->qty }}
                            </td>
                            <td class="px-3 py-2">{{ $out->note }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
