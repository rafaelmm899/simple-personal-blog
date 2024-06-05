<?php

declare(strict_types=1);

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    Article::factory(1)
        ->for(Category::factory())
        ->has(Tag::factory()->count(3))
        ->create();

    User::factory()->create();
});

test('should update an article', function () {

    $title = fake()->title();
    $content = fake()->text();
    $newCategory = Category::factory()->create();
    $newTags = Tag::factory(3)->create();

    $response = $this->actingAs(User::first())
        ->put(route('article.update', Article::first()), [
            'title' => $title,
            'content' => $content,
            'category' => $newCategory->id,
            'tags' => $newTags->pluck('id')->toArray(),
            'image' => null,
        ]);

    $response->assertRedirect(route('article.list'));
    $this->assertDatabaseHas('articles', [
        'title' => $title,
        'content' => $content,
        'category_id' => $newCategory->id,
    ]);
});

test('should redirect to login if not authenticated', function () {
    $response = \Pest\Laravel\put(route('article.update', Article::first()), [
        'title' => fake()->title(),
        'content' => fake()->text(),
        'category' => \App\Models\Category::first()->id,
        'tags' => \App\Models\Tag::all()->pluck('id')->toArray(),
        'image' => null,
    ]);
    $response->assertRedirect(route('login'));
});

test('should throw validation error for required fields', function () {
    $response = $this->actingAs(User::first())->put(route('article.update', Article::first()));
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('articles', 1);
});

test('should throw validation error for invalid category', function () {
    $response = $this->actingAs(User::first())->put(route('article.update', Article::first()), [
        'category' => 9999,
    ]);
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('articles', 1);
});

test('should throw validation error for invalid tags', function () {
    $response = $this->actingAs(User::first())->put(route('article.update', Article::first()), [
        'tags' => ['invalid'],
    ]);
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('articles', 1);
});

test('should update image if provided', function () {
    Storage::fake('public');

    $oldFile = Article::first()->image_url;
    $newFile = UploadedFile::fake()->image('article2.png', 300, 300);

    $response = $this->actingAs(User::first())
        ->put(route('article.update', Article::first()), [
            'title' => fake()->title(),
            'content' => fake()->text(),
            'category' => \App\Models\Category::first()->id,
            'tags' => \App\Models\Tag::all()->pluck('id')->toArray(),
            'image' => $newFile,
        ]);

    $this->assertDatabaseCount('articles', 1);
    $response->assertRedirect(route('article.list'));

    Storage::disk('public')->assertExists('images/' . $newFile->hashName());
    Storage::disk('public')->assertMissing($oldFile);
});

test('should throw 404 if article not found', function () {
    $response = $this->actingAs(User::first())
        ->put(route('article.update', 9999), [
            'title' => fake()->title(),
            'content' => fake()->text(),
            'category' => \App\Models\Category::first()->id,
            'tags' => \App\Models\Tag::all()->pluck('id')->toArray(),
            'image' => null,
        ]);
    $response->assertNotFound();
});
