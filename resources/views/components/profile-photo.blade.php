@props(['profile'])

<figure class="border border-line bg-paper-raised">
    <div class="aspect-[4/5] overflow-hidden bg-paper-deep">
        @if ($profile->hasPhoto())
            <img src="{{ $profile->photo_url }}" alt="Foto {{ $profile->name }}"
                class="size-full object-cover object-center" loading="eager" fetchpriority="high" decoding="async">
        @else
            <div class="grid size-full place-items-center p-6 text-center">
                <div>
                    <span class="mx-auto grid size-20 place-items-center border border-ink bg-ink font-mono text-[11px] tracking-[0.18em] text-paper-raised">FOTO</span>
                    <p class="mt-4 font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Foto belum diunggah</p>
                </div>
            </div>
        @endif
    </div>
    <figcaption class="flex items-center justify-between gap-3 border-t border-line bg-paper-deep px-3 py-2 font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">
        <span>Portrait / 01</span>
        <span class="truncate text-right">{{ $profile->location }}</span>
    </figcaption>
</figure>
