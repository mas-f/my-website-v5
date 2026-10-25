@props(['project', 'index' => null, 'compact' => false, 'ratio' => 'aspect-[4/3]'])

@php
    $plateNumber = $index !== null ? str_pad((string) $index, 2, '0', STR_PAD_LEFT) : str_pad((string) $project->id, 2, '0', STR_PAD_LEFT);
    $technologies = $project->technologies ?? [];
@endphp

<div {{ $attributes->class(['plate group/plate w-full', $ratio]) }}>
    @if ($project->thumbnail_url)
        <img
            src="{{ $project->thumbnail_url }}"
            alt="Thumbnail {{ $project->title }}"
            class="absolute inset-0 h-full w-full object-cover"
            loading="lazy"
        >
    @else
        <svg
            viewBox="0 0 480 360"
            class="absolute inset-0 h-full w-full text-ink"
            role="img"
            aria-label="Diagram sistem contoh untuk {{ $project->title }}"
        >
            <title>Diagram sistem {{ $project->title }}</title>
            <defs>
                <pattern id="plate-grid-{{ $project->id }}" width="18" height="18" patternUnits="userSpaceOnUse">
                    <path d="M 18 0 L 0 0 0 18" fill="none" stroke="currentColor" stroke-opacity=".08" stroke-width="1" />
                </pattern>
                <marker id="plate-arrow-{{ $project->id }}" viewBox="0 0 10 10" refX="8" refY="5" markerWidth="5" markerHeight="5" orient="auto-start-reverse">
                    <path d="M 0 0 L 10 5 L 0 10 z" fill="currentColor" />
                </marker>
            </defs>

            <rect width="480" height="360" fill="url(#plate-grid-{{ $project->id }})" />

            <g class="text-line-strong" fill="none" stroke="currentColor" stroke-width="1">
                <path d="M118 92 H164" marker-end="url(#plate-arrow-{{ $project->id }})" />
                <path d="M274 92 H326" marker-end="url(#plate-arrow-{{ $project->id }})" />
                <path d="M386 116 V176" marker-end="url(#plate-arrow-{{ $project->id }})" />
                <path d="M386 216 V276" marker-end="url(#plate-arrow-{{ $project->id }})" />
                <path d="M326 92 H302 V196 H274" marker-end="url(#plate-arrow-{{ $project->id }})" />
                <path d="M164 196 H140 V296 H118" marker-end="url(#plate-arrow-{{ $project->id }})" />
            </g>

            <g font-family="var(--font-mono)" font-size="11" letter-spacing=".08em" text-anchor="middle">
                <g class="text-ink">
                    <rect x="16" y="70" width="102" height="44" fill="var(--color-paper-raised)" stroke="currentColor" />
                    <text x="67" y="97">REQUEST</text>

                    <rect x="164" y="70" width="110" height="44" fill="var(--color-paper-raised)" stroke="currentColor" />
                    <text x="219" y="97">ROUTE</text>

                    <rect x="326" y="70" width="120" height="46" fill="var(--color-cobalt-wash)" stroke="var(--color-cobalt)" />
                    <text x="386" y="98" fill="var(--color-cobalt-deep)">CONTROLLER</text>

                    <rect x="326" y="176" width="120" height="40" fill="var(--color-paper-raised)" stroke="currentColor" />
                    <text x="386" y="201">MODEL</text>

                    <rect x="326" y="276" width="120" height="40" fill="var(--color-paper-raised)" stroke="currentColor" />
                    <text x="386" y="301">MYSQL</text>

                    <rect x="164" y="176" width="110" height="40" fill="var(--color-paper-raised)" stroke="currentColor" />
                    <text x="219" y="201">BLADE</text>

                    <rect x="16" y="276" width="102" height="40" fill="var(--color-paper-raised)" stroke="currentColor" />
                    <text x="67" y="301">RESPONSE</text>
                </g>
            </g>

            @if (! $compact)
                <g font-family="var(--font-mono)" font-size="9" letter-spacing=".08em" class="text-ink-faint">
                    <text x="141" y="84">GET</text>
                    <text x="300" y="84">dispatch</text>
                    <text x="394" y="150">query</text>
                    <text x="394" y="250">data</text>
                    <text x="226" y="190">view</text>
                </g>
            @endif
        </svg>
    @endif

    <div class="pointer-events-none absolute inset-x-0 top-0 z-10 flex items-start justify-between gap-3 p-3">
        <span class="border border-line-strong bg-paper-raised px-2 py-1 font-mono text-[9px] uppercase tracking-[0.14em] text-ink-soft">
            Plate {{ $plateNumber }}
        </span>
        <span class="border border-line-strong bg-paper-raised px-2 py-1 font-mono text-[9px] uppercase tracking-[0.14em] text-ink-soft">
            {{ $project->category }}
        </span>
    </div>

    <div class="pointer-events-none absolute inset-x-0 bottom-0 z-10 flex items-center justify-between gap-3 border-t border-line bg-paper-raised/95 px-3 py-2 font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">
        <span class="truncate">{{ $technologies[0] ?? 'Laravel' }}@if (count($technologies) > 1) +{{ count($technologies) - 1 }}@endif</span>
        <span>{{ $project->is_placeholder ? 'Contoh' : 'Log' }}</span>
    </div>
</div>
