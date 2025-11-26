@extends('layout.master')

@section('title', 'Kategori Produk')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-0">Daftar Kategori</h1>
                    <p class="text-muted">Kelola kategori produk toko Anda</p>
                </div>
                <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-lg">+ Tambah Kategori</a>
            </div>
            <hr>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kategoris as $kategori)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td>
                        <a href="{{ route('admin.kategori.edit', $kategori->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
