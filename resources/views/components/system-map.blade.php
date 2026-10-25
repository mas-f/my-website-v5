@props(['class' => ''])

<div {{ $attributes->class(['w-full', $class]) }}>
    <div class="flex items-end justify-between gap-4 border-b border-line pb-3">
        <div>
            <p class="eyebrow">System map / request path</p>
            <p class="mt-1 font-mono text-[10px] tracking-[0.08em] text-ink-faint">Satu request, lapisan yang sama.</p>
        </div>
        <button
            type="button"
            class="font-mono text-[9px] uppercase tracking-[0.14em] text-cobalt transition-opacity hover:opacity-70"
            data-replay-diagram="#system-map"
        >
            Ulangi alur ↻
        </button>
    </div>

    <div class="relative mt-4 border border-line bg-paper-raised">
        <svg
            id="system-map"
            viewBox="0 0 640 480"
            class="hidden w-full sm:block"
            role="img"
            aria-labelledby="system-map-title system-map-desc"
        >
            <title id="system-map-title">Alur request Laravel</title>
            <desc id="system-map-desc">Request masuk melalui route, diteruskan ke controller, membaca data dari model dan MySQL, lalu dirender oleh Blade menjadi response.</desc>

            <defs>
                <pattern id="system-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                    <path d="M 20 0 L 0 0 0 20" fill="none" stroke="currentColor" stroke-opacity=".05" stroke-width="1" />
                </pattern>
                <marker id="system-arrow" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
                    <path d="M 0 0 L 10 5 L 0 10 z" fill="currentColor" />
                </marker>
                <marker id="system-arrow-cobalt" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="6" markerHeight="6" orient="auto-start-reverse">
                    <path d="M 0 0 L 10 5 L 0 10 z" fill="var(--color-cobalt)" />
                </marker>
            </defs>

            <rect width="640" height="480" fill="url(#system-grid)" />

            <g class="text-line-strong" font-family="var(--font-mono)" font-size="9" letter-spacing=".12em">
                <text x="24" y="42">HTTP</text>
                <line x1="24" y1="52" x2="616" y2="52" stroke="currentColor" stroke-dasharray="3 6" />
                <text x="24" y="192">APP</text>
                <line x1="24" y1="202" x2="616" y2="202" stroke="currentColor" stroke-dasharray="3 6" />
                <text x="24" y="342">DATA</text>
                <line x1="24" y1="352" x2="616" y2="352" stroke="currentColor" stroke-dasharray="3 6" />
            </g>

            <g fill="none" stroke="currentColor" stroke-width="1.2" class="text-line-strong">
                <path class="diagram-line" pathLength="1" d="M 200 88 H 250" marker-end="url(#system-arrow)" />
                <path class="diagram-line" pathLength="1" d="M 370 88 H 420" marker-end="url(#system-arrow)" />
                <path class="diagram-line" pathLength="1" d="M 510 116 V 210" marker-end="url(#system-arrow)" />
                <path class="diagram-line" pathLength="1" d="M 510 266 V 360" marker-end="url(#system-arrow)" />
                <path class="diagram-line" pathLength="1" d="M 420 88 H 392 V 238 H 370" marker-end="url(#system-arrow)" />
                <path class="diagram-line" pathLength="1" d="M 250 238 H 222 V 388 H 200" marker-end="url(#system-arrow)" />
            </g>

            <g font-family="var(--font-mono)" font-size="9" letter-spacing=".08em" class="text-ink-faint">
                <text x="206" y="79">GET /projects</text>
                <text x="384" y="79">dispatch</text>
                <text x="520" y="168">query</text>
                <text x="520" y="318">rows</text>
                <text x="302" y="230">view</text>
                <text x="160" y="380">html</text>
            </g>

            <g font-family="var(--font-mono)" font-size="12" letter-spacing=".08em" text-anchor="middle">
                <g class="text-ink">
                    <rect x="60" y="60" width="140" height="56" fill="var(--color-paper-raised)" stroke="currentColor" />
                    <text x="130" y="93">REQUEST</text>

                    <rect x="250" y="60" width="120" height="56" fill="var(--color-paper-raised)" stroke="currentColor" />
                    <text x="310" y="93">ROUTE</text>

                    <rect x="420" y="60" width="180" height="56" fill="var(--color-cobalt-wash)" stroke="var(--color-cobalt)" />
                    <text x="510" y="93" fill="var(--color-cobalt-deep)">CONTROLLER</text>

                    <rect x="420" y="210" width="180" height="56" fill="var(--color-paper-raised)" stroke="currentColor" />
                    <text x="510" y="243">MODEL</text>

                    <rect x="420" y="360" width="180" height="56" fill="var(--color-paper-raised)" stroke="currentColor" />
                    <text x="510" y="393">MYSQL</text>

                    <rect x="250" y="210" width="120" height="56" fill="var(--color-paper-raised)" stroke="currentColor" />
                    <text x="310" y="243">BLADE</text>

                    <rect x="60" y="360" width="140" height="56" fill="var(--color-paper-raised)" stroke="currentColor" />
                    <text x="130" y="393">RESPONSE</text>
                </g>
            </g>

            <g class="text-cobalt" font-family="var(--font-mono)" font-size="9" letter-spacing=".12em">
                <text x="468" y="440">200 / TEXT/HTML</text>
            </g>
        </svg>

        <ol class="divide-y divide-line sm:hidden">
            @foreach ([
                ['01', 'Request', 'HTTP'],
                ['02', 'Route', 'web.php'],
                ['03', 'Controller', 'validasi'],
                ['04', 'Model', 'Eloquent'],
                ['05', 'MySQL', 'query'],
                ['06', 'Blade', 'render'],
                ['07', 'Response', 'HTML'],
            ] as [$number, $label, $note])
                <li class="flex items-center justify-between gap-4 px-4 py-3">
                    <span class="font-mono text-[9px] text-cobalt">{{ $number }}</span>
                    <span class="flex-1 font-display text-base font-semibold tracking-[-0.02em]">{{ $label }}</span>
                    <span class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">{{ $note }}</span>
                </li>
            @endforeach
        </ol>
    </div>

    <div class="mt-3 flex flex-wrap items-center gap-x-5 gap-y-2 font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">
        <span class="inline-flex items-center gap-2"><span class="size-2 bg-cobalt" aria-hidden="true"></span> Request aktif</span>
        <span class="inline-flex items-center gap-2"><span class="h-px w-4 bg-line-strong" aria-hidden="true"></span> Alur data</span>
        <span class="ml-auto hidden sm:inline">Fig. 01</span>
    </div>
</div>
