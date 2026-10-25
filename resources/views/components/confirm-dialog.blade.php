@props(['id', 'title' => 'Konfirmasi tindakan', 'message' => 'Tindakan ini tidak bisa dibatalkan. Lanjutkan?'])

<dialog id="{{ $id }}" class="w-[min(92vw,28rem)] border border-ink bg-paper-raised p-0 text-ink shadow-sheet" data-message="{{ $message }}">
    <div class="border-b border-line bg-paper-deep px-5 py-3">
        <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">Konfirmasi</p>
        <h2 class="mt-1 font-display text-xl font-semibold tracking-[-0.03em]">{{ $title }}</h2>
    </div>
    <div class="p-5">
        <p class="text-sm leading-relaxed text-ink-soft">{{ $message }}</p>
        <div class="mt-6 flex flex-wrap justify-end gap-2">
            <form method="dialog">
                <button type="submit" class="btn btn-secondary">Batal</button>
            </form>
            <button type="button" class="btn btn-danger" data-confirm-action>Ya, lanjutkan</button>
        </div>
    </div>
</dialog>
