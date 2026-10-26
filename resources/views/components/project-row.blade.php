@props(['project', 'index'])

<article class="ledger-row group grid-cols-12 items-start gap-y-5 sm:gap-x-6" data-project-row
  data-category="{{ $project->category?->slug }}">
  <div class="col-span-12 flex items-center justify-between sm:col-span-1 sm:block">
    <span
      class="font-mono text-[11px] tracking-[0.16em] text-cobalt">{{ str_pad((string) $index, 2, '0', STR_PAD_LEFT) }}</span>
    <span
      class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint sm:mt-2 sm:block">{{ $project->published_at?->format('Y') ?? '—' }}</span>
  </div>

  <div class="col-span-12 sm:col-span-7">
    <div class="flex flex-wrap items-center gap-2">
      <span class="stamp stamp-cobalt">{{ $project->category?->name ?? 'Tanpa kategori' }}</span>
      @if ($project->is_placeholder)
        <span class="stamp stamp-manila">Contoh</span>
      @endif
      @if ($project->is_featured)
        <span class="stamp stamp-success">Pilihan</span>
      @endif
    </div>

    <h3 class="display mt-3 text-[clamp(1.7rem,3vw,2.6rem)] text-ink">
      <a href="{{ route('projects.show', $project) }}" class="transition-colors group-hover:text-cobalt cursor-pointer">
        {{ $project->title }}
      </a>
    </h3>

    <p class="mt-3 max-w-2xl text-sm leading-relaxed text-ink-soft">{{ $project->summary }}</p>

    <div
      class="mt-4 flex flex-wrap items-center gap-x-3 gap-y-1 font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">
      @foreach (array_slice($project->technologies ?? [], 0, 4) as $technology)
        <span>{{ $technology }}</span>
        @if (!$loop->last)
          <span class="text-line-strong" aria-hidden="true">/</span>
        @endif
      @endforeach
    </div>

    <a href="{{ route('projects.show', $project) }}"
      class="mt-5 inline-flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.14em] text-ink transition-colors group-hover:text-cobalt cursor-pointer">
      Baca entri
      <span aria-hidden="true" class="transition-transform group-hover:translate-x-1">→</span>
    </a>
  </div>

  <div class="col-span-12 sm:col-span-4">
    <a href="{{ route('projects.show', $project) }}"
      class="block transition-transform duration-300 group-hover:-translate-y-1 cursor-pointer" tabindex="-1"
      aria-hidden="true">
      <x-project-plate :project="$project" :index="$index" compact />
    </a>
  </div>
</article>
