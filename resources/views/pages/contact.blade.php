@extends('layouts.public')

@section('title', 'Kontak — '.$profile->name)
@section('description', 'Hubungi Fikri Amrullah untuk membahas aplikasi web Laravel, perbaikan, atau konsultasi teknis.')
@section('canonical', route('contact.create'))

@section('content')
    <section class="paper-grid border-b border-line">
        <div class="mx-auto max-w-[1440px] px-5 py-14 sm:px-8 lg:px-12 lg:py-20">
            <div class="grid gap-8 lg:grid-cols-12">
                <div class="lg:col-span-3">
                    <p class="eyebrow">05 / Kontak</p>
                    <p class="mt-3 max-w-[22ch] text-sm leading-relaxed text-ink-soft">
                        Pesan masuk ke database situs dan bisa dibaca dari panel admin.
                    </p>
                </div>
                <div class="lg:col-span-9">
                    <h1 class="display text-[clamp(3.2rem,6vw,5.5rem)] text-ink">Kontak.</h1>
                    <div class="mt-6 flex flex-col gap-4 border-t border-ink pt-4 sm:flex-row sm:items-start sm:justify-between">
                        <p class="max-w-[58ch] text-base leading-relaxed text-ink-soft">
                            Ceritakan konteks, batasan, dan hasil yang ingin dicapai. Semakin jelas masalahnya, semakin mudah memberi jawaban yang berguna.
                        </p>
                        <p class="shrink-0 font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">Balasan via email</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-paper-raised">
        <div class="mx-auto max-w-[1440px] px-5 py-10 sm:px-8 lg:px-12 lg:py-14">
            <div class="grid gap-10 lg:grid-cols-12 lg:gap-8">
                <div class="lg:col-span-7">
                    <div class="sheet">
                        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-line bg-paper-deep px-5 py-4">
                            <div>
                                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Formulir pesan</p>
                                <h2 class="mt-1 font-display text-2xl font-semibold tracking-[-0.03em] text-ink">Tulis pesan.</h2>
                            </div>
                            <span class="stamp stamp-cobalt">01 / 01</span>
                        </div>

                        <form action="{{ route('contact.store') }}" method="POST" class="p-5 sm:p-7" data-contact-form>
                            @csrf

                            <div class="absolute -left-[9999px] top-auto h-px w-px overflow-hidden" aria-hidden="true">
                                <label for="website">Website</label>
                                <input type="text" name="website" id="website" tabindex="-1" autocomplete="off">
                            </div>

                            <div class="grid gap-5 sm:grid-cols-2">
                                <div>
                                    <label for="name" class="label">Nama <span class="text-stamp">*</span></label>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        value="{{ old('name') }}"
                                        class="field @error('name') field-error @enderror"
                                        autocomplete="name"
                                        required
                                        @error('name') aria-invalid="true" aria-describedby="name-error" @enderror
                                    >
                                    @error('name')
                                        <p id="name-error" class="error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="label">Email <span class="text-stamp">*</span></label>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        value="{{ old('email') }}"
                                        class="field @error('email') field-error @enderror"
                                        autocomplete="email"
                                        required
                                        @error('email') aria-invalid="true" aria-describedby="email-error" @enderror
                                    >
                                    @error('email')
                                        <p id="email-error" class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-5">
                                <label for="subject" class="label">Subjek <span class="text-stamp">*</span></label>
                                <input
                                    type="text"
                                    name="subject"
                                    id="subject"
                                    value="{{ old('subject') }}"
                                    class="field @error('subject') field-error @enderror"
                                    placeholder="Contoh: Perbaikan alur admin Laravel"
                                    required
                                    @error('subject') aria-invalid="true" aria-describedby="subject-error" @enderror
                                >
                                @error('subject')
                                    <p id="subject-error" class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-5">
                                <label for="message" class="label">Pesan <span class="text-stamp">*</span></label>
                                <textarea
                                    name="message"
                                    id="message"
                                    rows="8"
                                    class="field resize-y @error('message') field-error @enderror"
                                    placeholder="Konteks, masalah, batasan, dan hasil yang diinginkan."
                                    required
                                    @error('message') aria-invalid="true" aria-describedby="message-help message-error" @enderror
                                >{{ old('message') }}</textarea>
                                <p id="message-help" class="help">Minimal 20 karakter. Jangan sertakan data sensitif seperti password atau kunci API.</p>
                                @error('message')
                                    <p id="message-error" class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-6 flex flex-col gap-4 border-t border-line pt-5 sm:flex-row sm:items-center sm:justify-between">
                                <p class="max-w-[34ch] text-xs leading-relaxed text-ink-faint">
                                    Dengan mengirim pesan, Anda setuju pesan disimpan di database situs ini.
                                </p>
                                <button type="submit" class="btn btn-primary" data-submit>
                                    <span data-submit-label>Kirim pesan</span>
                                    <span aria-hidden="true">→</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <aside class="lg:col-span-5">
                    <div class="lg:sticky lg:top-28">
                        <div class="border border-line bg-paper">
                            <div class="border-b border-line px-4 py-3">
                                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Kontak langsung</p>
                            </div>
                            <div class="divide-y divide-line">
                                <div class="px-4 py-4">
                                    <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Email</p>
                                    <a href="mailto:{{ $profile->email }}" class="mt-1 block break-all text-sm text-cobalt hover:underline">{{ $profile->email }}</a>
                                </div>
                                <div class="px-4 py-4">
                                    <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">GitHub</p>
                                    <a href="{{ $profile->github_url }}" class="mt-1 block break-all text-sm text-cobalt hover:underline" target="_blank" rel="noopener noreferrer">GitHub ↗</a>
                                </div>
                                @if ($profile->linkedin_url)
                                    <div class="px-4 py-4">
                                        <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">LinkedIn</p>
                                        <a href="{{ $profile->linkedin_url }}" class="mt-1 block break-all text-sm text-cobalt hover:underline" target="_blank" rel="noopener noreferrer">LinkedIn ↗</a>
                                    </div>
                                @endif
                                <div class="px-4 py-4">
                                    <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Lokasi</p>
                                    <p class="mt-1 text-sm text-ink">{{ $profile->location }}</p>
                                </div>
                                <div class="px-4 py-4">
                                    <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">CV</p>
                                    @if ($profile->hasCv())
                                        <a href="{{ $profile->cv_url }}" class="mt-1 inline-flex items-center gap-2 text-sm text-cobalt hover:underline" download>
                                            Unduh CV
                                            <span aria-hidden="true">↓</span>
                                        </a>
                                    @else
                                        <p class="mt-1 text-sm text-ink-faint">Belum tersedia.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 border-t border-cobalt pt-4">
                            <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-cobalt">Agar lebih cepat</p>
                            <ul class="mt-3 grid gap-2 text-sm leading-relaxed text-ink-soft">
                                <li class="flex gap-2"><span class="text-cobalt" aria-hidden="true">+</span> Jelaskan masalah dan pengguna yang terdampak.</li>
                                <li class="flex gap-2"><span class="text-cobalt" aria-hidden="true">+</span> Sebutkan batasan waktu, teknologi, atau anggaran.</li>
                                <li class="flex gap-2"><span class="text-cobalt" aria-hidden="true">+</span> Tautkan contoh atau dokumen yang relevan.</li>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </section>
@endsection
