<?php

use App\Models\Category;
use App\Models\Project;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
});

test('admin category pages render', function () {
    $category = Category::factory()->create();

    $this->actingAs($this->admin)
        ->get(route('admin.categories.index'))
        ->assertOk();

    $this->actingAs($this->admin)
        ->get(route('admin.categories.create'))
        ->assertOk();

    $this->actingAs($this->admin)
        ->get(route('admin.categories.edit', $category))
        ->assertOk();
});

test('admin can create a category with an automatic slug', function () {
    $response = $this->actingAs($this->admin)
        ->post(route('admin.categories.store'), [
            'name' => 'Web App',
            'slug' => '',
            'sort_order' => 3,
        ]);

    $category = Category::query()->firstOrFail();

    $response->assertRedirect(route('admin.categories.index'));

    expect($category->name)->toBe('Web App')
        ->and($category->slug)->toBe('web-app')
        ->and($category->sort_order)->toBe(3);
});

test('admin category validation rejects incomplete and duplicate data', function () {
    Category::factory()->create([
        'name' => 'Web App',
        'slug' => 'web-app',
    ]);

    $this->actingAs($this->admin)
        ->post(route('admin.categories.store'), [])
        ->assertSessionHasErrors(['name', 'sort_order']);

    $this->actingAs($this->admin)
        ->post(route('admin.categories.store'), [
            'name' => 'Web App',
            'slug' => 'web-app',
            'sort_order' => 1,
        ])
        ->assertSessionHasErrors(['name', 'slug']);

    expect(Category::query()->count())->toBe(1);
});

test('admin can update a category', function () {
    $category = Category::factory()->create([
        'name' => 'Web App',
        'slug' => 'web-app',
        'sort_order' => 1,
    ]);

    $response = $this->actingAs($this->admin)
        ->patch(route('admin.categories.update', $category), [
            'name' => 'Aplikasi Web',
            'slug' => 'aplikasi-web',
            'sort_order' => 5,
        ]);

    $category->refresh();

    $response->assertRedirect(route('admin.categories.index'));

    expect($category->name)->toBe('Aplikasi Web')
        ->and($category->slug)->toBe('aplikasi-web')
        ->and($category->sort_order)->toBe(5);
});

test('admin can delete an unused category', function () {
    $category = Category::factory()->create();

    $this->actingAs($this->admin)
        ->delete(route('admin.categories.destroy', $category))
        ->assertRedirect(route('admin.categories.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseMissing('categories', ['id' => $category->id]);
});

test('admin cannot delete a category that is still used by a project', function () {
    $category = Category::factory()->create();
    Project::factory()->create(['category_id' => $category->id]);

    $this->actingAs($this->admin)
        ->from(route('admin.categories.index'))
        ->delete(route('admin.categories.destroy', $category))
        ->assertRedirect(route('admin.categories.index'))
        ->assertSessionHas('error');

    $this->assertDatabaseHas('categories', ['id' => $category->id]);
    $this->assertDatabaseHas('projects', ['category_id' => $category->id]);
});

test('category pages show the project count', function () {
    $category = Category::factory()->create(['name' => 'Web App']);
    Project::factory()->create(['category_id' => $category->id]);

    $this->actingAs($this->admin)
        ->get(route('admin.categories.index'))
        ->assertOk()
        ->assertSee('Web App')
        ->assertSee('1 project');

    $this->actingAs($this->admin)
        ->get(route('admin.categories.edit', $category))
        ->assertOk()
        ->assertSee('1 project');
});

test('non-admin users cannot manage categories', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.categories.index'))
        ->assertForbidden();

    $this->actingAs($user)
        ->post(route('admin.categories.store'), [
            'name' => 'Web App',
            'slug' => 'web-app',
            'sort_order' => 1,
        ])
        ->assertForbidden();

    expect(Category::query()->count())->toBe(0);
});
