@extends('layouts.main')

@section('container')
<div class="max-w-cl max-auto p-6 bg-white rounded-xl shadow">
    <h1 class="font-bold text-lg mb-4">Form Barang</h1>

    @if (session('success'))
        <p class="mb-3 text-green-600">
            {{ session('success') }}
        </p>
    @endif

    <a
        href="{{ route('products.create') }}"
        class="inline-block mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
    >
        + Tambah Produk
    </a>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2">No</th>
                    <th class="border px-3 py-2">Kode</th>
                    <th class="border px-3 py-2">Nama</th>
                    <th class="border px-3 py-2">Stok</th>
                    <th class="border px-3 py-2">Satuan</th>
                    <th class="border px-3 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $p)
                    <tr class="hover:bg-gray-50">
                        <td class="border px-3 py-2 text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border px-3 py-2">
                            {{ $p->code }}
                        </td>
                        <td class="border px-3 py-2">
                            {{ $p->name }}
                        </td>
                        <td class="border px-3 py-2 text-center">
                            {{ $p->stock }}
                        </td>
                        <td class="border px-3 py-2 text-center">
                            {{ $p->unit }}
                        </td>
                        <td class="border px-3 py-2 text-center space-x-2">
                            <a
                                href="{{ route('products.edit', $p->id) }}"
                                class="text-blue-600 hover:underline"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('products.destroy', $p->id) }}"
                                method="POST"
                                class="inline"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    onclick="return confirm('Yakin hapus produk?')"
                                    class="text-red-600 hover:underline"
                                >
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
