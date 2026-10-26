<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  @php
    $site = $profile ?? \App\Models\SiteProfile::current();
  @endphp

  <title>@yield('title', $site->name . ' — ' . $site->role)</title>
  <meta name="description" content="@yield('description', 'Portofolio Fikri Amrullah, full-stack developer yang membangun aplikasi web dengan Laravel, Blade, MySQL, dan Tailwind CSS.')">
  <meta name="author" content="{{ $site->name }}">
  <meta name="robots" content="@yield('robots', 'index, follow')">
  <link rel="canonical" href="@yield('canonical', url()->current())">

  <meta property="og:type" content="@yield('og_type', 'website')">
  <meta property="og:locale" content="id_ID">
  <meta property="og:site_name" content="{{ $site->name }}">
  <meta property="og:title" content="@yield('title', $site->name . ' — ' . $site->role)">
  <meta property="og:description" content="@yield('description', 'Portofolio Fikri Amrullah, full-stack developer yang membangun aplikasi web dengan Laravel, Blade, MySQL, dan Tailwind CSS.')">
  <meta property="og:url" content="@yield('canonical', url()->current())">
  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="@yield('title', $site->name . ' — ' . $site->role)">
  <meta name="twitter:description" content="@yield('description', 'Portofolio Fikri Amrullah, full-stack developer yang membangun aplikasi web dengan Laravel, Blade, MySQL, dan Tailwind CSS.')">

  <meta name="theme-color" content="#f5f3ec">
  @if ($site->favicon_url)
    <link rel="icon" href="{{ $site->favicon_url }}"
      @if ($site->hasGeneratedFavicon()) type="image/png" sizes="64x64" @endif>
  @else
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
  @endif

  @fonts
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('head')
</head>

<body class="min-h-screen bg-paper text-ink antialiased">
  <a href="#main"
    class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-100 focus:border focus:border-ink focus:bg-ink focus:px-4 focus:py-2 focus:font-mono focus:text-xs focus:uppercase focus:tracking-widest focus:text-paper-raised cursor-pointer">
    Lompat ke konten
  </a>

  <x-site-header :profile="$site" />

  <x-flash />

  <main id="main">
    @yield('content')
  </main>

  <x-site-footer :profile="$site" />

  <x-confirm-dialog id="confirm-dialog" title="Konfirmasi tindakan"
    message="Tindakan ini tidak bisa dibatalkan. Lanjutkan?" />
</body>

</html>
