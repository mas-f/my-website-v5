@extends('layouts.admin')

@section('title', 'Kategori baru — Admin')

@section('content')
    <x-admin.page-header
        eyebrow="03 / Kategori"
        title="Kategori baru"
        description="Tambahkan kategori yang akan dipakai untuk mengelompokkan project."
    >
        <x-slot:actions>
            <button type="submit" form="category-form" class="btn btn-primary cursor-pointer">Simpan kategori</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary cursor-pointer">Batal</a>
        </x-slot:actions>
    </x-admin.page-header>

    @include('admin.categories._form', [
        'category' => $category,
    ])
@endsection
