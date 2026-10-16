@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between mb3">
        <h2>Daftar Kategori</h2>
        <a href="{{ route('categories.create')}}" class="btn btn-primaru"> Tambah Kategori
        </a>
    </div>

    <form action="{{ route('categories.index') }}" class="row g-2 mb-3" method="GET">
        <div class="col md-8">
            <input type="text" name="q"
                    value="{{ request('q') }}"
                    class="form-control"
                    placeholder="Cari kategori...">
        </div>
        <div class="col md-4">
            <button class="btn btn-primary">Cari</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Reset</a>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <td>{{ $loop -> iteration }}</td>
            <td>{{ $category -> name }}</td>
            <td>{{ $category -> description }}</td>
            <td>{{ $category -> created_at }}</td>
            <td>
                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm ">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}"
                    method="POST" class="d-inline" onsubmit="return confirm('Hapus Kategori Ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </td>
        </tr>
   
        @empty
        <tr>
            <td colspan="3">Belum ada data</td>
        </tr>
    </tbody>
    @endforelse
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        </table>
        <div class="mt-3 mb-2">
            {{ $categories->links() }}
        </div>

</div>  
@endsection