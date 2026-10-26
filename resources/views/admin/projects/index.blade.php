@extends('layouts.admin')

@section('title', 'Project — Admin')

@section('content')
    <x-admin.page-header
        eyebrow="02 / Project"
        title="Project"
        description="Kelola entri yang tampil di log project. Draft tidak akan terlihat publik."
    >
        <x-slot:actions>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary cursor-pointer">Project baru</a>
        </x-slot:actions>
    </x-admin.page-header>

    <form action="{{ route('admin.projects.index') }}" method="GET" class="mt-6 flex flex-col gap-3 border border-line bg-paper-raised p-4 sm:flex-row sm:items-end">
        <div class="flex-1">
            <label for="q" class="label">Cari project</label>
            <input type="search" name="q" id="q" value="{{ request('q') }}" class="field" placeholder="Judul, ringkasan, atau kategori">
        </div>
        <div class="sm:w-44">
            <label for="status" class="label">Status</label>
            <select name="status" id="status" class="field">
                <option value="">Semua status</option>
                <option value="draft" @selected(request('status') === 'draft')>Draft</option>
                <option value="published" @selected(request('status') === 'published')>Published</option>
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="btn btn-primary cursor-pointer">Filter</button>
            @if (request()->filled('q') || request()->filled('status'))
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary cursor-pointer">Reset</a>
            @endif
        </div>
    </form>

    <div class="table-wrap mt-6">
        <table class="data-table">
            <thead>
                <tr>
                    <th class="w-14">Gambar</th>
                    <th>Project</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Pilihan</th>
                    <th>Urutan</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($projects as $project)
                    <tr>
                        <td>
                            @if ($project->thumbnail_url)
                                <img src="{{ $project->thumbnail_url }}" alt="" class="size-10 border border-line object-cover" loading="lazy">
                            @else
                                <div class="grid size-10 place-items-center border border-line bg-paper-deep font-mono text-[9px] text-ink-faint">
                                    {{ str_pad((string) $project->id, 2, '0', STR_PAD_LEFT) }}
                                </div>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="font-medium text-ink hover:text-cobalt cursor-pointer">{{ $project->title }}</a>
                            <p class="mt-1 font-mono text-[9px] text-ink-faint">/{{ $project->slug }} · {{ $project->images_count }} gambar</p>
                        </td>
                        <td class="text-ink-soft">{{ $project->category?->name ?? '—' }}</td>
                        <td><span class="stamp {{ $project->status->stampClass() }}">{{ $project->status->label() }}</span></td>
                        <td>
                            @if ($project->is_featured)
                                <span class="stamp stamp-success">Ya</span>
                            @else
                                <span class="font-mono text-[10px] text-ink-faint">—</span>
                            @endif
                        </td>
                        <td class="font-mono text-[10px] text-ink-soft">{{ $project->sort_order }}</td>
                        <td>
                            <div class="flex flex-wrap justify-end gap-2">
                                @if ($project->isPublished())
                                    <a href="{{ route('projects.show', $project) }}" class="border border-line-strong px-2 py-1 font-mono text-[9px] uppercase tracking-[0.1em] text-ink-soft hover:border-ink hover:text-ink cursor-pointer" target="_blank" rel="noopener noreferrer">Lihat</a>
                                @endif
                                <a href="{{ route('admin.projects.edit', $project) }}" class="border border-line-strong px-2 py-1 font-mono text-[9px] uppercase tracking-[0.1em] text-ink-soft hover:border-ink hover:text-ink cursor-pointer">Edit</a>
                                <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" data-confirm-form="admin-confirm-dialog" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border border-stamp/40 px-2 py-1 font-mono text-[9px] uppercase tracking-[0.1em] text-stamp hover:bg-stamp hover:text-paper-raised cursor-pointer">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-12 text-center">
                            <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">Belum ada project</p>
                            <p class="mt-2 text-sm text-ink-soft">Mulai dengan membuat entri pertama.</p>
                            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary mt-4 cursor-pointer">Project baru</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($projects->hasPages())
        <div class="mt-5">
            {{ $projects->links() }}
        </div>
    @endif
@endsection
