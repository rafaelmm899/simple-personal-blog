<?php

declare(strict_types=1);

beforeEach(function () {
    \App\Models\Tag::factory(30)->create();
    \App\Models\User::factory()->create();
});

test('should list tags', function () {
    $response = $this->actingAs(\App\Models\User::first())
        ->get(route('tag.list'));

    $response->assertViewIs('tags.list');
    $response->assertOk();
    $response->assertViewHas('tags');
});

test('should list tags with pagination', function () {
    $response = $this->actingAs(\App\Models\User::first())
        ->get(route('tag.list'));

    $response->assertViewIs('tags.list');
    $response->assertViewHas('tags');
    $response->assertViewHas('tags', fn ($tags) => 15 === $tags->count());
});

test('should orders tags by creation date', function () {
    $tags = [
        \App\Models\Tag::factory()->create(['created_at' => now()->subDays(1)]),
        \App\Models\Tag::factory()->create(['created_at' => now()->subDays(2)]),
        \App\Models\Tag::factory()->create(['created_at' => now()->subDays(3)]),
    ];

    $response = $this->actingAs(\App\Models\User::first())
        ->get(route('tag.list'));

    $response->assertStatus(200);
    $response->assertSeeInOrder([
        \Illuminate\Support\Str::of($tags[2]->name)->limit(50),
        \Illuminate\Support\Str::of($tags[1]->name)->limit(50),
        \Illuminate\Support\Str::of($tags[0]->name)->limit(50),
    ]);
});

test('should redirect to login if not authenticated', function () {
    $response = $this->get(route('tag.list'));
    $response->assertRedirect(route('login'));
});
