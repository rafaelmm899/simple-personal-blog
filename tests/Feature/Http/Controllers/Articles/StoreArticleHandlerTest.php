<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    \App\Models\Category::factory(1)
        ->create();

    \App\Models\Tag::factory(3)
        ->create();
});

test('should store an article', function () {

    $title = fake()->title();

    $user = User::factory()->create();

    $response = $this->actingAs($user)->post(route('article.store'), [
        'title' => $title,
        'content' => fake()->text(),
        'category' => \App\Models\Category::first()->id,
        'tags' => \App\Models\Tag::all()->pluck('id')->toArray(),
        'image' => null,
    ]);

    $response->assertRedirect(route('article.list'));

    $this->assertDatabaseCount('articles', 1);

    $this->assertDatabaseHas('articles', [
        'title' => $title,
        'category_id' => \App\Models\Category::first()->id,
    ]);
});

test('should redirect to login if not authenticated', function () {
    $data = [
        'title' => fake()->title(),
        'content' => fake()->text(),
        'category' => \App\Models\Category::first()->id,
        'tags' => \App\Models\Tag::all()->pluck('id')->toArray(),
        'image' => null,
    ];

    $response = \Pest\Laravel\post(route('article.store'), $data);

    $response->assertRedirect(route('login'));
    $response->assertSessionMissing('status');

    $this->assertDatabaseMissing('articles', $data);
});

test('should store image if provided', function () {
    $user = User::factory()->create();

    Storage::fake('public');

    $file = UploadedFile::fake()->image('article.png', 300, 300);

    $response = $this->actingAs($user)->post(route('article.store'), [
        'title' => fake()->title(),
        'content' => fake()->text(),
        'category' => \App\Models\Category::first()->id,
        'tags' => \App\Models\Tag::all()->pluck('id')->toArray(),
        'image' => $file,
    ]);

    $this->assertDatabaseCount('articles', 1);
    $response->assertRedirect(route('article.list'));

    Storage::disk('public')->assertExists('images/' . $file->hashName());
});

test('should throw validation error for required fields', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->post(route('article.store'));

    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('articles', 0);
});

test('should throw validation error for invalid category', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->post(route('article.store'), [
        'title' => fake()->title(),
        'content' => fake()->text(),
        'category' => 'invalid',
        'tags' => \App\Models\Tag::all()->pluck('id')->toArray(),
        'image' => null,
    ]);

    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('articles', 0);
});

test('should throw validation error for invalid tags', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->post(route('article.store'), [
        'title' => fake()->title(),
        'content' => fake()->text(),
        'category' => \App\Models\Category::first()->id,
        'tags' => ['invalid'],
        'image' => null,
    ]);

    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('articles', 0);
});

test('should throw validation error for invalid image', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->post(route('article.store'), [
        'title' => fake()->title(),
        'content' => fake()->text(),
        'category' => \App\Models\Category::first()->id,
        'tags' => \App\Models\Tag::all()->pluck('id')->toArray(),
        'image' => 'invalid',
    ]);

    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('articles', 0);
});
