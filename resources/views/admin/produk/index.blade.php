@extends ('layout.master')

@section('title', 'Produk')

@section('content')
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="mb-0">Daftar Produk</h1>
                </div>
                <a href="{{ route('admin.produk.create') }}" class="btn btn-primary btn-lg">+ Tambah Produk</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Image</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produks as $produk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($produk->gambar)
                            <img src="{{ $produk->gambar }}" alt="{{ $produk->nama }}" style="max-width: 100px; max-height: 80px; object-fit: cover;">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>{{ $produk->nama }}</td>
                    <td>{{ $produk->kategori->nama }}</td>
                    <td>{{ $produk->harga }}</td>
                    <td>{{ $produk->stok }}</td>    
                    <td>{{ $produk->deskripsi }}</td>
                    <td>
                        <a href="{{ route('admin.produk.edit', $produk->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.produk.destroy', $produk->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@endsection
