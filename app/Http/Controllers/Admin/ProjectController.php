<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ProjectStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(Request $request): View
    {
        $projects = Project::query()
            ->withCount('images')
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')))
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = '%'.$request->string('q')->trim().'%';

                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', $search)
                        ->orWhere('summary', 'like', $search)
                        ->orWhere('category', 'like', $search);
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.projects.index', [
            'projects' => $projects,
        ]);
    }

    public function create(): View
    {
        return view('admin.projects.create', [
            'project' => new Project([
                'status' => ProjectStatus::Draft,
                'sort_order' => (int) Project::query()->max('sort_order') + 1,
            ]),
            'categories' => $this->categories(),
            'statuses' => ProjectStatus::cases(),
        ]);
    }

    public function store(ProjectRequest $request): RedirectResponse
    {
        $project = Project::query()->create($this->projectData($request));

        $this->storeThumbnail($request, $project);
        $this->storeGallery($request, $project);

        return redirect()
            ->route('admin.projects.edit', $project)
            ->with('success', 'Project berhasil dibuat.');
    }

    public function show(Project $project): View
    {
        $project->load('images');

        return view('admin.projects.show', [
            'project' => $project,
        ]);
    }

    public function edit(Project $project): View
    {
        $project->load('images');

        return view('admin.projects.edit', [
            'project' => $project,
            'categories' => $this->categories(),
            'statuses' => ProjectStatus::cases(),
        ]);
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $project->update($this->projectData($request, $project));

        $this->storeThumbnail($request, $project);
        $this->storeGallery($request, $project);

        return redirect()
            ->route('admin.projects.edit', $project)
            ->with('success', 'Project berhasil diperbarui.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $paths = $project->images->pluck('image_path')->all();

        if ($project->thumbnail_path) {
            $paths[] = $project->thumbnail_path;
        }

        $project->delete();

        if ($paths !== []) {
            Storage::disk('public')->delete($paths);
        }

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }

    /**
     * @return array<string, mixed>
     */
    private function projectData(ProjectRequest $request, ?Project $project = null): array
    {
        $status = ProjectStatus::from($request->string('status')->toString());
        $slug = $request->filled('slug')
            ? $request->string('slug')->toString()
            : $request->string('title')->toString();

        return [
            'title' => $request->string('title')->toString(),
            'slug' => $this->uniqueSlug($slug, $project?->id),
            'summary' => $request->string('summary')->toString(),
            'description' => $request->string('description')->toString(),
            'problem_statement' => $request->input('problem_statement'),
            'solution' => $request->input('solution'),
            'category' => $request->string('category')->toString(),
            'features' => $this->lines($request->input('features')),
            'technologies' => $this->lines($request->input('technologies'), true),
            'live_url' => $request->input('live_url'),
            'repository_url' => $request->input('repository_url'),
            'status' => $status,
            'is_featured' => $request->boolean('is_featured'),
            'is_placeholder' => $request->boolean('is_placeholder'),
            'sort_order' => (int) $request->integer('sort_order'),
            'published_at' => $status === ProjectStatus::Published
                ? ($project?->published_at ?? now())
                : null,
        ];
    }

    private function storeThumbnail(ProjectRequest $request, Project $project): void
    {
        if (! $request->hasFile('thumbnail')) {
            return;
        }

        if ($project->thumbnail_path) {
            Storage::disk('public')->delete($project->thumbnail_path);
        }

        $project->update([
            'thumbnail_path' => $request->file('thumbnail')->store('projects/thumbnails', 'public'),
        ]);
    }

    private function storeGallery(ProjectRequest $request, Project $project): void
    {
        if (! $request->hasFile('gallery')) {
            return;
        }

        $sort = (int) $project->images()->max('sort_order');

        foreach ($request->file('gallery') as $index => $image) {
            $project->images()->create([
                'image_path' => $image->store('projects/gallery', 'public'),
                'alt_text' => $project->title.' — gambar '.($sort + $index + 1),
                'sort_order' => $sort + $index + 1,
            ]);
        }
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'project';
        $slug = $base;
        $suffix = 2;

        while (Project::query()
            ->where('slug', $slug)
            ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = $base.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }

    /**
     * @return array<int, string>
     */
    private function lines(?string $value, bool $splitCommas = false): array
    {
        $pattern = $splitCommas ? '/\r\n|\r|\n|,/' : '/\r\n|\r|\n/';

        return collect(preg_split($pattern, $value ?? ''))
            ->map(fn (string $line): string => trim($line))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    /**
     * @return array<int, string>
     */
    private function categories(): array
    {
        return Project::query()
            ->distinct()
            ->orderBy('category')
            ->pluck('category')
            ->filter()
            ->values()
            ->all();
    }
}
