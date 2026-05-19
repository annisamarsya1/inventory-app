@extends('layouts.main')

@section('content')
    <div class="card w-50 mx-auto">
        <div class="card-header">
            <h4>Edit Data Kategori</h4>
        </div>
        <div class="card-body">
            <!-- Route action menuju fungsi UPDATE dengan melempar parameter ID yang diedit -->
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                <!-- HTML standar tidak mengenali metode form 'PUT', karenanya kita timpa 
                 (Method Spoofing) menggunakan direktif 
                 @method('PUT') agar router Laravel paham bahwa ini adalah rute proses modifikasi. -->
                @method('PUT')
                <div class="mb-3">
                    <label>Nama Kategori</label>
                    <!-- Sisipkan nama kategori dari MySQL sebagai nilai default melalui tag atribut Value. 
                         'old' mencegah tulisan lama hilang jika gagal simpan akibat form invalid -->
                    <input type="text" name="name" class="form-control" required
                           value="{{ old('name', $category->name) }}">
                </div>
                <!-- Tombol Action -->
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal Edit</a>
            </form>
        </div>
    </div>
@endsectio