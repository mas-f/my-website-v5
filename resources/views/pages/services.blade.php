@extends('layouts.public')

@section('title', 'Layanan — ' . $profile->name)
@section('description', 'Layanan pengembangan aplikasi web Laravel, perbaikan, company profile, dan konsultasi teknis
  oleh Fikri Amrullah.')
@section('canonical', route('services'))

@section('content')
  <section class="paper-grid border-b border-line">
    <div class="mx-auto max-w-360 px-5 py-14 sm:px-8 lg:px-12 lg:py-20">
      <div class="grid gap-8 lg:grid-cols-12">
        <div class="lg:col-span-3">
          <p class="eyebrow">04 / Layanan</p>
          <p class="mt-3 max-w-[22ch] text-sm leading-relaxed text-ink-soft">
            Cara saya bisa membantu, dari perbaikan kecil sampai aplikasi yang dibangun dari awal.
          </p>
        </div>
        <div class="lg:col-span-9">
          <h1 class="display text-[clamp(3.2rem,6vw,5.5rem)] text-ink">Layanan.</h1>
          <div class="mt-6 flex flex-col gap-4 border-t border-ink pt-4 sm:flex-row sm:items-start sm:justify-between">
            <p class="max-w-[58ch] text-base leading-relaxed text-ink-soft">
              Ruang lingkup dan biaya ditentukan setelah konteks, batasan, dan hasil yang diinginkan cukup jelas. Tidak
              ada paket yang dipaksakan.
            </p>
            <p class="shrink-0 font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">Engagement / 2026</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-paper-raised">
    <div class="mx-auto max-w-360 px-5 sm:px-8 lg:px-12">
      @foreach ($services as $service)
        <article class="grid gap-8 border-b border-line py-12 lg:grid-cols-12 lg:py-16">
          <div class="lg:col-span-4">
            <div class="flex items-baseline gap-4">
              <span
                class="font-mono text-[10px] tracking-[0.14em] text-cobalt">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
              <h2
                class="font-display text-[clamp(1.8rem,3vw,2.6rem)] font-semibold leading-[1.05] tracking-[-0.035em] text-ink">
                {{ $service['title'] }}</h2>
            </div>
            <p class="mt-4 max-w-[36ch] text-sm leading-relaxed text-ink-soft">{{ $service['summary'] }}</p>
          </div>

          <div class="grid gap-8 sm:grid-cols-2 lg:col-span-8">
            <div>
              <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Yang termasuk</p>
              <ul class="mt-3 grid gap-2">
                @foreach ($service['deliverables'] as $deliverable)
                  <li class="flex items-start gap-3 border-t border-line pt-2 text-sm leading-relaxed text-ink-soft">
                    <span class="mt-0.5 font-mono text-[10px] text-cobalt" aria-hidden="true">+</span>
                    <span>{{ $deliverable }}</span>
                  </li>
                @endforeach
              </ul>
            </div>
            <div>
              <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Cocok untuk</p>
              <p class="mt-3 border-t border-line pt-2 text-sm leading-relaxed text-ink-soft">{{ $service['fit'] }}</p>
            </div>
          </div>
        </article>
      @endforeach
    </div>
  </section>

  <section class="border-b border-line">
    <div class="mx-auto max-w-360 px-5 py-14 sm:px-8 lg:px-12 lg:py-20">
      <div class="grid gap-10 lg:grid-cols-12">
        <div class="lg:col-span-3">
          <p class="eyebrow">Proses</p>
          <p class="mt-3 max-w-[22ch] text-sm leading-relaxed text-ink-soft">
            Empat langkah yang menjaga pekerjaan tetap bisa diperiksa.
          </p>
        </div>
        <div class="lg:col-span-9">
          <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
            @foreach ([['01', 'Konteks', 'Memahami masalah, pengguna, dan batasan sebelum menulis kode.'], ['02', 'Rancangan', 'Alur, skema data, dan ruang lingkup yang disepakati.'], ['03', 'Implementasi', 'Pekerjaan bertahap dengan validasi dan pengujian alur utama.'], ['04', 'Serah terima', 'Dokumentasi, akses, dan catatan perawatan.']] as [$number, $title, $body])
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
        <h2 class="display max-w-[18ch] text-[clamp(2.2rem,4vw,3.6rem)] text-paper">Ceritakan yang sedang Anda hadapi.
        </h2>
      </div>
      <a href="{{ route('contact.create') }}"
        class="btn bg-paper-raised text-ink hover:bg-cobalt hover:text-paper-raised">Kirim pesan</a>
    </div>
  </section>
@endsection
