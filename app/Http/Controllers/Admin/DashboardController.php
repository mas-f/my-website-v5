<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Project;
use App\Models\SiteProfile;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'profile' => SiteProfile::current(),
            'stats' => [
                'projects' => Project::query()->count(),
                'published' => Project::query()->published()->count(),
                'drafts' => Project::query()->where('status', 'draft')->count(),
                'unread' => ContactMessage::query()->unread()->count(),
            ],
            'recentProjects' => Project::query()->latest()->take(5)->get(),
            'recentMessages' => ContactMessage::query()->latest()->take(5)->get(),
        ]);
    }
}
