@extends('layouts.admin')

@section('title', 'Edit kategori — Admin')

@section('content')
    <x-admin.page-header
        eyebrow="03 / Kategori"
        title="Edit kategori"
        description="Perbarui nama, slug, atau urutan tampil kategori."
    >
        <x-slot:actions>
            <button type="submit" form="category-form" class="btn btn-primary cursor-pointer">Simpan perubahan</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary cursor-pointer">Kembali</a>
        </x-slot:actions>
    </x-admin.page-header>

    @include('admin.categories._form', [
        'category' => $category,
    ])
@endsection
