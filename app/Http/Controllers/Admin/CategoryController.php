<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        return view('admin.categories.index', [
            'categories' => Category::query()
                ->withCount('projects')
                ->ordered()
                ->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.categories.create', [
            'category' => new Category([
                'sort_order' => min(9999, (int) Category::query()->max('sort_order') + 1),
            ]),
        ]);
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        Category::query()->create($this->categoryData($request));

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dibuat.');
    }

    public function edit(Category $category): View
    {
        $category->loadCount('projects');

        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($this->categoryData($request, $category));

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $count = $category->projects()->count();

        if ($count > 0) {
            return back()->with(
                'error',
                "Kategori masih dipakai oleh {$count} project. Pindahkan project ke kategori lain terlebih dahulu.",
            );
        }

        $category->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function categoryData(CategoryRequest $request, ?Category $category = null): array
    {
        $slug = $request->filled('slug')
            ? $request->string('slug')->toString()
            : $request->string('name')->toString();

        return [
            'name' => $request->string('name')->trim()->toString(),
            'slug' => $this->uniqueSlug($slug, $category?->id),
            'sort_order' => (int) $request->integer('sort_order'),
        ];
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'kategori';
        $slug = $base;
        $suffix = 2;

        while (Category::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $base.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}
