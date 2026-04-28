@extends('layouts.main')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Daftar Barang Inventaris</h5>
    </div>

    <div class="card-body">

        <!-- Tombol aksi -->
        <a href="/insert" class="btn btn-success mb-3">Tambah Data Otomatis</a>
        <a href="/update" class="btn btn-warning mb-3">Update Data</a>
        <a href="/delete" class="btn btn-danger mb-3"
           onclick="return confirm('Yakin ingin menghapus data?')">Delete Data</a>

        <!-- Tabel Produk -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '-' }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->description ?? '-' }}</td>
                        <td>{{ $product->status ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Data produk belum ada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-end">
            {{ $products->links() }}
        </div>

    </div>
</div>

@endsection