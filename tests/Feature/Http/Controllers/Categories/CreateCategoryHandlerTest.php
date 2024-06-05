<?php

declare(strict_types=1);

use App\Models\User;

test('should display the create category page', function () {
    $user = User::factory()->create();
    $response = \Pest\Laravel\actingAs($user)->get(route('category.create'));

    $response->assertOk();
    $response->assertViewIs('categories.create');
});

test('should redirect to login if not authenticated', function () {
    $response = \Pest\Laravel\get(route('category.create'));
    $response->assertRedirect(route('login'));
});
