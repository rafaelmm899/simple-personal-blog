<?php

declare(strict_types=1);

use App\Models\User;

use function Pest\Laravel\get;

test('should display the create article page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->get(route('article.create'));

    $response->assertOk();
    $response->assertViewIs('articles.create');
    $response->assertViewHas('categories');
    $response->assertViewHas('tags');
});

test('should redirect to login if not authenticated', function () {
    $response = get(route('article.create'));

    $response->assertRedirect(route('login'));
});
