<?php

declare(strict_types=1);

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

beforeEach(function () {
    Article::factory(1)
        ->for(Category::factory())
        ->has(Tag::factory()->count(3))
        ->create();

    User::factory()->create();
});

test('should delete an article', function () {
    $response = \Pest\Laravel\actingAs(User::first())
        ->delete(route('article.delete', Article::first()));

    $response->assertRedirect(route('article.list'));
    $this->assertDatabaseCount('articles', 0);
});

test('should throw 404 if article not found', function () {
    $response = \Pest\Laravel\actingAs(User::first())
        ->delete(route('article.delete', 9999));
    $response->assertNotFound();
});

test('should redirect to login if not authenticated', function () {
    $response = \Pest\Laravel\delete(route('article.delete', Article::first()));
    $response->assertRedirect(route('login'));
});
