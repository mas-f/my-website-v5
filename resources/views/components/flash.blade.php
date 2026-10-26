@if (session('success') || session('error') || $errors->any())
  <div class="border-b border-line bg-paper-raised" role="status" aria-live="polite">
    <div class="mx-auto flex max-w-360 items-start gap-3 px-5 py-3 sm:px-8 lg:px-12">
      @if (session('success'))
        <span class="mt-0.5 grid size-5 shrink-0 place-items-center border border-success bg-success-wash text-success"
          aria-hidden="true">
          <svg viewBox="0 0 16 16" class="size-3" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="square">
            <path d="m3 8 3 3 7-7" />
          </svg>
        </span>
        <p class="text-sm leading-relaxed text-ink-soft">{{ session('success') }}</p>
      @elseif (session('error'))
        <span
          class="mt-0.5 grid size-5 shrink-0 place-items-center border border-stamp bg-stamp-wash font-mono text-[10px] text-stamp"
          aria-hidden="true">!</span>
        <p class="text-sm leading-relaxed text-ink-soft">{{ session('error') }}</p>
      @else
        <span
          class="mt-0.5 grid size-5 shrink-0 place-items-center border border-stamp bg-stamp-wash font-mono text-[10px] text-stamp"
          aria-hidden="true">!</span>
        <p class="text-sm leading-relaxed text-ink-soft">Periksa kembali isian yang ditandai.</p>
      @endif
    </div>
  </div>
@endif
