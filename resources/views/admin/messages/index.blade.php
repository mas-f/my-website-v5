@extends('layouts.admin')

@section('title', 'Pesan — Admin')

@section('content')
    <x-admin.page-header
        eyebrow="03 / Pesan"
        title="Pesan"
        description="Pesan dari formulir kontak. Pesan baru dihitung sampai dibuka."
    >
        <x-slot:actions>
            <span class="stamp stamp-cobalt">{{ $unread }} belum dibaca</span>
        </x-slot:actions>
    </x-admin.page-header>

    <form action="{{ route('admin.messages.index') }}" method="GET" class="mt-6 flex flex-col gap-3 border border-line bg-paper-raised p-4 sm:flex-row sm:items-end">
        <div class="flex-1">
            <label for="q" class="label">Cari pesan</label>
            <input type="search" name="q" id="q" value="{{ request('q') }}" class="field" placeholder="Nama, email, atau subjek">
        </div>
        <div class="sm:w-44">
            <label for="status" class="label">Status</label>
            <select name="status" id="status" class="field">
                <option value="">Semua status</option>
                @foreach ($statuses as $status)
                    <option value="{{ $status->value }}" @selected(request('status') === $status->value)>{{ $status->label() }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="btn btn-primary">Filter</button>
            @if (request()->filled('q') || request()->filled('status'))
                <a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">Reset</a>
            @endif
        </div>
    </form>

    <div class="table-wrap mt-6">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Status</th>
                    <th>Pengirim</th>
                    <th>Subjek</th>
                    <th>Diterima</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr class="{{ $message->isUnread() ? 'bg-cobalt-wash/30' : '' }}">
                        <td><span class="stamp {{ $message->status->stampClass() }}">{{ $message->status->label() }}</span></td>
                        <td>
                            <p class="font-medium text-ink">{{ $message->name }}</p>
                            <p class="mt-1 break-all font-mono text-[9px] text-ink-faint">{{ $message->email }}</p>
                        </td>
                        <td>
                            <a href="{{ route('admin.messages.show', $message) }}" class="font-medium text-ink hover:text-cobalt">{{ $message->subject }}</a>
                            <p class="mt-1 line-clamp-1 max-w-md text-sm text-ink-soft">{{ $message->message }}</p>
                        </td>
                        <td class="font-mono text-[10px] text-ink-faint">{{ $message->created_at->translatedFormat('d M Y H:i') }}</td>
                        <td>
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.messages.show', $message) }}" class="border border-line-strong px-2 py-1 font-mono text-[9px] uppercase tracking-[0.1em] text-ink-soft hover:border-ink hover:text-ink">Buka</a>
                                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" data-confirm-form="admin-confirm-dialog" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="border border-stamp/40 px-2 py-1 font-mono text-[9px] uppercase tracking-[0.1em] text-stamp hover:bg-stamp hover:text-paper-raised">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-12 text-center">
                            <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">Tidak ada pesan</p>
                            <p class="mt-2 text-sm text-ink-soft">Pesan dari formulir kontak akan muncul di sini.</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($messages->hasPages())
        <div class="mt-5">
            {{ $messages->links() }}
        </div>
    @endif
@endsection
