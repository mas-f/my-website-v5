@extends('layouts.admin')

@section('title', 'Edit project — Admin')

@section('content')
    <x-admin.page-header
        eyebrow="02 / Project"
        title="Edit project"
        description="Perbarui konten, media, dan status publikasi."
    >
        <x-slot:actions>
            <button type="submit" form="project-form" class="btn btn-primary cursor-pointer">Simpan perubahan</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary cursor-pointer">Kembali</a>
        </x-slot:actions>
    </x-admin.page-header>

    @include('admin.projects._form', [
        'project' => $project,
        'categories' => $categories,
        'statuses' => $statuses,
    ])
@endsection
