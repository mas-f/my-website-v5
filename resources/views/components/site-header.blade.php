@props(['profile'])

@php
  $nav = [
      ['label' => 'Beranda', 'route' => 'home', 'pattern' => 'home'],
      ['label' => 'Tentang', 'route' => 'about', 'pattern' => 'about'],
      ['label' => 'Keahlian', 'route' => 'skills', 'pattern' => 'skills'],
      ['label' => 'Project', 'route' => 'projects.index', 'pattern' => 'projects.*'],
      ['label' => 'Layanan', 'route' => 'services', 'pattern' => 'services'],
      ['label' => 'Kontak', 'route' => 'contact.create', 'pattern' => 'contact.*'],
  ];
@endphp

<header class="sticky top-0 z-40 border-b border-line bg-paper">
  <div class="border-b border-line/80">
    <div class="mx-auto flex max-w-360 items-center justify-between gap-4 px-5 py-2 sm:px-8 lg:px-12">
      <p class="font-mono text-[10px] uppercase tracking-[0.16em] text-ink-faint">
        {{ $profile->location }} <span class="mx-2 text-line-strong">/</span> {{ $profile->role }}
      </p>
      <p class="hidden font-mono text-[10px] uppercase tracking-[0.16em] text-ink-faint sm:block">
        Build log <span class="text-cobalt">001</span> — 2026
      </p>
    </div>
  </div>

  <div class="mx-auto flex max-w-360 items-center justify-between gap-6 px-5 py-4 sm:px-8 lg:px-12">
    <a href="{{ route('home') }}" class="group flex items-center gap-3" aria-label="{{ $profile->name }} — beranda">
      @if ($profile->hasLogo())
        <img src="{{ $profile->logo_url }}" alt=""
          class="size-9 shrink-0 object-contain transition-opacity group-hover:opacity-80">
      @else
        <span
          class="grid size-9 place-items-center border border-ink bg-ink font-mono text-[11px] font-medium tracking-widest text-paper-raised transition-colors group-hover:border-cobalt group-hover:bg-cobalt">
          FA
        </span>
      @endif
      <span class="leading-none">
        <span
          class="block font-display text-[1.05rem] font-semibold tracking-[-0.03em] text-ink">{{ $profile->name }}</span>
        <span class="mt-1 block font-mono text-[9px] uppercase tracking-[0.18em] text-ink-faint">Full-stack
          developer</span>
      </span>
    </a>

    <nav class="hidden items-center gap-7 lg:flex" aria-label="Navigasi utama">
      @foreach ($nav as $item)
        <a href="{{ route($item['route']) }}" class="nav-link"
          @if (request()->routeIs($item['pattern'])) aria-current="page" @endif>
          {{ $item['label'] }}
        </a>
      @endforeach
    </nav>

    <div class="hidden items-center gap-3 lg:flex">
      @if ($profile->hasCv())
        <a href="{{ $profile->cv_url }}" class="btn btn-secondary"
          download="{{ $profile->cv_original_name ?: 'CV-' . $profile->name }}">Unduh CV</a>
      @endif
      <a href="{{ route('contact.create') }}" class="btn btn-primary">
        Mulai percakapan
        <span aria-hidden="true">→</span>
      </a>
    </div>

    <button type="button"
      class="inline-flex items-center gap-2 border border-line-strong px-3 py-2 font-mono text-[10px] uppercase tracking-[0.14em] text-ink lg:hidden"
      data-nav-toggle aria-controls="mobile-nav" aria-expanded="false">
      Menu
      <span class="flex w-4 flex-col gap-1" aria-hidden="true">
        <span class="h-px w-full bg-current"></span>
        <span class="h-px w-full bg-current"></span>
        <span class="h-px w-full bg-current"></span>
      </span>
    </button>
  </div>

  <div id="mobile-nav" class="hidden border-t border-line bg-paper-raised lg:hidden">
    <div class="mx-auto max-w-360 px-5 py-6 sm:px-8">
      <nav class="grid gap-1" aria-label="Navigasi seluler">
        @foreach ($nav as $item)
          <a href="{{ route($item['route']) }}"
            class="flex items-center justify-between border-b border-line py-3 text-lg text-ink"
            @if (request()->routeIs($item['pattern'])) aria-current="page" @endif>
            {{ $item['label'] }}
            <span class="font-mono text-[10px] text-ink-faint">0{{ $loop->iteration }}</span>
          </a>
        @endforeach
      </nav>

      <div class="mt-6 flex flex-wrap gap-3">
        <a href="{{ route('contact.create') }}" class="btn btn-primary">Mulai percakapan</a>
        @if ($profile->hasCv())
          <a href="{{ $profile->cv_url }}" class="btn btn-secondary" download>Unduh CV</a>
        @endif
      </div>

      <div class="mt-6 space-y-1 font-mono text-[10px] uppercase tracking-[0.12em] text-ink-faint">
        <p>{{ $profile->location }}</p>
        <a href="mailto:{{ $profile->email }}" class="link-underline text-cobalt">{{ $profile->email }}</a>
      </div>
    </div>
  </div>
</header>
