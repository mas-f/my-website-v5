@extends('layouts.admin')

@section('title', 'Project baru — Admin')

@section('content')
    <x-admin.page-header
        eyebrow="02 / Project"
        title="Project baru"
        description="Buat entri baru. Simpan sebagai draft jika belum siap tampil publik."
    >
        <x-slot:actions>
            <button type="submit" form="project-form" class="btn btn-primary">Simpan project</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Batal</a>
        </x-slot:actions>
    </x-admin.page-header>

    @include('admin.projects._form', [
        'project' => $project,
        'categories' => $categories,
        'statuses' => $statuses,
    ])
@endsection
