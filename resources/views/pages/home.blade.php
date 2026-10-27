@extends('layouts.public')

@section('title', $profile->name . ' — ' . $profile->role)
@section('description',
  'Portofolio Fikri Amrullah, full-stack developer, di Garut. Membangun web aplikasi dari
  perencanaan, database, hingga antarmuka.')
@section('canonical', route('home'))

@push('head')
  <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $profile->name,
            'jobTitle' => $profile->role,
            'url' => route('home'),
            'email' => 'mailto:'.$profile->email,
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => 'Garut',
                'addressCountry' => 'ID',
            ],
            'sameAs' => array_values(array_filter([$profile->github_url, $profile->linkedin_url])),
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
@endpush

@section('content')
  <section class="paper-grid relative overflow-hidden border-b border-line">
    <div class="mx-auto max-w-360 px-5 sm:px-8 lg:px-12">
      <div class="grid lg:grid-cols-12">
        <div class="border-line py-12 lg:col-span-7 lg:border-r lg:py-16 lg:pr-10 xl:pr-16">
          <div class="flex flex-wrap items-center gap-3">
            <span class="stamp stamp-cobalt">Build log / 001</span>
            <span class="font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">Portofolio
              {{ date('Y') }}</span>
          </div>

          <h1 class="display mt-8 text-[clamp(3.4rem,7vw,6rem)] text-ink">
            Fikri<br>
            <span class="text-cobalt">Amrullah</span>
          </h1>

          <p
            class="mt-8 max-w-[31ch] font-display text-[clamp(1.35rem,2.2vw,1.85rem)] font-medium leading-[1.2] tracking-[-0.03em] text-ink">
            Full-stack developer yang membangun aplikasi web dari antarmuka sampai logika di baliknya.
          </p>

          <p class="mt-5 max-w-[52ch] text-[0.975rem] leading-relaxed text-ink-soft">
            Fokus pada pengembangan Web Aplication dengan data yang rapi, dan pengalaman yang tidak membuat pengguna
            berpikir dua kali. Setiap project disusun sebagai catatan kerja: masalah, pendekatan, dan keputusan teknis.
          </p>

          <div class="mt-9 flex flex-wrap items-center gap-3">
            <a href="#log" class="btn btn-primary cursor-pointer">
              Buka log project
              <span aria-hidden="true">↓</span>
            </a>
            <a href="{{ route('contact.create') }}" class="btn btn-secondary cursor-pointer">Mulai percakapan</a>
            @if ($profile->hasCv())
              <a href="{{ $profile->cv_url }}" class="btn btn-secondary cursor-pointer" download>Unduh CV</a>
            @endif
          </div>

          <div class="mt-12 grid grid-cols-2 border-t border-line sm:grid-cols-4">
            @foreach (['Laravel', 'React', 'Next.js', 'Git'] as $technology)
              <div
                class="border-b border-line py-3 pr-3 sm:border-b-0 sm:border-r sm:pl-4 sm:first:pl-0 sm:last:border-r-0">
                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Technology</p>
                <p class="mt-1 text-sm text-ink">{{ $technology }}</p>
              </div>
            @endforeach
          </div>
        </div>

        <div class="border-line py-10 lg:col-span-5 lg:py-16 lg:pl-10 xl:pl-14">
          <x-profile-photo :profile="$profile" />
        </div>
      </div>

      <div
        class="flex flex-col gap-2 border-t border-line py-4 font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint sm:flex-row sm:items-center sm:justify-between">
        <p>01 / Beranda</p>
        <p>{{ $profile->location }} — {{ now()->translatedFormat('F Y') }}</p>
        <p>Halaman 01 dari 05</p>
      </div>
    </div>
  </section>

  <section id="log" class="border-b border-line bg-paper-raised">
    <div class="mx-auto max-w-360 px-5 py-16 sm:px-8 lg:px-12 lg:py-24">
      <div class="grid gap-10 lg:grid-cols-12 lg:gap-8">
        <div class="lg:col-span-3">
          <div class="lg:sticky lg:top-28">
            <p class="eyebrow">01 / Log project</p>
            <p class="mt-3 max-w-[24ch] text-sm leading-relaxed text-ink-soft">
              Setiap proyek yang dikembangkan merupakan bukti nyata dari proses belajar melalui praktik langsung.
            </p>
            <a href="{{ route('projects.index') }}"
              class="mt-6 inline-flex items-center gap-2 border-b border-ink pb-1 font-mono text-[10px] uppercase tracking-[0.14em] text-ink transition-colors hover:border-cobalt hover:text-cobalt cursor-pointer">
              Lihat semua project
              <span aria-hidden="true">→</span>
            </a>
          </div>
        </div>

        <div class="lg:col-span-9">
          <div class="flex flex-wrap items-end justify-between gap-4 border-b border-ink pb-5">
            <h2 class="display text-[clamp(2.4rem,4.5vw,4rem)] text-ink">Catatan pekerjaan.</h2>
            <p class="max-w-[26ch] pb-1 text-sm leading-relaxed text-ink-soft">
              Setiap studi kasus harus bisa menyelesaikan masalah, solusi yang tepat digunakan dan peningkatkan apa yang
              ingin dicapai.
            </p>
          </div>

          <div class="ledger border-t-0">
            @forelse ($projects as $project)
              <x-project-row :project="$project" :index="$loop->iteration" />
            @empty
              <div class="border-b border-line py-14">
                <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">Belum ada entri</p>
                <p class="mt-3 max-w-lg text-lg text-ink-soft">Project yang sudah dipublikasikan akan muncul di sini.</p>
              </div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="border-b border-line">
    <div class="mx-auto max-w-360 px-5 py-16 sm:px-8 lg:px-12 lg:py-24">
      <div class="grid gap-10 lg:grid-cols-12 lg:gap-8">
        <div class="lg:col-span-3">
          <div class="lg:sticky lg:top-28">
            <p class="eyebrow">02 / Cara kerja</p>
            <p class="mt-3 max-w-[26ch] text-sm leading-relaxed text-ink-soft">
              Empat fase yang bisa diperiksa, dari perencanaan sampai implementasi.
            </p>
          </div>
        </div>

        <div class="lg:col-span-9">
          <h2 class="display max-w-[16ch] text-[clamp(2.4rem,4.5vw,4rem)] text-ink">Dari masalah ke sistem.</h2>

          @php
            $phases = [
                [
                    '01',
                    'Perencanaan',
                    [
                        'Menganalisis kebutuhan pengguna',
                        'Merumuskan masalah yang ingin diselesaikan',
                        'Memahami proses bisnis yang berjalan',
                        'Menetapkan tujuan yang ingin dicapai',
                    ],
                ],
                [
                    '02',
                    'Analisis',
                    [
                        'Memetakan proses bisnis saat ini',
                        'Mencari akar masalah',
                        'Menentukan kebutuhan pengguna, baik fungsional maupun non-fungsional',
                    ],
                ],
                [
                    '03',
                    'Desain',
                    [
                        'Merancang arsitektur sistem',
                        'Merancang basis data',
                        'Membuat tampilan antarmuka (UI)',
                        'Menentukan spesifikasi perangkat lunak dan perangkat keras',
                    ],
                ],
                [
                    '04',
                    'Implementasi',
                    [
                        'Menulis kode sesuai rancangan',
                        'Menguji untuk menemukan bug atau kesalahan fungsi',
                        'Melakukan instalasi dan penerapan sistem baru menggantikan sistem lama',
                        'Melatih pengguna agar sistem dapat dioperasikan dengan baik',
                    ],
                ],
            ];
          @endphp

          <ol class="mt-10 list-none border-t border-ink">
            @foreach ($phases as [$number, $title, $bullets])
              <li class="grid gap-4 border-b border-line py-6 sm:grid-cols-12 sm:gap-6">
                <p class="font-mono text-[10px] tracking-[0.14em] text-cobalt sm:col-span-2">{{ $number }}</p>
                <h3 class="font-display text-xl font-semibold tracking-[-0.03em] text-ink sm:col-span-3">
                  {{ $title }}</h3>
                <ul class="space-y-2 sm:col-span-7">
                  @foreach ($bullets as $bullet)
                    <li class="flex gap-2.5 text-sm leading-relaxed text-ink-soft">
                      <span class="mt-2 size-1 shrink-0 bg-cobalt" aria-hidden="true"></span>
                      <span>{{ $bullet }}</span>
                    </li>
                  @endforeach
                </ul>
              </li>
            @endforeach
          </ol>

          <x-system-map class="mt-12 max-w-4xl" />
        </div>
      </div>
    </div>
  </section>

  <section class="border-b border-line bg-paper-raised">
    <div class="mx-auto max-w-360 px-5 py-16 sm:px-8 lg:px-12 lg:py-24">
      <div class="grid gap-10 lg:grid-cols-12 lg:gap-8">
        <div class="lg:col-span-3">
          <div class="lg:sticky lg:top-28">
            <p class="eyebrow">03 / Profil</p>
            <p class="mt-3 max-w-[22ch] text-sm leading-relaxed text-ink-soft">
              Sedikit konteks tentang cara berpikir dan alat yang dipakai.
            </p>
          </div>
        </div>

        <div class="lg:col-span-9">
          <div class="grid gap-10 lg:grid-cols-12">
            <div class="lg:col-span-7">
              <h2 class="display max-w-[15ch] text-[clamp(2.4rem,4.5vw,4rem)] text-ink">Tenang di permukaan, rapi di
                belakang.</h2>
              <p class="mt-6 max-w-[58ch] text-base leading-relaxed text-ink-soft">
                Saya tertarik membangun aplikasi yang tidak hanya berfungsi hari ini, tetapi juga tetap mudah dipahami
                dan dikembangkan di kemudian hari. Bagi saya, kualitas software bukan sekedar fitur yang berhasil
                dibuat, melainkan juga fitur tersebut harus bisa digunakan oleh user dengan baik dan semaksimal mungkin.
              </p>
              <a href="{{ route('about') }}"
                class="mt-6 inline-flex items-center gap-2 border-b border-ink pb-1 font-mono text-[10px] uppercase tracking-[0.14em] text-ink transition-colors hover:border-cobalt hover:text-cobalt cursor-pointer">
                Baca profil lengkap
                <span aria-hidden="true">→</span>
              </a>
            </div>

            <div class="lg:col-span-5">
              <div class="sheet-flat">
                <div class="border-b border-line bg-paper-deep px-4 py-3">
                  <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Lembar data</p>
                </div>
                <dl class="divide-y divide-line">
                  @foreach ([['Nama', $profile->name], ['Peran', $profile->role], ['Lokasi', $profile->location], ['Fokus', 'Laravel / React / Next.js / Git']] as [$label, $value])
                    <div class="flex items-start justify-between gap-4 px-4 py-3">
                      <dt class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">{{ $label }}
                      </dt>
                      <dd class="text-right text-sm text-ink">{{ $value }}</dd>
                    </div>
                  @endforeach
                </dl>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-ink text-paper">
    <div class="mx-auto max-w-360 px-5 py-16 sm:px-8 lg:px-12 lg:py-24">
      <div class="grid gap-10 lg:grid-cols-12 lg:items-end">
        <div class="lg:col-span-8">
          <h2 class="display max-w-[16ch] text-[clamp(2.6rem,5vw,4.8rem)] text-paper">
            Punya masalah yang perlu dirapikan?
          </h2>
        </div>
        <div class="lg:col-span-4">
          <p class="font-mono text-[10px] uppercase tracking-[0.16em] text-paper/60">04 / Kontak</p>
          <p class="mt-4 max-w-[34ch] text-sm leading-relaxed text-paper/70">
            Ceritakan konteks, batasan, dan hasil yang ingin dicapai. Saya akan membaca pesan Anda dari panel yang sama
            dengan yang mengelola situs ini.
          </p>
          <div class="mt-6 flex flex-wrap gap-3">
            <a href="{{ route('contact.create') }}"
              class="btn bg-paper-raised text-ink hover:bg-cobalt hover:text-paper-raised cursor-pointer">
              Kirim pesan
              <span aria-hidden="true">→</span>
            </a>
            <a href="mailto:{{ $profile->email }}"
              class="btn border-paper/30 text-paper hover:border-paper hover:bg-paper hover:text-ink cursor-pointer">
              Email langsung
            </a>
          </div>
        </div>
      </div>

      <div
        class="mt-14 flex flex-col gap-2 border-t border-paper/20 pt-5 font-mono text-[9px] uppercase tracking-[0.14em] text-paper/50 sm:flex-row sm:items-center sm:justify-between">
        <p>{{ $profile->email }}</p>
        <p>{{ $profile->location }}</p>
        <p>Build log — {{ date('Y') }}</p>
      </div>
    </div>
  </section>
@endsection
