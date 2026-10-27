<?php

use App\Models\SiteProfile;

beforeEach(function () {
    SiteProfile::factory()->create();
});

test('public pages expose concise and unique meta descriptions', function () {
    $routes = [
        'home',
        'about',
        'skills',
        'projects.index',
        'services',
        'contact.create',
    ];

    $descriptions = [];

    foreach ($routes as $routeName) {
        $html = $this->get(route($routeName))->assertOk()->getContent();

        preg_match('/<meta name="description" content="([^"]*)"/', $html, $matches);

        expect($matches)->toHaveCount(2, "Meta description is missing on {$routeName}.");

        $description = trim(preg_replace('/\s+/', ' ', html_entity_decode($matches[1], ENT_QUOTES)));

        expect($description)->not->toBeEmpty();
        expect(mb_strlen($description))->toBeLessThanOrEqual(160);
        expect($description)->toContain('Fikri Amrullah');

        $descriptions[$routeName] = $description;
    }

    expect(array_unique($descriptions))->toHaveCount(count($routes));
});

test('about page describes interests and future goals with profile structured data', function () {
    $this->get(route('about'))
        ->assertOk()
        ->assertSee('Minat & tujuan')
        ->assertSee('Minat pada produk utuh')
        ->assertSee('Full-stack product building')
        ->assertSee('Tujuan ke depan')
        ->assertSee('Jangka pendek')
        ->assertSee('Jangka panjang')
        ->assertSee('application/ld+json', false)
        ->assertSee('ProfilePage', false)
        ->assertSee('knowsAbout', false);
});
