<?php

declare(strict_types=1);

beforeEach(function () {
    \App\Models\Category::factory(30)
        ->create();
});

test('should display a list of categories', function () {
    $response = $this->get(route('category.list'));

    $response->assertViewIs('categories.list');
    $response->assertOk();
    $response->assertViewHas('categories');
});

test('should display a list of categories with pagination', function () {
    $response = $this->get(route('category.list'));

    $response->assertViewIs('categories.list');
    $response->assertViewHas('categories');
    $response->assertViewHas('categories', fn ($categories) => 15 === $categories->count());
});

test('should orders categories by creation date', function () {
    $categories = [
        \App\Models\Category::factory()->create(['created_at' => now()->subDays(1)]),
        \App\Models\Category::factory()->create(['created_at' => now()->subDays(2)]),
        \App\Models\Category::factory()->create(['created_at' => now()->subDays(3)]),
    ];

    $response = $this->get(route('category.list'));

    $response->assertStatus(200);
    $response->assertSeeInOrder([
        \Illuminate\Support\Str::of($categories[2]->name)->limit(50),
        \Illuminate\Support\Str::of($categories[1]->name)->limit(50),
        \Illuminate\Support\Str::of($categories[0]->name)->limit(50),
    ]);
});
