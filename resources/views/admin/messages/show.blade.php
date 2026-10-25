@extends('layouts.admin')

@section('title', 'Detail pesan — Admin')

@section('content')
    <div class="flex flex-wrap items-center justify-between gap-3">
        <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint hover:text-cobalt">
            <span aria-hidden="true">←</span> Kembali ke pesan
        </a>
        <span class="stamp {{ $message->status->stampClass() }}">{{ $message->status->label() }}</span>
    </div>

    <div class="mt-5 grid gap-8 xl:grid-cols-12">
        <div class="xl:col-span-8">
            <div class="sheet-flat">
                <div class="border-b border-line bg-paper-deep px-5 py-4">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Pesan masuk</p>
                    <h1 class="mt-2 font-display text-3xl font-semibold tracking-[-0.03em] text-ink">{{ $message->subject }}</h1>
                    <p class="mt-2 font-mono text-[10px] text-ink-faint">{{ $message->created_at->translatedFormat('d F Y, H:i') }}</p>
                </div>
                <div class="p-5">
                    <div class="flex flex-wrap items-center gap-x-6 gap-y-2 border-b border-line pb-4">
                        <div>
                            <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Dari</p>
                            <p class="mt-1 text-sm font-medium text-ink">{{ $message->name }}</p>
                        </div>
                        <div>
                            <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Email</p>
                            <a href="mailto:{{ $message->email }}" class="mt-1 block break-all text-sm text-cobalt hover:underline">{{ $message->email }}</a>
                        </div>
                    </div>
                    <div class="mt-5 whitespace-pre-line text-[0.975rem] leading-relaxed text-ink-soft">{{ $message->message }}</div>
                </div>
            </div>

            <div class="mt-5 flex flex-wrap gap-3">
                <a href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: '.$message->subject) }}" class="btn btn-primary">Balas via email ↗</a>
                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" data-confirm-form="admin-confirm-dialog">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus pesan</button>
                </form>
            </div>
        </div>

        <aside class="xl:col-span-4">
            <div class="sheet-flat">
                <div class="border-b border-line bg-paper-deep px-4 py-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Status pesan</p>
                </div>
                <form action="{{ route('admin.messages.update', $message) }}" method="POST" class="p-4">
                    @csrf
                    @method('PATCH')
                    <label for="status" class="label">Ubah status</label>
                    <select name="status" id="status" class="field">
                        @foreach ($statuses as $status)
                            <option value="{{ $status->value }}" @selected($message->status === $status)>{{ $status->label() }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('status'))
                        <p class="error">{{ $errors->first('status') }}</p>
                    @endif
                    <button type="submit" class="btn btn-secondary mt-4 w-full">Simpan status</button>
                </form>
                <div class="border-t border-line px-4 py-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Dibaca</p>
                    <p class="mt-1 text-sm text-ink">{{ $message->read_at?->translatedFormat('d F Y, H:i') ?? 'Belum dibaca' }}</p>
                </div>
            </div>

            <div class="mt-5 border border-line bg-paper-deep p-4">
                <p class="text-xs leading-relaxed text-ink-soft">
                    Membalas lewat email tidak otomatis mengubah status. Ubah status menjadi “Dibalas” setelah pesan ditangani.
                </p>
            </div>
        </aside>
    </div>
@endsection
