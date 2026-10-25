@extends('layouts.auth')

@section('title', 'Masuk admin — '.config('app.name'))

@section('content')
    <div class="w-full max-w-md">
        <div class="mb-8 flex items-center justify-between lg:hidden">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.14em] text-ink-faint">
                <span aria-hidden="true">←</span> Kembali ke situs
            </a>
            @if ($profile->hasLogo())
                <img src="{{ $profile->logo_url }}" alt="" class="size-8 shrink-0 object-contain">
            @else
                <span class="grid size-8 place-items-center border border-ink bg-ink font-mono text-[10px] text-paper-raised">FA</span>
            @endif
        </div>

        <div class="sheet">
            <div class="flex items-center justify-between border-b border-line bg-paper-deep px-5 py-4">
                <h2 class="font-display text-2xl font-semibold tracking-[-0.03em] text-ink">Masuk.</h2>
                <span class="stamp stamp-cobalt">Terbatas</span>
            </div>

            <form action="{{ route('login') }}" method="POST" class="p-5 sm:p-6">
                @csrf

                @if ($errors->any())
                    <div class="mb-5 border border-stamp/40 bg-stamp-wash px-3 py-2 text-sm leading-relaxed text-stamp" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <div>
                    <label for="email" class="label">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        value="{{ old('email') }}"
                        class="field @error('email') field-error @enderror"
                        autocomplete="username"
                        required
                        autofocus
                    >
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-5">
                    <label for="password" class="label">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="field @error('password') field-error @enderror"
                        autocomplete="current-password"
                        required
                    >
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <label class="mt-5 flex items-center gap-2 text-sm text-ink-soft">
                    <input type="checkbox" name="remember" class="size-4 border-line-strong bg-paper-raised text-cobalt focus:ring-cobalt">
                    Ingat perangkat ini
                </label>

                <button type="submit" class="btn btn-primary mt-6 w-full">
                    Masuk ke panel
                    <span aria-hidden="true">→</span>
                </button>
            </form>

            <div class="border-t border-line px-5 py-4">
                <p class="text-xs leading-relaxed text-ink-faint">
                    Akun admin dibuat melalui perintah <code class="font-mono text-[10px] text-ink-soft">php artisan admin:create</code>. Tidak ada pendaftaran publik.
                </p>
            </div>
        </div>

        <p class="mt-6 text-center font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">
            {{ config('app.name') }} / Panel admin
        </p>
    </div>
@endsection
