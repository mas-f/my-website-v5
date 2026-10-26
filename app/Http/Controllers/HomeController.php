<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\SiteProfile;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.home', [
            'profile' => SiteProfile::current(),
            'projects' => Project::query()
                ->with('category')
                ->published()
                ->orderByDesc('is_featured')
                ->ordered()
                ->take(4)
                ->get(),
        ]);
    }
}
