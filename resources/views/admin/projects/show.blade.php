@extends('layouts.admin')

@section('title', 'Detail project — Admin')

@section('content')
    <x-admin.page-header
        eyebrow="02 / Project"
        title="{{ $project->title }}"
        description="Pratinjau internal entri project."
    >
        <x-slot:actions>
            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary cursor-pointer">Edit project</a>
            @if ($project->isPublished())
                <a href="{{ route('projects.show', $project) }}" class="btn btn-secondary cursor-pointer" target="_blank" rel="noopener noreferrer">Lihat publik ↗</a>
            @endif
        </x-slot:actions>
    </x-admin.page-header>

    <div class="mt-6 flex flex-wrap gap-2">
        <span class="stamp {{ $project->status->stampClass() }}">{{ $project->status->label() }}</span>
        <span class="stamp stamp-cobalt">{{ $project->category?->name ?? 'Tanpa kategori' }}</span>
        @if ($project->is_featured) <span class="stamp stamp-success">Pilihan</span> @endif
        @if ($project->is_placeholder) <span class="stamp stamp-manila">Contoh</span> @endif
    </div>

    <div class="mt-6 grid gap-8 xl:grid-cols-12">
        <div class="space-y-6 xl:col-span-8">
            <section class="sheet-flat p-5">
                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Ringkasan</p>
                <p class="mt-3 text-base leading-relaxed text-ink-soft">{{ $project->summary }}</p>
            </section>

            @if ($project->problem_statement)
                <section class="sheet-flat p-5">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Masalah</p>
                    <div class="prose-log mt-3">
                        @foreach (preg_split('/\R\R+/', $project->problem_statement) as $paragraph)
                            <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                        @endforeach
                    </div>
                </section>
            @endif

            @if ($project->solution)
                <section class="sheet-flat p-5">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Pendekatan</p>
                    <div class="prose-log mt-3">
                        @foreach (preg_split('/\R\R+/', $project->solution) as $paragraph)
                            <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                        @endforeach
                    </div>
                </section>
            @endif

            <section class="sheet-flat p-5">
                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Deskripsi</p>
                <div class="prose-log mt-3">
                    @foreach (preg_split('/\R\R+/', $project->description) as $paragraph)
                        <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                    @endforeach
                </div>
            </section>

            @if ($project->images->isNotEmpty())
                <section class="sheet-flat p-5">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Galeri</p>
                    <div class="mt-4 grid gap-4 sm:grid-cols-2">
                        @foreach ($project->images as $image)
                            <img src="{{ $image->url }}" alt="{{ $image->alt_text ?: 'Gambar project' }}" class="w-full border border-line object-cover" loading="lazy">
                        @endforeach
                    </div>
                </section>
            @endif
        </div>

        <aside class="space-y-6 xl:col-span-4">
            <div class="sheet-flat">
                <div class="border-b border-line bg-paper-deep px-4 py-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Metadata</p>
                </div>
                <dl class="divide-y divide-line">
                    @foreach ([
                        ['Slug', $project->slug],
                        ['Kategori', $project->category?->name ?? '—'],
                        ['Urutan', (string) $project->sort_order],
                        ['Publikasi', $project->published_at?->translatedFormat('d F Y') ?? '—'],
                        ['Diperbarui', $project->updated_at->translatedFormat('d F Y H:i')],
                    ] as [$label, $value])
                        <div class="px-4 py-3">
                            <dt class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">{{ $label }}</dt>
                            <dd class="mt-1 break-words text-sm text-ink">{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>

            <div class="sheet-flat p-4">
                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Teknologi</p>
                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach ($project->technologies ?? [] as $technology)
                        <span class="border border-line-strong px-2 py-1 font-mono text-[9px] uppercase tracking-[0.1em] text-ink-soft">{{ $technology }}</span>
                    @endforeach
                </div>
            </div>

            @if ($project->features)
                <div class="sheet-flat p-4">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Fitur</p>
                    <ul class="mt-3 grid gap-2 text-sm text-ink-soft">
                        @foreach ($project->features as $feature)
                            <li class="flex gap-2"><span class="text-cobalt" aria-hidden="true">+</span> {{ $feature }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </aside>
    </div>
@endsection
