<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\User;

beforeEach(function () {
    User::factory()->create();

    Category::factory()->create();
});

test('should display the edit category page', function () {
    $user = User::first();
    $response = \Pest\Laravel\actingAs($user)
        ->get(route('category.edit', ['category' => Category::first()]));

    $response->assertOk();
    $response->assertViewIs('categories.edit');
    $response->assertViewHas('category');
});

test('should redirect to login if not authenticated', function () {
    $response = \Pest\Laravel\get(route('category.edit', ['category' => Category::first()]));
    $response->assertRedirect(route('login'));
});

test('should throw 404 if category not found', function () {
    $user = User::first();
    $nonExistentCategoryId = 9999;

    $response = \Pest\Laravel\actingAs($user)
        ->get(route('category.edit', ['category' => $nonExistentCategoryId]));

    $response->assertNotFound();
});
