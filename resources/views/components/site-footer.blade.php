@props(['profile'])

<footer class="border-t border-line bg-paper-raised">
  <div class="mx-auto max-w-360 px-5 py-14 sm:px-8 lg:px-12 lg:py-20">
    <div class="grid gap-12 lg:grid-cols-12 lg:gap-8">
      <div class="lg:col-span-5">
        <h2 class="display max-w-md text-4xl text-ink sm:text-5xl">
          Mari bangun sesuatu yang jelas.
        </h2>
        <a href="mailto:{{ $profile->email }}"
          class="mt-7 inline-flex items-baseline gap-3 border-b border-ink pb-2 font-display text-xl tracking-[-0.02em] text-ink transition-colors hover:border-cobalt hover:text-cobalt cursor-pointer">
          {{ $profile->email }}
          <span class="font-mono text-xs" aria-hidden="true">↗</span>
        </a>
      </div>

      <div class="grid gap-8 sm:grid-cols-2 lg:col-span-4 lg:col-start-7">
        <div>
          <p class="eyebrow">Indeks</p>
          <nav class="mt-4 grid gap-2 text-sm text-ink-soft" aria-label="Navigasi footer">
            <a href="{{ route('home') }}" class="link-underline w-fit hover:text-ink cursor-pointer">Beranda</a>
            <a href="{{ route('about') }}" class="link-underline w-fit hover:text-ink cursor-pointer">Tentang</a>
            <a href="{{ route('skills') }}" class="link-underline w-fit hover:text-ink cursor-pointer">Keahlian</a>
            <a href="{{ route('projects.index') }}" class="link-underline w-fit hover:text-ink cursor-pointer">Project</a>
            <a href="{{ route('services') }}" class="link-underline w-fit hover:text-ink cursor-pointer">Layanan</a>
            <a href="{{ route('contact.create') }}" class="link-underline w-fit hover:text-ink cursor-pointer">Kontak</a>
          </nav>
        </div>

        <div>
          <p class="eyebrow">Tautan</p>
          <div class="mt-4 grid gap-2 text-sm text-ink-soft">
            <a href="{{ $profile->github_url }}" class="link-underline w-fit hover:text-ink cursor-pointer" rel="noopener noreferrer"
              target="_blank">GitHub ↗</a>
            @if ($profile->linkedin_url)
              <a href="{{ $profile->linkedin_url }}" class="link-underline w-fit hover:text-ink cursor-pointer"
                rel="noopener noreferrer" target="_blank">LinkedIn ↗</a>
            @endif
            @if ($profile->hasCv())
              <a href="{{ $profile->cv_url }}" class="link-underline w-fit hover:text-ink cursor-pointer" download>Unduh CV</a>
            @else
              <span class="w-fit text-ink-faint" title="CV belum diunggah">CV belum tersedia</span>
            @endif
          </div>
        </div>
      </div>

      <div class="lg:col-span-2 lg:col-start-11">
        <p class="eyebrow">Lokasi</p>
        <p class="mt-4 text-sm text-ink-soft">{{ $profile->location }}</p>
        <p class="mt-2 font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">WIB / UTC+7</p>
      </div>
    </div>

    <div
      class="mt-14 flex flex-col gap-3 border-t border-line pt-5 font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint sm:flex-row sm:items-center sm:justify-between">
      <p>© {{ date('Y') }} {{ $profile->name }}. Semua hak dilindungi.</p>
      {{-- <p>Dibangun dengan Laravel, Blade, Tailwind CSS, dan MySQL.</p> --}}
      <p>Dibangun oleh Fikri Amrullah dengan Cinta 💖.</p>
    </div>
  </div>
</footer>
