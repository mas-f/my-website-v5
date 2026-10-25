<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectImagesRequest;
use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ProjectImageController extends Controller
{
    public function store(StoreProjectImagesRequest $request, Project $project): RedirectResponse
    {
        $sort = (int) $project->images()->max('sort_order');

        foreach ($request->file('images') as $index => $image) {
            $project->images()->create([
                'image_path' => $image->store('projects/gallery', 'public'),
                'alt_text' => $project->title.' — gambar '.($sort + $index + 1),
                'sort_order' => $sort + $index + 1,
            ]);
        }

        return back()->with('success', 'Gambar galeri berhasil ditambahkan.');
    }

    public function destroy(Project $project, ProjectImage $image): RedirectResponse
    {
        abort_unless($image->project_id === $project->id, 404);

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Gambar galeri berhasil dihapus.');
    }
}
