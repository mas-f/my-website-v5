<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $projects = Project::query()
            ->published()
            ->ordered()
            ->get();

        return response()
            ->view('sitemap', [
                'projects' => $projects,
            ])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
