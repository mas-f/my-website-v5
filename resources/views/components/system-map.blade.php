@props(['class' => ''])

<div {{ $attributes->class(['w-full', $class]) }}>
    <div class="flex items-end justify-between gap-4 border-b border-line pb-3">
        <div>
            <p class="eyebrow">Peta proses / SDLC</p>
            <p class="mt-1 font-mono text-[10px] tracking-[0.08em] text-ink-faint">Empat fase, satu putaran umpan balik.</p>
        </div>
        <button type="button"
            class="font-mono text-[9px] uppercase tracking-[0.14em] text-cobalt transition-opacity hover:opacity-70 cursor-pointer"
            data-replay-diagram="#system-map">
            Ulangi alur ↻
        </button>
    </div>

    <div class="relative mt-4 border border-line bg-paper-raised">
        <svg id="system-map" viewBox="0 0 640 480" class="hidden w-full sm:block" role="img"
            aria-labelledby="system-map-title system-map-desc">
            <title id="system-map-title">Alur kerja pengembangan sistem</title>
            <desc id="system-map-desc">Empat fase pengembangan sistem: perencanaan, analisis, desain, dan implementasi,
                dengan umpan balik dari implementasi ke perencanaan.</desc>

            <defs>
                <pattern id="system-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <path d="M 20 0 L 0 0 0 20" fill="none" stroke="var(--color-ink)" stroke-opacity=".05"
                        stroke-width="1" />
                </pattern>
                <marker id="system-arrow" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6"
                    markerHeight="6" orient="auto-start-reverse">
                    <path d="M 0 0 L 10 5 L 0 10 z" fill="var(--color-line-strong)" />
                </marker>
                <marker id="system-arrow-cobalt" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6"
                    markerHeight="6" orient="auto-start-reverse">
                    <path d="M 0 0 L 10 5 L 0 10 z" fill="var(--color-cobalt)" />
                </marker>
            </defs>

            <rect width="640" height="480" fill="url(#system-grid)" />

            <line x1="40" y1="52" x2="600" y2="52" stroke="var(--color-line-strong)"
                stroke-dasharray="3 6" />
            <text x="40" y="44" fill="var(--color-line-strong)" font-family="var(--font-mono)" font-size="9"
                letter-spacing=".12em">SDLC</text>

            <line x1="40" y1="240" x2="600" y2="240" stroke="var(--color-line-strong)"
                stroke-dasharray="3 6" />
            <text x="40" y="232" fill="var(--color-line-strong)" font-family="var(--font-mono)" font-size="9"
                letter-spacing=".12em">SIKLUS</text>

            <g fill="none" stroke="var(--color-line-strong)" stroke-width="1.2">
                <path class="diagram-line" pathLength="1" d="M 265 115 H 375" marker-end="url(#system-arrow)" />
                <path class="diagram-line" pathLength="1" d="M 487.5 160 V 290" marker-end="url(#system-arrow)" />
                <path class="diagram-line" pathLength="1" d="M 375 335 H 265" marker-end="url(#system-arrow)" />
            </g>

            <path d="M 152.5 290 V 160" fill="none" stroke="var(--color-cobalt)" stroke-width="1.2"
                stroke-dasharray="4 5" marker-end="url(#system-arrow-cobalt)" />

            <g font-family="var(--font-mono)" font-size="9" letter-spacing=".08em" fill="var(--color-ink-faint)">
                <text x="320" y="105" text-anchor="middle">kebutuhan</text>
                <text x="497" y="228">temuan</text>
                <text x="320" y="325" text-anchor="middle">rancangan</text>
            </g>
            <text x="162" y="228" fill="var(--color-cobalt)" font-family="var(--font-mono)" font-size="9"
                letter-spacing=".08em">umpan balik</text>

            <rect x="275" y="214" width="90" height="52" fill="var(--color-paper-raised)" />
            <text x="320" y="232" text-anchor="middle" fill="var(--color-ink-faint)"
                font-family="var(--font-mono)" font-size="9" letter-spacing=".12em">EMPAT FASE</text>
            <text x="320" y="252" text-anchor="middle" fill="var(--color-cobalt)" font-family="var(--font-mono)"
                font-size="9" letter-spacing=".12em">SATU PUTARAN</text>

            <g>
                <rect x="40" y="70" width="225" height="90" fill="var(--color-paper-raised)"
                    stroke="var(--color-ink)" />
                <text x="56" y="92" fill="var(--color-cobalt)" font-family="var(--font-mono)" font-size="9"
                    letter-spacing=".12em">01</text>
                <text x="56" y="124" fill="var(--color-ink)" font-family="var(--font-mono)" font-size="13"
                    letter-spacing=".08em">PERENCANAAN</text>
                <text x="56" y="144" fill="var(--color-ink-faint)" font-family="var(--font-mono)" font-size="9"
                    letter-spacing=".08em">kebutuhan / tujuan</text>

                <rect x="375" y="70" width="225" height="90" fill="var(--color-paper-raised)"
                    stroke="var(--color-ink)" />
                <text x="391" y="92" fill="var(--color-cobalt)" font-family="var(--font-mono)" font-size="9"
                    letter-spacing=".12em">02</text>
                <text x="391" y="124" fill="var(--color-ink)" font-family="var(--font-mono)" font-size="13"
                    letter-spacing=".08em">ANALISIS</text>
                <text x="391" y="144" fill="var(--color-ink-faint)" font-family="var(--font-mono)" font-size="9"
                    letter-spacing=".08em">proses / akar masalah</text>

                <rect x="375" y="290" width="225" height="90" fill="var(--color-paper-raised)"
                    stroke="var(--color-ink)" />
                <text x="391" y="312" fill="var(--color-cobalt)" font-family="var(--font-mono)" font-size="9"
                    letter-spacing=".12em">03</text>
                <text x="391" y="344" fill="var(--color-ink)" font-family="var(--font-mono)" font-size="13"
                    letter-spacing=".08em">DESAIN</text>
                <text x="391" y="364" fill="var(--color-ink-faint)" font-family="var(--font-mono)" font-size="9"
                    letter-spacing=".08em">arsitektur / UI</text>

                <rect x="40" y="290" width="225" height="90" fill="var(--color-paper-raised)"
                    stroke="var(--color-ink)" />
                <text x="56" y="312" fill="var(--color-cobalt)" font-family="var(--font-mono)" font-size="9"
                    letter-spacing=".12em">04</text>
                <text x="56" y="344" fill="var(--color-ink)" font-family="var(--font-mono)" font-size="13"
                    letter-spacing=".08em">IMPLEMENTASI</text>
                <text x="56" y="364" fill="var(--color-ink-faint)" font-family="var(--font-mono)" font-size="9"
                    letter-spacing=".08em">kode / uji / rilis</text>
            </g>

            <text x="600" y="440" text-anchor="end" fill="var(--color-cobalt)" font-family="var(--font-mono)"
                font-size="9" letter-spacing=".12em">ITERASI BERLANJUT</text>
        </svg>

        <ol class="divide-y divide-line sm:hidden">
            @foreach ([['01', 'Perencanaan', 'kebutuhan / tujuan'], ['02', 'Analisis', 'proses / akar masalah'], ['03', 'Desain', 'arsitektur / UI'], ['04', 'Implementasi', 'kode / uji / rilis']] as [$number, $label, $note])
                <li class="flex items-center justify-between gap-4 px-4 py-3">
                    <span class="font-mono text-[9px] text-cobalt">{{ $number }}</span>
                    <span class="flex-1 font-display text-base font-semibold tracking-[-0.02em]">{{ $label }}</span>
                    <span class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">{{ $note }}</span>
                </li>
            @endforeach
        </ol>
        <p class="border-t border-line px-4 py-3 text-sm leading-relaxed text-ink-soft sm:hidden">
            Umpan balik dari implementasi bisa mengubah analisis atau desain.
        </p>
    </div>

    <div
        class="mt-3 flex flex-wrap items-center gap-x-5 gap-y-2 font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">
        <span class="inline-flex items-center gap-2"><span class="size-2 bg-cobalt" aria-hidden="true"></span>
            Fase</span>
        <span class="inline-flex items-center gap-2"><span class="h-px w-4 bg-line-strong" aria-hidden="true"></span>
            Alur fase</span>
        <span class="inline-flex items-center gap-2"><span class="h-0 w-4 border-t border-dashed border-cobalt"
                aria-hidden="true"></span> Umpan balik</span>
        <span class="ml-auto hidden sm:inline">Fig. 01</span>
    </div>
</div>
