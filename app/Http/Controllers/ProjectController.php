<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SiteProfile;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::query()
            ->published()
            ->orderByDesc('is_featured')
            ->ordered()
            ->get();

        return view('projects.index', [
            'profile' => SiteProfile::current(),
            'projects' => $projects,
            'categories' => $projects->pluck('category')->unique()->values(),
        ]);
    }

    public function show(Project $project): View
    {
        abort_unless($project->isPublished(), 404);

        $project->load('images');

        return view('projects.show', [
            'profile' => SiteProfile::current(),
            'project' => $project,
            'related' => Project::query()
                ->published()
                ->where('id', '!=', $project->getKey())
                ->ordered()
                ->take(2)
                ->get(),
        ]);
    }
}
