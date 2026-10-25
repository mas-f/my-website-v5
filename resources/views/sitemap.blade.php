<?php echo '<?xml version="1.0" encoding="UTF-8"?>'."\n"; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ([
        ['url' => route('home'), 'priority' => '1.0'],
        ['url' => route('about'), 'priority' => '0.8'],
        ['url' => route('skills'), 'priority' => '0.7'],
        ['url' => route('projects.index'), 'priority' => '0.9'],
        ['url' => route('services'), 'priority' => '0.7'],
        ['url' => route('contact.create'), 'priority' => '0.6'],
    ] as $page)
        <url>
            <loc>{{ $page['url'] }}</loc>
            <changefreq>monthly</changefreq>
            <priority>{{ $page['priority'] }}</priority>
        </url>
    @endforeach

    @foreach ($projects as $project)
        <url>
            <loc>{{ route('projects.show', $project) }}</loc>
            <lastmod>{{ $project->updated_at->toAtomString() }}</lastmod>
            <changefreq>monthly</changefreq>
            <priority>0.8</priority>
        </url>
    @endforeach
</urlset>
