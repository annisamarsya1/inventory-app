@extends('layouts.main')

@section('content')
<div class="card w-50 mx-auto">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Tambah Kategori Baru</h4>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Kategori</button>
        </form>
    </div>
</div>
@endsection