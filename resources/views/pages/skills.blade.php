@extends('layouts.public')

@section('title', 'Keahlian — '.$profile->name)
@section('description', 'Alat dan keahlian yang dipakai Fikri Amrullah untuk membangun aplikasi web Laravel: PHP, MySQL, Blade, Tailwind CSS, JavaScript, dan pengujian.')
@section('canonical', route('skills'))

@section('content')
    <section class="paper-grid border-b border-line">
        <div class="mx-auto max-w-[1440px] px-5 py-14 sm:px-8 lg:px-12 lg:py-20">
            <div class="grid gap-8 lg:grid-cols-12">
                <div class="lg:col-span-3">
                    <p class="eyebrow">03 / Keahlian</p>
                    <p class="mt-3 max-w-[22ch] text-sm leading-relaxed text-ink-soft">
                        Alat yang dipakai untuk membangun, menguji, dan merawat aplikasi.
                    </p>
                </div>
                <div class="lg:col-span-9">
                    <h1 class="display text-[clamp(3.2rem,6vw,5.5rem)] text-ink">Keahlian.</h1>
                    <div class="mt-6 flex flex-col gap-4 border-t border-ink pt-4 sm:flex-row sm:items-start sm:justify-between">
                        <p class="max-w-[58ch] text-base leading-relaxed text-ink-soft">
                            Ini bukan daftar peringkat. Setiap baris menjelaskan bagaimana alat tersebut dipakai dalam pekerjaan sehari-hari.
                        </p>
                        <p class="shrink-0 font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">Toolkit / {{ now()->format('Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-paper-raised">
        <div class="mx-auto max-w-[1440px] px-5 py-10 sm:px-8 lg:px-12 lg:py-14">
            @foreach ($groups as $group)
                <section class="grid gap-8 border-b border-line py-10 first:pt-0 last:border-b-0 last:pb-0 lg:grid-cols-12">
                    <div class="lg:col-span-3">
                        <p class="font-mono text-[10px] tracking-[0.14em] text-cobalt">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</p>
                        <h2 class="mt-2 font-display text-2xl font-semibold tracking-[-0.03em] text-ink">{{ $group['title'] }}</h2>
                        <p class="mt-2 max-w-[22ch] text-sm leading-relaxed text-ink-soft">{{ $group['note'] }}</p>
                    </div>
                    <div class="lg:col-span-9">
                        <div class="ledger border-t-0">
                            @foreach ($group['items'] as $item)
                                <div class="ledger-row grid-cols-12 gap-y-2 py-4 sm:gap-x-6">
                                    <div class="col-span-12 sm:col-span-4">
                                        <h3 class="font-display text-lg font-semibold tracking-[-0.02em] text-ink">{{ $item['name'] }}</h3>
                                    </div>
                                    <div class="col-span-12 sm:col-span-8">
                                        <p class="text-sm leading-relaxed text-ink-soft">{{ $item['detail'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    </section>

    <section class="border-t border-line">
        <div class="mx-auto max-w-[1440px] px-5 py-14 sm:px-8 lg:px-12 lg:py-20">
            <div class="grid gap-8 lg:grid-cols-12">
                <div class="lg:col-span-3">
                    <p class="eyebrow">Cara memilih</p>
                </div>
                <div class="lg:col-span-9">
                    <div class="grid gap-8 sm:grid-cols-3">
                        @foreach ([
                            ['01', 'Sesuai masalah', 'Alat dipilih karena masalahnya, bukan karena sedang populer.'],
                            ['02', 'Bisa dirawat', 'Lebih mudah dipahami dan diuji oleh orang berikutnya.'],
                            ['03', 'Cukup kecil', 'Tidak menambah dependensi yang tidak memberi nilai nyata.'],
                        ] as [$number, $title, $body])
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
        <div class="mx-auto flex max-w-[1440px] flex-col gap-6 px-5 py-14 sm:px-8 lg:flex-row lg:items-end lg:justify-between lg:px-12 lg:py-20">
            <div>
                <h2 class="display max-w-[18ch] text-[clamp(2.2rem,4vw,3.6rem)] text-paper">Keahlian terlihat dari keputusan.</h2>
            </div>
            <a href="{{ route('projects.index') }}" class="btn bg-paper-raised text-ink hover:bg-cobalt hover:text-paper-raised">Buka log project</a>
        </div>
    </section>
@endsection
