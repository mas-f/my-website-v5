@php
    $isEdit = $project->exists;
    $action = $isEdit ? route('admin.projects.update', $project) : route('admin.projects.store');
    $statusValue = old('status', $project->status?->value ?? 'draft');
@endphp

<form id="project-form" action="{{ $action }}" method="POST" enctype="multipart/form-data" class="mt-6">
    @csrf
    @if ($isEdit)
        @method('PATCH')
    @endif

    <div class="grid gap-8 xl:grid-cols-12">
        <div class="space-y-6 xl:col-span-8">
            <section class="sheet-flat">
                <div class="border-b border-line bg-paper-deep px-4 py-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Konten utama</p>
                </div>
                <div class="space-y-5 p-4 sm:p-5">
                    <div>
                        <label for="title" class="label">Judul <span class="text-stamp">*</span></label>
                        <input type="text" name="title" id="title" value="{{ old('title', $project->title) }}" class="field @error('title') field-error @enderror" required>
                        @error('title') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="slug" class="label">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $project->slug) }}" class="field @error('slug') field-error @enderror" placeholder="otomatis-dari-judul">
                        <p class="help">Kosongkan untuk dibuat otomatis dari judul. Gunakan huruf, angka, dan tanda hubung.</p>
                        @error('slug') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="summary" class="label">Ringkasan <span class="text-stamp">*</span></label>
                        <textarea name="summary" id="summary" rows="3" class="field resize-y @error('summary') field-error @enderror" required>{{ old('summary', $project->summary) }}</textarea>
                        <p class="help">Tampil di daftar project. Maksimal 600 karakter.</p>
                        @error('summary') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="label">Deskripsi / catatan teknis <span class="text-stamp">*</span></label>
                        <textarea name="description" id="description" rows="10" class="field resize-y @error('description') field-error @enderror" required>{{ old('description', $project->description) }}</textarea>
                        <p class="help">Pisahkan paragraf dengan satu baris kosong. Tampil di bagian “Catatan teknis”.</p>
                        @error('description') <p class="error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

            <section class="sheet-flat">
                <div class="border-b border-line bg-paper-deep px-4 py-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Studi kasus</p>
                </div>
                <div class="space-y-5 p-4 sm:p-5">
                    <div>
                        <label for="problem_statement" class="label">Masalah</label>
                        <textarea name="problem_statement" id="problem_statement" rows="6" class="field resize-y @error('problem_statement') field-error @enderror">{{ old('problem_statement', $project->problem_statement) }}</textarea>
                        <p class="help">Konteks dan masalah yang ingin diselesaikan.</p>
                        @error('problem_statement') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="solution" class="label">Pendekatan</label>
                        <textarea name="solution" id="solution" rows="6" class="field resize-y @error('solution') field-error @enderror">{{ old('solution', $project->solution) }}</textarea>
                        <p class="help">Keputusan dan pendekatan yang dipilih.</p>
                        @error('solution') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="features" class="label">Fitur / yang dibangun</label>
                        <textarea name="features" id="features" rows="5" class="field resize-y @error('features') field-error @enderror">{{ old('features', implode("\n", $project->features ?? [])) }}</textarea>
                        <p class="help">Satu fitur per baris.</p>
                        @error('features') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="technologies" class="label">Teknologi</label>
                        <textarea name="technologies" id="technologies" rows="3" class="field resize-y @error('technologies') field-error @enderror">{{ old('technologies', implode(', ', $project->technologies ?? [])) }}</textarea>
                        <p class="help">Pisahkan dengan koma atau baris baru.</p>
                        @error('technologies') <p class="error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>
        </div>

        <aside class="space-y-6 xl:col-span-4">
            <section class="sheet-flat">
                <div class="border-b border-line bg-paper-deep px-4 py-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Publikasi</p>
                </div>
                <div class="space-y-5 p-4 sm:p-5">
                    <div>
                        <label for="status" class="label">Status <span class="text-stamp">*</span></label>
                        <select name="status" id="status" class="field @error('status') field-error @enderror" required>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->value }}" @selected($statusValue === $status->value)>{{ $status->label() }}</option>
                            @endforeach
                        </select>
                        @error('status') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="category_id" class="label">Kategori <span class="text-stamp">*</span></label>
                        <select name="category_id" id="category_id" class="field @error('category_id') field-error @enderror" required>
                            <option value="" disabled @selected(old('category_id', $project->category_id) === null)>Pilih kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected((string) old('category_id', $project->category_id) === (string) $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @if ($categories->isEmpty())
                            <p class="help">Belum ada kategori. <a href="{{ route('admin.categories.create') }}" class="text-cobalt hover:underline cursor-pointer">Buat kategori</a> terlebih dahulu.</p>
                        @else
                            <p class="help">Kategori dikelola di <a href="{{ route('admin.categories.index') }}" class="text-cobalt hover:underline cursor-pointer">halaman kategori</a>.</p>
                        @endif
                        @error('category_id') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="sort_order" class="label">Urutan <span class="text-stamp">*</span></label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}" min="0" max="9999" class="field @error('sort_order') field-error @enderror" required>
                        <p class="help">Angka kecil tampil lebih dulu.</p>
                        @error('sort_order') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-3 border-t border-line pt-4">
                        <input type="hidden" name="is_featured" value="0">
                        <label class="flex items-start gap-3 text-sm text-ink">
                            <input type="checkbox" name="is_featured" value="1" class="mt-0.5 size-4 border-line-strong bg-paper-raised text-cobalt focus:ring-cobalt" @checked(old('is_featured', $project->is_featured))>
                            <span>
                                <span class="block font-medium">Tampilkan sebagai pilihan</span>
                                <span class="mt-1 block text-xs text-ink-faint">Ditampilkan lebih dulu di daftar.</span>
                            </span>
                        </label>

                        <input type="hidden" name="is_placeholder" value="0">
                        <label class="flex items-start gap-3 text-sm text-ink">
                            <input type="checkbox" name="is_placeholder" value="1" class="mt-0.5 size-4 border-line-strong bg-paper-raised text-cobalt focus:ring-cobalt" @checked(old('is_placeholder', $project->is_placeholder))>
                            <span>
                                <span class="block font-medium">Tandai sebagai contoh</span>
                                <span class="mt-1 block text-xs text-ink-faint">Menampilkan label “Contoh” di situs publik.</span>
                            </span>
                        </label>
                    </div>
                </div>
            </section>

            <section class="sheet-flat">
                <div class="border-b border-line bg-paper-deep px-4 py-3">
                    <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Media</p>
                </div>
                <div class="space-y-5 p-4 sm:p-5">
                    <div>
                        <label for="thumbnail" class="label">Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/jpeg,image/png,image/webp" class="field file:mr-3 file:border-0 file:bg-ink file:px-3 file:py-1.5 file:font-mono file:text-[9px] file:uppercase file:tracking-[0.12em] file:text-paper-raised" data-image-input="#thumbnail-preview">
                        <p class="help">JPG, PNG, atau WebP. Maks 4 MB.</p>
                        @error('thumbnail') <p class="error">{{ $message }}</p> @enderror
                        <div class="mt-3 border border-line bg-paper-deep p-2">
                            <img id="thumbnail-preview" src="{{ $project->thumbnail_url }}" alt="Pratinjau thumbnail" class="aspect-[4/3] w-full object-cover" @if (! $project->thumbnail_url) hidden @endif>
                            @if (! $project->thumbnail_url)
                                <p class="py-6 text-center font-mono text-[9px] uppercase tracking-[0.12em] text-ink-faint" id="thumbnail-empty" data-preview-empty>Belum ada thumbnail</p>
                            @endif
                        </div>
                    </div>

                    <div>
                        <label for="live_url" class="label">URL hasil</label>
                        <input type="url" name="live_url" id="live_url" value="{{ old('live_url', $project->live_url) }}" class="field @error('live_url') field-error @enderror" placeholder="https://...">
                        @error('live_url') <p class="error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="repository_url" class="label">URL repositori</label>
                        <input type="url" name="repository_url" id="repository_url" value="{{ old('repository_url', $project->repository_url) }}" class="field @error('repository_url') field-error @enderror" placeholder="https://github.com/...">
                        @error('repository_url') <p class="error">{{ $message }}</p> @enderror
                    </div>
                </div>
            </section>

        </aside>
    </div>

    <div class="mt-8 flex flex-wrap items-center justify-between gap-3 border-t border-line pt-5">
        <div class="flex flex-wrap gap-2">
            <button type="submit" class="btn btn-primary cursor-pointer">Simpan project</button>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary cursor-pointer">Batal</a>
        </div>
        @if ($isEdit && $project->isPublished())
            <a href="{{ route('projects.show', $project) }}" class="font-mono text-[9px] uppercase tracking-[0.12em] text-cobalt hover:underline cursor-pointer" target="_blank" rel="noopener noreferrer">Lihat di situs ↗</a>
        @endif
    </div>
</form>

@if ($isEdit)
    <section class="sheet-flat mt-8">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-line bg-paper-deep px-4 py-3">
            <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-ink-faint">Galeri project</p>
            <span class="font-mono text-[9px] text-ink-faint">{{ $project->images->count() }} gambar</span>
        </div>
        <div class="p-4 sm:p-5">
            @if ($project->images->isNotEmpty())
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($project->images as $image)
                        <div class="border border-line bg-paper-deep p-2">
                            <img src="{{ $image->url }}" alt="{{ $image->alt_text ?: 'Gambar project' }}" class="aspect-[4/3] w-full object-cover" loading="lazy">
                            <form action="{{ route('admin.projects.images.destroy', [$project, $image]) }}" method="POST" data-confirm-form="admin-confirm-dialog" class="mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full border border-stamp/40 px-2 py-1 font-mono text-[9px] uppercase tracking-[0.1em] text-stamp hover:bg-stamp hover:text-paper-raised cursor-pointer">Hapus gambar</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-ink-soft">Belum ada gambar galeri.</p>
            @endif

            <form action="{{ route('admin.projects.images.store', $project) }}" method="POST" enctype="multipart/form-data" class="mt-5 border-t border-line pt-5">
                @csrf
                <label for="gallery" class="label">Tambah gambar</label>
                <input type="file" name="images[]" id="gallery" accept="image/jpeg,image/png,image/webp" multiple class="field file:mr-3 file:border-0 file:bg-ink file:px-3 file:py-1.5 file:font-mono file:text-[9px] file:uppercase file:tracking-[0.12em] file:text-paper-raised">
                <p class="help">Maksimal 8 gambar, 4 MB per file.</p>
                @error('images') <p class="error">{{ $message }}</p> @enderror
                @error('images.*') <p class="error">{{ $message }}</p> @enderror
                <button type="submit" class="btn btn-secondary mt-4 cursor-pointer">Unggah gambar</button>
            </form>
        </div>
    </section>
@else
    <div class="mt-8 border border-line bg-paper-deep p-4">
        <p class="text-sm text-ink-soft">Simpan project terlebih dahulu untuk menambahkan gambar galeri.</p>
    </div>
@endif

@if ($isEdit)
    <div class="mt-10 border border-stamp/30 bg-stamp-wash/40 p-4">
        <p class="font-mono text-[9px] uppercase tracking-[0.14em] text-stamp">Zona berbahaya</p>
        <div class="mt-3 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="max-w-xl text-sm leading-relaxed text-ink-soft">Hapus project beserta thumbnail dan gambar galerinya. Tindakan ini tidak bisa dibatalkan.</p>
            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" data-confirm-form="admin-confirm-dialog">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger cursor-pointer">Hapus project</button>
            </form>
        </div>
    </div>
@endif
