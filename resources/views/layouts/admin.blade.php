@php
  $site = \App\Models\SiteProfile::current();
@endphp

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin — ' . config('app.name'))</title>
  <meta name="robots" content="noindex, nofollow">
  <meta name="theme-color" content="#f5f3ec">
  @if ($site->favicon_url)
    <link rel="icon" href="{{ $site->favicon_url }}"
      @if ($site->hasGeneratedFavicon()) type="image/png" sizes="64x64" @endif>
  @else
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
  @endif
  @fonts
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-paper text-ink antialiased">
  <a href="#admin-main"
    class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-100 focus:border focus:border-ink focus:bg-ink focus:px-4 focus:py-2 focus:font-mono focus:text-xs focus:uppercase focus:tracking-widest focus:text-paper-raised">
    Lompat ke konten
  </a>

  @php
    $unreadCount = \App\Models\ContactMessage::query()->unread()->count();
    $nav = [
        ['label' => 'Dashboard', 'route' => 'admin.dashboard', 'pattern' => 'admin.dashboard', 'number' => '01'],
        ['label' => 'Project', 'route' => 'admin.projects.index', 'pattern' => 'admin.projects.*', 'number' => '02'],
        [
            'label' => 'Pesan',
            'route' => 'admin.messages.index',
            'pattern' => 'admin.messages.*',
            'number' => '03',
            'count' => $unreadCount,
        ],
        ['label' => 'Profil & CV', 'route' => 'admin.profile.edit', 'pattern' => 'admin.profile.*', 'number' => '04'],
    ];
  @endphp

  <header class="sticky top-0 z-40 border-b border-line bg-paper">
    <div class="flex items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
      <div class="flex items-center gap-3">
        <button type="button"
          class="inline-flex items-center gap-2 border border-line-strong px-3 py-2 font-mono text-[10px] uppercase tracking-[0.14em] text-ink lg:hidden"
          data-nav-toggle aria-controls="admin-nav" aria-expanded="false">
          Menu
          <span class="flex w-4 flex-col gap-1" aria-hidden="true">
            <span class="h-px w-full bg-current"></span>
            <span class="h-px w-full bg-current"></span>
            <span class="h-px w-full bg-current"></span>
          </span>
        </button>

        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
          @if ($site->hasLogo())
            <img src="{{ $site->logo_url }}" alt="" class="size-8 shrink-0 object-contain">
          @else
            <span
              class="grid size-8 place-items-center border border-ink bg-ink font-mono text-[10px] tracking-widest text-paper-raised">FA</span>
          @endif
          <span class="leading-none">
            <span
              class="block font-display text-sm font-semibold tracking-[-0.02em] text-ink">{{ $site->name }}</span>
            <span class="mt-1 block font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Panel admin</span>
          </span>
        </a>
      </div>

      <div class="flex items-center gap-2">
        <a href="{{ route('home') }}"
          class="hidden border border-line-strong px-3 py-2 font-mono text-[9px] uppercase tracking-[0.12em] text-ink-soft transition-colors hover:border-ink hover:text-ink sm:inline-flex"
          target="_blank" rel="noopener noreferrer">
          Lihat situs ↗
        </a>
        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit"
            class="border border-line-strong px-3 py-2 font-mono text-[9px] uppercase tracking-[0.12em] text-ink-soft transition-colors hover:border-stamp hover:text-stamp">
            Keluar
          </button>
        </form>
      </div>
    </div>
  </header>

  <div class="lg:grid lg:grid-cols-[250px_minmax(0,1fr)]">
    <aside id="admin-nav"
      class="hidden border-b border-line bg-paper-raised lg:sticky lg:top-15.25 lg:block lg:h-[calc(100vh-61px)] lg:border-b-0 lg:border-r">
      <div class="flex h-full flex-col justify-between">
        <div class="p-4">
          <p class="px-2 font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Navigasi</p>
          <nav class="mt-3 grid gap-1" aria-label="Navigasi admin">
            @foreach ($nav as $item)
              <a href="{{ route($item['route']) }}" class="admin-nav-link"
                @if (request()->routeIs($item['pattern'])) aria-current="page" @endif>
                <span class="font-mono text-[9px] text-ink-faint">{{ $item['number'] }}</span>
                <span class="flex-1">{{ $item['label'] }}</span>
                @if (!empty($item['count']))
                  <span
                    class="grid min-w-5 place-items-center border border-cobalt bg-cobalt-wash px-1 py-0.5 font-mono text-[9px] text-cobalt-deep">{{ $item['count'] }}</span>
                @endif
              </a>
            @endforeach
          </nav>

          <div class="mt-6 border-t border-line pt-4">
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary w-full">
              Project baru
              <span aria-hidden="true">+</span>
            </a>
          </div>
        </div>

        <div class="border-t border-line p-4">
          <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Masuk sebagai</p>
          <p class="mt-1 truncate text-sm text-ink">{{ auth()->user()->name }}</p>
          <p class="truncate font-mono text-[9px] text-ink-faint">{{ auth()->user()->email }}</p>
        </div>
      </div>
    </aside>

    <main id="admin-main" class="min-w-0">
      <x-flash />
      <div class="px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
        @yield('content')
      </div>
    </main>
  </div>

  <x-confirm-dialog id="admin-confirm-dialog" title="Konfirmasi tindakan admin"
    message="Data yang dihapus tidak bisa dikembalikan. Lanjutkan?" />
</body>

</html>
