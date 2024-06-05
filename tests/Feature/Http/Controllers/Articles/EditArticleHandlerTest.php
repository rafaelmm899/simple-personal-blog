<?php

declare(strict_types=1);

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

use function Pest\Laravel\get;

beforeEach(function () {
    Article::factory(1)
        ->for(Category::factory())
        ->has(Tag::factory()->count(3))
        ->create();

    User::factory()->create();
});

test('should display the edit article page', function () {
    $user = User::first();

    $response = $this->actingAs($user)
        ->get(route('article.edit', Article::first()));

    $response->assertOk();
    $response->assertViewIs('articles.edit');
    $response->assertViewHas('categories');
    $response->assertViewHas('tags');
});

test('should redirect to login if not authenticated', function () {
    $response = get(route('article.edit', Article::first()));

    $response->assertRedirect(route('login'));
});

test('should throw 404 if article not found', function () {
    $user = User::first();
    $nonExistentArticleId = 9999;

    $response = $this->actingAs($user)
        ->get(route('article.edit', $nonExistentArticleId));

    $response->assertNotFound();
});
