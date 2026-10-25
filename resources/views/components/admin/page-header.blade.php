@props(['title', 'eyebrow' => null, 'description' => null])

<div class="border-b border-line pb-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <h1 class="display text-[clamp(2rem,3vw,2.8rem)] text-ink">{{ $title }}</h1>
            @if ($description)
                <p class="mt-2 max-w-2xl text-sm leading-relaxed text-ink-soft">{{ $description }}</p>
            @endif
        </div>

        <div class="flex flex-col items-start gap-3 sm:items-end">
            @if ($eyebrow)
                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">{{ $eyebrow }}</p>
            @endif
            @if (isset($actions))
                <div class="flex flex-wrap items-center gap-2">
                    {{ $actions }}
                </div>
            @endif
        </div>
    </div>
</div>
