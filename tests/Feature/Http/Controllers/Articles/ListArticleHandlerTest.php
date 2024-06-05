<?php

declare(strict_types=1);

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('should display a list of articles', function () {
    Article::factory(5)
        ->for(Category::factory())
        ->has(Tag::factory()->count(3))
        ->create();

    $response = $this->get('/articles');

    $response->assertViewIs('articles.list');
    $response->assertStatus(200);
    $response->assertViewHas('articles');
});

test('should display a list of articles with pagination', function () {
    Article::factory(30)
        ->for(Category::factory())
        ->has(Tag::factory()->count(3))
        ->create();

    $response = $this->get('/articles');

    $response->assertViewIs('articles.list');
    $response->assertViewHas('articles');
    $response->assertViewHas('articles', function ($articles) {
        return 15 === $articles->count();
    });
});

test('should orders articles by creation date', function () {
    $articles = [
        Article::factory()->for(Category::factory())->create(['created_at' => now()->subDays(1)]),
        Article::factory()->for(Category::factory())->create(['created_at' => now()->subDays(2)]),
        Article::factory()->for(Category::factory())->create(['created_at' => now()->subDays(3)]),
    ];

    $response = $this->get('/articles');

    $response->assertStatus(200);
    $response->assertSeeInOrder([
        \Illuminate\Support\Str::of($articles[2]->title)->limit(50),
        \Illuminate\Support\Str::of($articles[1]->title)->limit(50),
        \Illuminate\Support\Str::of($articles[0]->title)->limit(50),
    ]);
});

test('should loads articles categories', function () {
    $articles = Article::factory(5)
        ->for(Category::factory())
        ->has(Tag::factory()->count(3))
        ->create();

    $response = $this->get('/articles');

    $response->assertStatus(200);

    foreach ($articles as $article) {
        $response->assertSee($article->category->name);
    }
});

test('Should not show the edit and delete articles buttons when the user is not logged in', function () {
    Article::factory(5)
        ->for(Category::factory())
        ->has(Tag::factory()->count(3))
        ->create();

    $response = $this->get('/articles');

    $response->assertStatus(200);
    $response->assertDontSee('Edit');
    $response->assertDontSee('Delete');
});

test('Should show the edit and delete articles buttons when the user is logged in', function () {
    Article::factory(5)
        ->for(Category::factory())
        ->has(Tag::factory()->count(3))
        ->create();

    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/articles');

    $response->assertStatus(200);
    $response->assertSee('Edit');
    $response->assertSee('Delete');
});
