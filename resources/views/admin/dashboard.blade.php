@extends('layouts.admin')

@section('title', 'Dashboard — Admin')

@section('content')
    <x-admin.page-header
        eyebrow="01 / Ringkasan"
        title="Dashboard"
        description="Keadaan situs dan pekerjaan yang perlu ditindaklanjuti."
    >
        <x-slot:actions>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary cursor-pointer">Project baru</a>
            <a href="{{ route('home') }}" class="btn btn-secondary cursor-pointer" target="_blank" rel="noopener noreferrer">Lihat situs ↗</a>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['Total project', $stats['projects'], 'Semua entri di database', 'border-t-ink'],
            ['Published', $stats['published'], 'Tampil di situs publik', 'border-t-success'],
            ['Draft', $stats['drafts'], 'Belum terlihat publik', 'border-t-manila-deep'],
            ['Pesan baru', $stats['unread'], 'Belum dibaca', 'border-t-cobalt'],
        ] as [$label, $value, $note, $border])
            <div class="sheet-flat border-t-2 {{ $border }} p-4">
                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">{{ $label }}</p>
                <p class="mt-3 font-display text-4xl font-semibold tracking-[-0.04em] text-ink">{{ $value }}</p>
                <p class="mt-1 text-xs leading-relaxed text-ink-soft">{{ $note }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-8 grid gap-8 xl:grid-cols-12">
        <section class="xl:col-span-8">
            <div class="flex items-end justify-between gap-4 border-b border-line pb-3">
                <h2 class="font-display text-xl font-semibold tracking-[-0.03em] text-ink">Entri terakhir</h2>
                <a href="{{ route('admin.projects.index') }}" class="font-mono text-[9px] uppercase tracking-[0.12em] text-cobalt hover:underline cursor-pointer">Semua project →</a>
            </div>

            <div class="table-wrap mt-4">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Diperbarui</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($recentProjects as $project)
                            <tr>
                                <td>
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="font-medium text-ink hover:text-cobalt cursor-pointer">{{ $project->title }}</a>
                                    <p class="mt-1 font-mono text-[9px] text-ink-faint">/{{ $project->slug }}</p>
                                </td>
                                <td class="text-ink-soft">{{ $project->category }}</td>
                                <td>
                                    <span class="stamp {{ $project->status->stampClass() }}">{{ $project->status->label() }}</span>
                                </td>
                                <td class="font-mono text-[10px] text-ink-faint">{{ $project->updated_at->translatedFormat('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-10 text-center text-sm text-ink-soft">Belum ada project. Mulai dari tombol “Project baru”.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <aside class="xl:col-span-4">
            <div class="flex items-end justify-between gap-4 border-b border-line pb-3">
                <h2 class="font-display text-xl font-semibold tracking-[-0.03em] text-ink">Kotak masuk</h2>
                <a href="{{ route('admin.messages.index') }}" class="font-mono text-[9px] uppercase tracking-[0.12em] text-cobalt hover:underline cursor-pointer">Semua →</a>
            </div>

            <div class="mt-4 divide-y divide-line border border-line bg-paper-raised">
                @forelse ($recentMessages as $message)
                    <a href="{{ route('admin.messages.show', $message) }}" class="block px-4 py-3 transition-colors hover:bg-cobalt-wash/40 cursor-pointer">
                        <div class="flex items-center justify-between gap-3">
                            <span class="flex items-center gap-2 text-sm font-medium text-ink">
                                @if ($message->isUnread())
                                    <span class="size-1.5 bg-cobalt" aria-label="Belum dibaca"></span>
                                @endif
                                {{ $message->name }}
                            </span>
                            <span class="font-mono text-[9px] text-ink-faint">{{ $message->created_at->translatedFormat('d M') }}</span>
                        </div>
                        <p class="mt-1 truncate text-sm text-ink-soft">{{ $message->subject }}</p>
                    </a>
                @empty
                    <p class="px-4 py-10 text-center text-sm text-ink-soft">Belum ada pesan masuk.</p>
                @endforelse
            </div>

            <div class="mt-6 border border-line bg-paper-deep p-4">
                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Status profil</p>
                <div class="mt-3 flex items-center justify-between gap-3 text-sm">
                    <span class="text-ink-soft">CV publik</span>
                    @if ($profile->hasCv())
                        <span class="stamp stamp-success">Tersedia</span>
                    @else
                        <span class="stamp stamp-manila">Belum ada</span>
                    @endif
                </div>
                <div class="mt-2 flex items-center justify-between gap-3 text-sm">
                    <span class="text-ink-soft">LinkedIn</span>
                    @if ($profile->linkedin_url)
                        <span class="stamp stamp-success">Tertaut</span>
                    @else
                        <span class="stamp stamp-manila">Disembunyikan</span>
                    @endif
                </div>
                <a href="{{ route('admin.profile.edit') }}" class="mt-4 inline-flex font-mono text-[9px] uppercase tracking-[0.12em] text-cobalt hover:underline cursor-pointer">Kelola profil →</a>
            </div>
        </aside>
    </div>
@endsection
