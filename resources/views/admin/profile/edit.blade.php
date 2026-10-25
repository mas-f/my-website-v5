@extends('layouts.admin')

@section('title', 'Profil & CV — Admin')

@section('content')
    <x-admin.page-header
        eyebrow="04 / Profil & CV"
        title="Profil publik & CV"
        description="Identitas yang tampil di situs, tautan publik, dan file CV yang bisa diunduh."
    >
        <x-slot:actions>
            <a href="{{ route('home') }}" class="btn btn-secondary" target="_blank" rel="noopener noreferrer">Lihat situs ↗</a>
        </x-slot:actions>
    </x-admin.page-header>

    <div class="mt-6 grid gap-8 xl:grid-cols-12">
        <div class="space-y-6 xl:col-span-8">
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="sheet-flat">
                @csrf
                @method('PATCH')

                <div class="border-b border-line bg-paper-deep px-4 py-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Identitas publik</p>
                </div>

                <div class="space-y-5 p-4 sm:p-5">
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="profile_name" class="label">Nama <span class="text-stamp">*</span></label>
                            <input type="text" name="profile[name]" id="profile_name" value="{{ old('profile.name', $profile->name) }}" class="field @if ($errors->updateProfile->has('name')) field-error @endif" required>
                            @if ($errors->updateProfile->has('name'))
                                <p class="error">{{ $errors->updateProfile->first('name') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="profile_role" class="label">Peran <span class="text-stamp">*</span></label>
                            <input type="text" name="profile[role]" id="profile_role" value="{{ old('profile.role', $profile->role) }}" class="field @if ($errors->updateProfile->has('role')) field-error @endif" required>
                            @if ($errors->updateProfile->has('role'))
                                <p class="error">{{ $errors->updateProfile->first('role') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="profile_location" class="label">Lokasi <span class="text-stamp">*</span></label>
                            <input type="text" name="profile[location]" id="profile_location" value="{{ old('profile.location', $profile->location) }}" class="field @if ($errors->updateProfile->has('location')) field-error @endif" required>
                            @if ($errors->updateProfile->has('location'))
                                <p class="error">{{ $errors->updateProfile->first('location') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="profile_email" class="label">Email publik <span class="text-stamp">*</span></label>
                            <input type="email" name="profile[email]" id="profile_email" value="{{ old('profile.email', $profile->email) }}" class="field @if ($errors->updateProfile->has('email')) field-error @endif" required>
                            @if ($errors->updateProfile->has('email'))
                                <p class="error">{{ $errors->updateProfile->first('email') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="profile_github_url" class="label">URL GitHub</label>
                            <input type="url" name="profile[github_url]" id="profile_github_url" value="{{ old('profile.github_url', $profile->github_url) }}" class="field @if ($errors->updateProfile->has('github_url')) field-error @endif" placeholder="https://github.com/...">
                            @if ($errors->updateProfile->has('github_url'))
                                <p class="error">{{ $errors->updateProfile->first('github_url') }}</p>
                            @endif
                        </div>
                        <div>
                            <label for="profile_linkedin_url" class="label">URL LinkedIn</label>
                            <input type="url" name="profile[linkedin_url]" id="profile_linkedin_url" value="{{ old('profile.linkedin_url', $profile->linkedin_url) }}" class="field @if ($errors->updateProfile->has('linkedin_url')) field-error @endif" placeholder="https://linkedin.com/in/...">
                            <p class="help">Kosongkan untuk menyembunyikan tautan LinkedIn.</p>
                            @if ($errors->updateProfile->has('linkedin_url'))
                                <p class="error">{{ $errors->updateProfile->first('linkedin_url') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="border-t border-line pt-5">
                        <label for="cv" class="label">File CV</label>
                        <input type="file" name="cv" id="cv" accept=".pdf,.doc,.docx" class="field file:mr-3 file:border-0 file:bg-ink file:px-3 file:py-1.5 file:font-mono file:text-[9px] file:uppercase file:tracking-[0.12em] file:text-paper-raised">
                        <p class="help">PDF, DOC, atau DOCX. Maks 5 MB. Unggah file baru untuk mengganti CV lama.</p>
                        @if ($errors->updateProfile->has('cv'))
                            <p class="error">{{ $errors->updateProfile->first('cv') }}</p>
                        @endif

                        @if ($profile->hasCv())
                            <div class="mt-4 flex flex-col gap-3 border border-line bg-paper-deep p-3 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-ink">{{ $profile->cv_original_name ?: 'CV saat ini' }}</p>
                                    <a href="{{ $profile->cv_url }}" class="mt-1 inline-flex text-xs text-cobalt hover:underline" target="_blank" rel="noopener noreferrer">Buka file ↗</a>
                                </div>
                                <span class="stamp stamp-success w-fit">Tersedia</span>
                            </div>
                        @else
                            <div class="mt-4 border border-manila-deep bg-manila/40 px-3 py-2">
                                <p class="text-sm text-ink-soft">CV belum tersedia. Tautan unduh disembunyikan sampai file diunggah.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex flex-wrap justify-end gap-2 border-t border-line px-4 py-4 sm:px-5">
                    <button type="submit" class="btn btn-primary">Simpan profil</button>
                </div>
            </form>

            @if ($profile->hasCv())
                <form action="{{ route('admin.profile.cv.destroy') }}" method="POST" data-confirm-form="admin-confirm-dialog" class="border border-stamp/30 bg-stamp-wash/40 p-4">
                    @csrf
                    @method('DELETE')
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <p class="max-w-xl text-sm leading-relaxed text-ink-soft">Hapus file CV. Tautan unduh akan langsung disembunyikan dari situs publik.</p>
                        <button type="submit" class="btn btn-danger">Hapus CV</button>
                    </div>
                </form>
            @endif
        </div>

        <aside class="space-y-6 xl:col-span-4">
            <form action="{{ route('admin.account.update') }}" method="POST" class="sheet-flat">
                @csrf
                @method('PATCH')
                <div class="border-b border-line bg-paper-deep px-4 py-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Akun admin</p>
                </div>
                <div class="space-y-5 p-4">
                    <div>
                        <label for="account_name" class="label">Nama</label>
                        <input type="text" name="name" id="account_name" value="{{ old('name', $user->name) }}" class="field @if ($errors->updateAccount->has('name')) field-error @endif" required>
                        @if ($errors->updateAccount->has('name'))
                            <p class="error">{{ $errors->updateAccount->first('name') }}</p>
                        @endif
                    </div>
                    <div>
                        <label for="account_email" class="label">Email login</label>
                        <input type="email" name="email" id="account_email" value="{{ old('email', $user->email) }}" class="field @if ($errors->updateAccount->has('email')) field-error @endif" required>
                        @if ($errors->updateAccount->has('email'))
                            <p class="error">{{ $errors->updateAccount->first('email') }}</p>
                        @endif
                    </div>
                </div>
                <div class="border-t border-line px-4 py-4">
                    <button type="submit" class="btn btn-secondary w-full">Simpan akun</button>
                </div>
            </form>

            <form action="{{ route('admin.account.password.update') }}" method="POST" class="sheet-flat">
                @csrf
                @method('PUT')
                <div class="border-b border-line bg-paper-deep px-4 py-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Ganti password</p>
                </div>
                <div class="space-y-5 p-4">
                    @if ($errors->updatePassword->any())
                        <div class="border border-stamp/40 bg-stamp-wash px-3 py-2 text-sm text-stamp" role="alert">
                            {{ $errors->updatePassword->first() }}
                        </div>
                    @endif

                    <div>
                        <label for="current_password" class="label">Password saat ini</label>
                        <input type="password" name="current_password" id="current_password" class="field" autocomplete="current-password">
                        @if ($errors->updatePassword->has('current_password'))
                            <p class="error">{{ $errors->updatePassword->first('current_password') }}</p>
                        @endif
                    </div>
                    <div>
                        <label for="password" class="label">Password baru</label>
                        <input type="password" name="password" id="password" class="field" autocomplete="new-password">
                        <p class="help">Minimal 12 karakter, kombinasi huruf besar-kecil, angka, dan simbol.</p>
                        @if ($errors->updatePassword->has('password'))
                            <p class="error">{{ $errors->updatePassword->first('password') }}</p>
                        @endif
                    </div>
                    <div>
                        <label for="password_confirmation" class="label">Ulangi password baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="field" autocomplete="new-password">
                    </div>
                </div>
                <div class="border-t border-line px-4 py-4">
                    <button type="submit" class="btn btn-secondary w-full">Perbarui password</button>
                </div>
            </form>

            <div class="border border-line bg-paper-deep p-4">
                <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Catatan</p>
                <p class="mt-2 text-xs leading-relaxed text-ink-soft">
                    Email login dan email publik bisa berbeda. Email publik dipakai untuk tautan kontak di situs dan notifikasi pesan.
                </p>
            </div>
        </aside>
    </div>
@endsection
