@extends('layouts.public')

@section('title', 'Tentang — ' . $profile->name)
@section('description',
  'Tentang Fikri Amrullah, full-stack developer di Garut yang berfokus pada aplikasi web Laravel
  dan antarmuka yang jelas.')
@section('canonical', route('about'))

@section('content')
  <section class="paper-grid border-b border-line">
    <div class="mx-auto max-w-360 px-5 py-14 sm:px-8 lg:px-12 lg:py-20">
      <div class="grid gap-8 lg:grid-cols-12">
        <div class="lg:col-span-3">
          <p class="eyebrow">01 / Profil</p>
          <p class="mt-3 max-w-[22ch] text-sm leading-relaxed text-ink-soft">
            Konteks singkat tentang peran, cara kerja, dan hal yang sedang dipelajari.
          </p>
        </div>
        <div class="lg:col-span-9">
          <h1 class="display max-w-[17ch] text-[clamp(3rem,5.5vw,5.2rem)] text-ink">Membangun dengan struktur, bukan
            tebakan.</h1>
          <p class="mt-6 max-w-[62ch] text-lg leading-relaxed text-ink-soft">
            Saya {{ $profile->name }}, memiliki minat dalam bidang full-stack developer dan saya berasal dari
            {{ $profile->location }}. Saya membangun aplikasi web dengan Laravel, React, Next.js, MySQL, dan Tailwind CSS.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="border-b border-line bg-paper-raised">
    <div class="mx-auto max-w-360 px-5 py-14 sm:px-8 lg:px-12 lg:py-20">
      <div class="grid gap-12 lg:grid-cols-12">
        <div class="lg:col-span-3">
          <div class="lg:sticky lg:top-28">
            <p class="eyebrow">Cara berpikir</p>
            <p class="mt-3 max-w-[22ch] text-sm leading-relaxed text-ink-soft">
              Tiga hal yang selalu saya cek sebelum menambah fitur.
            </p>
          </div>
        </div>

        <div class="lg:col-span-9">
          <div class="grid gap-12 lg:grid-cols-12">
            <div class="lg:col-span-7">
              <div class="prose-log">
                <p>
                  Saya tertarik membangun aplikasi yang tidak hanya berfungsi hari ini, tetapi juga tetap mudah dipahami
                  dan dikembangkan di kemudian hari. Bagi saya, kualitas software bukan sekedar fitur yang berhasil
                  dibuat, melainkan juga fitur tersebut harus bisa digunakan oleh user dengan baik dan semaksimal mungkin.
                </p>
                <p>
                  Sebagian besar pekerjaan saya berada di sisi server, mulai dari merancang arsitektur sistem, membuat
                  struktur database, menerapkan validasi, autentikasi dan otorisasi, hingga memastikan data diproses
                  sesuai kebutuhan. Di sisi antarmuka, saya biasa menggunakan Laravel, React atau Next.js dan styling
                  menggunakan Tailwind ataupun Bootstrap agar halaman tetap responsif, ringan, dan mudah dirawat.
                </p>
                <p>
                  Portfolio ini juga menjadi bagian dari proses pengembangan dan penerapan prinsip tersebut. Saya berusaha
                  memastikan bahwa setiap fitur yang dikembangkan memiliki fungsi yang jelas, setiap data ditangani dengan
                  benar, dan setiap keputusan teknis memiliki alasan. Bagi saya, aplikasi yang baik bukan hanya terlihat
                  meyakinkan, tetapi juga dapat digunakan dan dipelihara dengan baik.
                </p>
              </div>

              <div class="mt-10 border-t border-ink pt-5">
                <h2 class="font-display text-2xl font-semibold tracking-[-0.03em] text-ink">Fokus saat ini</h2>
                <div class="mt-5 grid gap-4 sm:grid-cols-3">
                  @foreach ([['Web Aplikasi', 'Alur server yang jelas dan bisa diuji.'], ['Panel admin', 'Kontrol konten yang aman dan tidak menyulitkan.'], ['Kualitas antarmuka', 'Hierarki, aksesibilitas, dan performa.']] as [$title, $body])
                    <div class="border-t border-line pt-3">
                      <h3 class="text-sm font-semibold text-ink">{{ $title }}</h3>
                      <p class="mt-1 text-sm leading-relaxed text-ink-soft">{{ $body }}</p>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>

            <div class="lg:col-span-5">
              <div class="sheet-flat">
                <div class="flex items-center justify-between border-b border-line bg-paper-deep px-4 py-3">
                  <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Lembar data</p>
                  <span class="stamp stamp-cobalt">Profil</span>
                </div>
                <dl class="divide-y divide-line">
                  @foreach ([['Nama', $profile->name], ['Peran', $profile->role], ['Lokasi', $profile->location], ['Email', $profile->email], ['GitHub', $profile->github_url]] as [$label, $value])
                    <div class="px-4 py-3">
                      <dt class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">{{ $label }}</dt>
                      <dd class="mt-1 wrap-break-word text-sm text-ink">{{ $value }}</dd>
                    </div>
                  @endforeach
                </dl>
                <div class="border-t border-line px-4 py-3">
                  <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">CV</p>
                  @if ($profile->hasCv())
                    <a href="{{ $profile->cv_url }}"
                      class="mt-1 inline-flex items-center gap-2 text-sm text-cobalt hover:underline cursor-pointer" download>
                      Unduh CV
                      <span aria-hidden="true">↓</span>
                    </a>
                  @else
                    <p class="mt-1 text-sm text-ink-faint">Belum diunggah. Tautan akan muncul setelah file tersedia.</p>
                  @endif
                </div>
              </div>

              <div class="mt-6 border-t border-cobalt pt-4">
                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-cobalt">Catatan</p>
                <p class="mt-2 text-sm leading-relaxed text-ink-soft">
                  Setiap fitur harus punya tujuan, setiap interaksi harus bekerja, dan setiap data harus ditangani dengan
                  benar.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="border-b border-line">
    <div class="mx-auto max-w-360 px-5 py-14 sm:px-8 lg:px-12 lg:py-20">
      <div class="grid gap-8 lg:grid-cols-12">
        <div class="lg:col-span-3">
          <p class="eyebrow">Prinsip kerja</p>
        </div>
        <div class="lg:col-span-9">
          <div class="grid gap-8 sm:grid-cols-3">
            @foreach ([['01', 'Jelas sebelum pintar', 'Struktur yang mudah dibaca lebih berharga daripada abstraksi yang belum dibutuhkan.'], ['02', 'Server yang menjaga', 'Validasi dan otorisasi tidak boleh bergantung pada tampilan atau niat pengguna.'], ['03', 'Kecil dan teruji', 'Perubahan kecil dengan alur utama yang diuji lebih mudah dirilis dan dipulihkan.']] as [$number, $title, $body])
              <div class="border-t border-ink pt-4">
                <p class="font-mono text-[10px] tracking-[0.14em] text-cobalt">{{ $number }}</p>
                <h2 class="mt-3 font-display text-xl font-semibold tracking-[-0.03em] text-ink">{{ $title }}</h2>
                <p class="mt-2 text-sm leading-relaxed text-ink-soft">{{ $body }}</p>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-ink text-paper">
    <div
      class="mx-auto flex max-w-360 flex-col gap-6 px-5 py-14 sm:px-8 lg:flex-row lg:items-end lg:justify-between lg:px-12 lg:py-20">
      <div>
        <h2 class="display max-w-[18ch] text-[clamp(2.2rem,4vw,3.6rem)] text-paper">Lihat bagaimana saya bekerja.</h2>
      </div>
      <div class="flex flex-wrap gap-3">
        <a href="{{ route('projects.index') }}"
          class="btn bg-paper-raised text-ink hover:bg-cobalt hover:text-paper-raised cursor-pointer">Buka log project</a>
        <a href="{{ route('contact.create') }}"
          class="btn border-paper/30 text-paper hover:border-paper hover:bg-paper hover:text-ink cursor-pointer">Hubungi saya</a>
      </div>
    </div>
  </section>
@endsection
