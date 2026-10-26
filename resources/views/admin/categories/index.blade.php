@extends('layouts.admin')

@section('title', 'Kategori — Admin')

@section('content')
    <x-admin.page-header
        eyebrow="03 / Kategori"
        title="Kategori"
        description="Kelola kategori yang dipakai project. Kategori yang masih dipakai tidak bisa dihapus."
    >
        <x-slot:actions>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary cursor-pointer">Kategori baru</a>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="table-wrap mt-6">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Project</th>
                    <th>Urutan</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="font-medium text-ink hover:text-cobalt cursor-pointer">{{ $category->name }}</a>
                        </td>
                        <td class="font-mono text-[10px] text-ink-faint">{{ $category->slug }}</td>
                        <td class="text-ink-soft">{{ $category->projects_count }} project</td>
                        <td class="font-mono text-[10px] text-ink-soft">{{ $category->sort_order }}</td>
                        <td>
                            <div class="flex flex-wrap justify-end gap-2">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="border border-line-strong px-2 py-1 font-mono text-[9px] uppercase tracking-[0.1em] text-ink-soft hover:border-ink hover:text-ink cursor-pointer">Edit</a>
                                @if ($category->projects_count === 0)
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" data-confirm-form="admin-confirm-dialog" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="border border-stamp/40 px-2 py-1 font-mono text-[9px] uppercase tracking-[0.1em] text-stamp hover:bg-stamp hover:text-paper-raised cursor-pointer">Hapus</button>
                                    </form>
                                @else
                                    <span class="border border-line-strong px-2 py-1 font-mono text-[9px] uppercase tracking-[0.1em] text-ink-faint" title="Masih dipakai project. Pindahkan project ke kategori lain terlebih dahulu.">Dipakai</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center">
                            <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">Belum ada kategori</p>
                            <p class="mt-2 text-sm text-ink-soft">Buat kategori pertama sebelum menambahkan project.</p>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mt-4 cursor-pointer">Kategori baru</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
