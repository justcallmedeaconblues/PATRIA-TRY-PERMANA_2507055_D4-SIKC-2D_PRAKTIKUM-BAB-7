@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Edit Kategori</h2>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" >
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="" class="form-label">Nama Kategori</label>
            <input type="text" name="name"
                    value="{{ old('name', $category->name) }}"
                    class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" id="">{{ old('description', $category->description) }}</textarea>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection