@extends('layouts.public')

@section('title', 'Project — ' . $profile->name)
@section('description', 'Catatan project Fikri Amrullah: masalah, pendekatan, keputusan teknis, dan hal yang dibangun.')
@section('canonical', route('projects.index'))

@section('content')
  <section class="paper-grid border-b border-line">
    <div class="mx-auto max-w-360 px-5 py-14 sm:px-8 lg:px-12 lg:py-20">
      <div class="grid gap-8 lg:grid-cols-12">
        <div class="lg:col-span-3">
          <p class="eyebrow">02 / Log project</p>
          <p class="mt-3 max-w-[22ch] text-sm leading-relaxed text-ink-soft">
            Kumpulan entri kerja. Disaring berdasarkan kategori, bukan diurutkan berdasarkan kesan.
          </p>
        </div>
        <div class="lg:col-span-9">
          <h1 class="display text-[clamp(3.2rem,6vw,5.5rem)] text-ink">Log project.</h1>
          <div class="mt-6 flex flex-col gap-4 border-t border-ink pt-4 sm:flex-row sm:items-start sm:justify-between">
            <p class="max-w-[58ch] text-base leading-relaxed text-ink-soft">
              Setiap entri menjelaskan konteks masalah, pendekatan yang dipilih, dan bagian yang bisa diperiksa. Project
              contoh ditandai dengan jelas dan bisa diganti melalui admin.
            </p>
            <p class="shrink-0 font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">
              {{ $projects->count() }} entri / {{ now()->format('Y') }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-paper-raised">
    <div class="mx-auto max-w-360 px-5 py-10 sm:px-8 lg:px-12 lg:py-14">
      <div class="grid gap-8 lg:grid-cols-12">
        <div class="lg:col-span-3">
          <div class="lg:sticky lg:top-28">
            <p class="eyebrow">Filter</p>
            <div class="mt-4 flex flex-wrap gap-2 lg:flex-col lg:items-start" data-project-filters>
              <button type="button" data-filter="all" aria-pressed="true" class="filter-chip cursor-pointer">
                Semua
              </button>
              @foreach ($categories as $category)
                <button type="button" data-filter="{{ $category->slug }}" aria-pressed="false" class="filter-chip cursor-pointer">
                  {{ $category->name }}
                </button>
              @endforeach
            </div>
            <p class="mt-6 hidden max-w-[20ch] text-sm leading-relaxed text-ink-faint lg:block">
              Filter bekerja tanpa memuat ulang halaman.
            </p>
          </div>
        </div>

        <div class="lg:col-span-9">
          <div class="ledger">
            @forelse ($projects as $project)
              <x-project-row :project="$project" :index="$loop->iteration" />
            @empty
              <div class="border-b border-line py-16">
                <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">Belum ada project</p>
                <p class="mt-3 max-w-lg text-lg text-ink-soft">Project yang sudah dipublikasikan akan muncul di sini.</p>
              </div>
            @endforelse
          </div>

          <div class="border border-line bg-paper-deep px-5 py-10 text-center" data-filter-empty hidden>
            <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">Tidak ada hasil</p>
            <p class="mt-2 text-sm text-ink-soft">Coba pilih kategori lain.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="border-t border-line">
    <div
      class="mx-auto flex max-w-360 flex-col gap-4 px-5 py-10 sm:px-8 lg:flex-row lg:items-center lg:justify-between lg:px-12">
      <p class="max-w-[48ch] text-sm leading-relaxed text-ink-soft">
        Ingin membahas pendekatan untuk project Anda sendiri?
      </p>
      <a href="{{ route('contact.create') }}" class="btn btn-primary w-fit cursor-pointer">
        Mulai percakapan
        <span aria-hidden="true">→</span>
      </a>
    </div>
  </section>
@endsection
