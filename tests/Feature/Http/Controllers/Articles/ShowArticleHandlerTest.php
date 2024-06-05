<?php

declare(strict_types=1);

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;

use function Pest\Laravel\get;

beforeEach(function () {
    Article::factory(1)
        ->for(Category::factory())
        ->has(Tag::factory()->count(3))
        ->create();
});

test('should display a detail of an article', function () {
    $response = get(route('article.detail', Article::first()));

    $response->assertOk();
    $response->assertViewIs('articles.detail');
    $response->assertViewHas('article');
});

test('should throw 404 if article not found', function () {
    $nonExistentArticleId = 9999;

    $response = get(route('article.detail', $nonExistentArticleId));

    $response->assertNotFound();
});
