@php
    $site = $profile ?? \App\Models\SiteProfile::current();
@endphp

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Masuk admin — Fikri Amrullah')</title>
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#f5f3ec">
    @if ($site->favicon_url)
        <link rel="icon" href="{{ $site->favicon_url }}" @if ($site->hasGeneratedFavicon()) type="image/png" sizes="64x64" @endif>
    @else
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    @endif
    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-paper text-ink antialiased">
    <div class="grid min-h-screen lg:grid-cols-2">
        <aside class="paper-grid relative hidden overflow-hidden border-r border-line bg-ink px-10 py-12 text-paper lg:flex lg:flex-col lg:justify-between xl:px-16">
            <div>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 font-mono text-[10px] uppercase tracking-[0.16em] text-paper/70 transition-colors hover:text-paper cursor-pointer">
                    @if ($site->hasLogo())
                        <span class="grid size-8 shrink-0 place-items-center bg-paper-raised p-0.5">
                            <img src="{{ $site->logo_url }}" alt="" class="size-full object-contain">
                        </span>
                    @else
                        <span class="grid size-8 place-items-center border border-paper/30 text-[10px]">FA</span>
                    @endif
                    Kembali ke situs
                </a>

                <div class="mt-24">
                    <h1 class="display max-w-[10ch] text-[clamp(3rem,6vw,5.5rem)] text-paper">Ruang kerja.</h1>
                    <p class="mt-6 max-w-[34ch] text-sm leading-relaxed text-paper/70">
                        Tempat mengelola project, pesan masuk, profil publik, dan CV. Tidak ada registrasi publik.
                    </p>
                </div>
            </div>

            <div class="border-t border-paper/20 pt-5 font-mono text-[9px] uppercase tracking-[0.14em] text-paper/50">
                <p>Akses terbatas / {{ now()->format('Y') }}</p>
            </div>
        </aside>

        <main class="flex items-center justify-center px-5 py-12 sm:px-8">
            @yield('content')
        </main>
    </div>
</body>
</html>
