@php
    $isEdit = $category->exists;
    $action = $isEdit ? route('admin.categories.update', $category) : route('admin.categories.store');
@endphp

<form id="category-form" action="{{ $action }}" method="POST" class="mt-6">
    @csrf
    @if ($isEdit)
        @method('PATCH')
    @endif

    <div class="grid gap-8 xl:grid-cols-12">
        <div class="space-y-6 xl:col-span-8">
            <section class="sheet-flat">
                <div class="border-b border-line bg-paper-deep px-4 py-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Detail kategori</p>
                </div>
                <div class="space-y-5 p-4 sm:p-5">
                    <div>
                        <label for="name" class="label">Nama <span class="text-stamp">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}" class="field @error('name') field-error @enderror" required>
                        <p class="help">Nama yang tampil di filter project publik.</p>
                        @error('name') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="slug" class="label">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}" class="field @error('slug') field-error @enderror" placeholder="otomatis-dari-nama">
                        <p class="help">Kosongkan untuk dibuat otomatis dari nama. Gunakan huruf, angka, dan tanda hubung.</p>
                        @error('slug') <p class="error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>
        </div>

        <aside class="space-y-6 xl:col-span-4">
            <section class="sheet-flat">
                <div class="border-b border-line bg-paper-deep px-4 py-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Tampilan</p>
                </div>
                <div class="space-y-5 p-4 sm:p-5">
                    <div>
                        <label for="sort_order" class="label">Urutan <span class="text-stamp">*</span></label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" min="0" max="9999" class="field @error('sort_order') field-error @enderror" required>
                        <p class="help">Angka kecil tampil lebih dulu di filter publik.</p>
                        @error('sort_order') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    @if ($isEdit)
                        <div class="border-t border-line pt-4">
                            <p class="font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint">Dipakai oleh</p>
                            <p class="mt-2 text-sm text-ink-soft">{{ $category->projects_count }} project</p>
                            @if ($category->projects_count > 0)
                                <p class="mt-2 text-xs leading-relaxed text-ink-faint">Pindahkan project ke kategori lain sebelum menghapus kategori ini.</p>
                            @endif
                        </div>
                    @endif
                </div>
            </section>
        </aside>
    </div>

    <div class="mt-8 flex flex-wrap items-center justify-between gap-3 border-t border-line pt-5">
        <div class="flex flex-wrap gap-2">
            <button type="submit" class="btn btn-primary cursor-pointer">Simpan kategori</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary cursor-pointer">Batal</a>
        </div>
        @if ($isEdit)
            <a href="{{ route('admin.projects.index', ['q' => $category->name]) }}" class="font-mono text-[9px] uppercase tracking-[0.12em] text-cobalt hover:underline cursor-pointer">Lihat project terkait ↗</a>
        @endif
    </div>
</form>
