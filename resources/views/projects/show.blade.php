@extends('layouts.public')

@section('title', $project->title . ' — ' . $profile->name)
@section('description', $project->summary)
@section('canonical', route('projects.show', $project))
@section('og_type', 'article')

@push('head')
  <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'CreativeWork',
            'name' => $project->title,
            'description' => $project->summary,
            'datePublished' => $project->published_at?->toIso8601String(),
            'author' => [
                '@type' => 'Person',
                'name' => $profile->name,
                'url' => route('home'),
            ],
            'keywords' => implode(', ', $project->technologies ?? []),
            'url' => route('projects.show', $project),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')
  <section class="paper-grid border-b border-line">
    <div class="mx-auto max-w-360 px-5 py-10 sm:px-8 lg:px-12 lg:py-14">
      <a href="{{ route('projects.index') }}"
        class="inline-flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint transition-colors hover:text-cobalt">
        <span aria-hidden="true">←</span>
        Kembali ke log
      </a>

      <div class="mt-8 grid gap-8 lg:grid-cols-12">
        <div class="lg:col-span-3">
          <div class="flex flex-wrap gap-2">
            <span class="stamp stamp-cobalt">{{ $project->category }}</span>
            @if ($project->is_placeholder)
              <span class="stamp stamp-manila">Contoh</span>
            @endif
          </div>
          <dl class="mt-8 divide-y divide-line border-y border-line">
            <div class="flex items-start justify-between gap-4 py-3">
              <dt class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Entri</dt>
              <dd class="font-mono text-[11px] text-ink">LOG-{{ str_pad((string) $project->id, 3, '0', STR_PAD_LEFT) }}
              </dd>
            </div>
            <div class="flex items-start justify-between gap-4 py-3">
              <dt class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Tahun</dt>
              <dd class="font-mono text-[11px] text-ink">{{ $project->published_at?->format('Y') ?? '—' }}</dd>
            </div>
            <div class="flex items-start justify-between gap-4 py-3">
              <dt class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Status</dt>
              <dd class="font-mono text-[11px] text-ink">{{ $project->isPublished() ? 'Published' : 'Draft' }}</dd>
            </div>
          </dl>
        </div>

        <div class="lg:col-span-9">
          <h1 class="display max-w-[18ch] text-[clamp(2.6rem,5vw,4.8rem)] text-ink">{{ $project->title }}</h1>
          <p class="mt-6 max-w-[62ch] text-lg leading-relaxed text-ink-soft">{{ $project->summary }}</p>

          <div class="mt-8 flex flex-wrap gap-2">
            @foreach ($project->technologies ?? [] as $technology)
              <span
                class="border border-line-strong bg-paper-raised px-2.5 py-1.5 font-mono text-[9px] uppercase tracking-[0.12em] text-ink-soft">
                {{ $technology }}
              </span>
            @endforeach
          </div>

          @if ($project->live_url || $project->repository_url)
            <div class="mt-8 flex flex-wrap gap-3">
              @if ($project->live_url)
                <a href="{{ $project->live_url }}" class="btn btn-primary" target="_blank" rel="noopener noreferrer">
                  Lihat hasil
                  <span aria-hidden="true">↗</span>
                </a>
              @endif
              @if ($project->repository_url)
                <a href="{{ $project->repository_url }}" class="btn btn-secondary" target="_blank"
                  rel="noopener noreferrer">
                  Repositori
                  <span aria-hidden="true">↗</span>
                </a>
              @endif
            </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <section class="border-b border-line bg-paper-raised">
    <div class="mx-auto max-w-360 px-5 py-8 sm:px-8 lg:px-12 lg:py-10">
      @if ($project->is_placeholder)
        <div
          class="mb-6 flex flex-col gap-3 border border-manila-deep bg-manila/50 px-4 py-3 sm:flex-row sm:items-center sm:justify-between">
          <p class="max-w-[70ch] text-sm leading-relaxed text-ink-soft">
            <strong class="text-ink">Project contoh.</strong> Entri ini bukan klaim pekerjaan nyata. Kontennya disediakan
            untuk mengisi tampilan awal dan bisa diganti sepenuhnya melalui admin.
          </p>
          <span class="stamp stamp-manila w-fit">Placeholder</span>
        </div>
      @endif

      <figure>
        <x-project-plate :project="$project" ratio="aspect-[16/8]" class="max-h-155" />
        <figcaption
          class="mt-3 flex flex-col gap-2 font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint sm:flex-row sm:items-center sm:justify-between">
          <span>Fig. {{ str_pad((string) $project->id, 2, '0', STR_PAD_LEFT) }} — diagram alur sistem</span>
          <span>{{ $project->category }} / {{ $project->published_at?->format('Y') ?? '—' }}</span>
        </figcaption>
      </figure>
    </div>
  </section>

  <section class="border-b border-line">
    <div class="mx-auto max-w-360 px-5 py-14 sm:px-8 lg:px-12 lg:py-20">
      <div class="grid gap-12 lg:grid-cols-12">
        <aside class="lg:col-span-3">
          <div class="lg:sticky lg:top-28">
            <p class="eyebrow">Lembar data</p>
            <dl class="mt-4 divide-y divide-line border-y border-line">
              <div class="py-3">
                <dt class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Peran</dt>
                <dd class="mt-1 text-sm text-ink">Full-stack developer</dd>
              </div>
              <div class="py-3">
                <dt class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Kategori</dt>
                <dd class="mt-1 text-sm text-ink">{{ $project->category }}</dd>
              </div>
              <div class="py-3">
                <dt class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Stack</dt>
                <dd class="mt-1 text-sm leading-relaxed text-ink">{{ implode(', ', $project->technologies ?? []) }}</dd>
              </div>
              <div class="py-3">
                <dt class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Publikasi</dt>
                <dd class="mt-1 text-sm text-ink">
                  {{ $project->published_at?->translatedFormat('d F Y') ?? 'Belum dipublikasikan' }}</dd>
              </div>
            </dl>
            <a href="{{ route('contact.create') }}"
              class="mt-6 inline-flex items-center gap-2 border-b border-ink pb-1 font-mono text-[10px] uppercase tracking-[0.14em] text-ink transition-colors hover:border-cobalt hover:text-cobalt">
              Diskusikan project serupa
              <span aria-hidden="true">→</span>
            </a>
          </div>
        </aside>

        <div class="lg:col-span-9">
          @if ($project->problem_statement)
            <section>
              <div class="flex items-baseline gap-4 border-b border-ink pb-3">
                <span class="font-mono text-[10px] tracking-[0.14em] text-cobalt">01</span>
                <h2 class="font-display text-2xl font-semibold tracking-[-0.03em] text-ink">Masalah</h2>
              </div>
              <div class="prose-log mt-5">
                @foreach (preg_split('/\R\R+/', $project->problem_statement) as $paragraph)
                  <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                @endforeach
              </div>
            </section>
          @endif

          @if ($project->solution)
            <section class="mt-14">
              <div class="flex items-baseline gap-4 border-b border-ink pb-3">
                <span class="font-mono text-[10px] tracking-[0.14em] text-cobalt">02</span>
                <h2 class="font-display text-2xl font-semibold tracking-[-0.03em] text-ink">Pendekatan</h2>
              </div>
              <div class="prose-log mt-5">
                @foreach (preg_split('/\R\R+/', $project->solution) as $paragraph)
                  <p>{!! nl2br(e(trim($paragraph))) !!}</p>
                @endforeach
              </div>
            </section>
          @endif

          @if (!empty($project->features))
            <section class="mt-14">
              <div class="flex items-baseline gap-4 border-b border-ink pb-3">
                <span class="font-mono text-[10px] tracking-[0.14em] text-cobalt">03</span>
                <h2 class="font-display text-2xl font-semibold tracking-[-0.03em] text-ink">Yang dibangun</h2>
              </div>
              <ul class="mt-5 grid gap-x-8 gap-y-3 sm:grid-cols-2">
                @foreach ($project->features as $feature)
                  <li class="flex items-start gap-3 border-t border-line pt-3 text-sm leading-relaxed text-ink-soft">
                    <span class="mt-0.5 font-mono text-[10px] text-cobalt" aria-hidden="true">+</span>
                    <span>{{ $feature }}</span>
                  </li>
                @endforeach
              </ul>
            </section>
          @endif

          <section class="mt-14">
            <div class="flex items-baseline gap-4 border-b border-ink pb-3">
              <span class="font-mono text-[10px] tracking-[0.14em] text-cobalt">04</span>
              <h2 class="font-display text-2xl font-semibold tracking-[-0.03em] text-ink">Catatan teknis</h2>
            </div>
            <div class="prose-log mt-5">
              @foreach (preg_split('/\R\R+/', $project->description) as $paragraph)
                <p>{!! nl2br(e(trim($paragraph))) !!}</p>
              @endforeach
            </div>
          </section>

          @if ($project->images->isNotEmpty())
            <section class="mt-14">
              <div class="flex items-baseline gap-4 border-b border-ink pb-3">
                <span class="font-mono text-[10px] tracking-[0.14em] text-cobalt">05</span>
                <h2 class="font-display text-2xl font-semibold tracking-[-0.03em] text-ink">Galeri</h2>
              </div>
              <div class="mt-8 grid gap-8 sm:grid-cols-2">
                @foreach ($project->images as $image)
                  <figure class="tape">
                    <img src="{{ $image->url }}" alt="{{ $image->alt_text ?: 'Gambar project ' . $project->title }}"
                      class="w-full border border-line bg-paper-deep object-cover" loading="lazy">
                    @if ($image->alt_text)
                      <figcaption class="mt-3 font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">
                        {{ $image->alt_text }}</figcaption>
                    @endif
                  </figure>
                @endforeach
              </div>
            </section>
          @endif
        </div>
      </div>
    </div>
  </section>

  @if ($related->isNotEmpty())
    <section class="border-b border-line bg-paper-raised">
      <div class="mx-auto max-w-360 px-5 py-14 sm:px-8 lg:px-12 lg:py-20">
        <div class="grid gap-8 lg:grid-cols-12">
          <div class="lg:col-span-3">
            <p class="eyebrow">Entri lain</p>
            <p class="mt-3 max-w-[20ch] text-sm leading-relaxed text-ink-soft">Project lain dengan tingkat detail yang
              sama.</p>
          </div>
          <div class="lg:col-span-9">
            <div class="ledger">
              @foreach ($related as $item)
                <x-project-row :project="$item" :index="$loop->iteration" />
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </section>
  @endif

  <section class="bg-ink text-paper">
    <div
      class="mx-auto flex max-w-360 flex-col gap-6 px-5 py-14 sm:px-8 lg:flex-row lg:items-end lg:justify-between lg:px-12 lg:py-20">
      <div>
        <h2 class="display max-w-[18ch] text-[clamp(2.2rem,4vw,3.6rem)] text-paper">Mari mulai dari masalahnya.</h2>
      </div>
      <a href="{{ route('contact.create') }}"
        class="btn bg-paper-raised text-ink hover:bg-cobalt hover:text-paper-raised">
        Kirim pesan
        <span aria-hidden="true">→</span>
      </a>
    </div>
  </section>
@endsection
