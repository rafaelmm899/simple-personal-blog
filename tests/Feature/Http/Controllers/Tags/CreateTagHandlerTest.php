<?php

declare(strict_types=1);

use App\Models\User;

test('should display the create tag page', function () {
    $user = User::factory()->create();
    $response = \Pest\Laravel\actingAs($user)->get(route('tag.create'));

    $response->assertOk();
    $response->assertViewIs('tags.create');
});

test('should redirect to login if not authenticated', function () {
    $response = \Pest\Laravel\get(route('tag.create'));
    $response->assertRedirect(route('login'));
});
