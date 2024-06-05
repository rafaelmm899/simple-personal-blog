<?php

declare(strict_types=1);

use App\Models\Tag;
use App\Models\User;

beforeEach(function () {
    User::factory()->create();

    Tag::factory()->create();
});

test('should display the edit tag page', function () {
    $user = User::first();
    $response = \Pest\Laravel\actingAs($user)
        ->get(route('tag.edit', ['tag' => Tag::first()]));

    $response->assertOk();
    $response->assertViewIs('tags.edit');
    $response->assertViewHas('tag');
});

test('should redirect to login if not authenticated', function () {
    $response = \Pest\Laravel\get(route('tag.edit', ['tag' => Tag::first()]));
    $response->assertRedirect(route('login'));
});

test('should throw 404 if tag not found', function () {
    $user = User::first();
    $nonExistentTagId = 9999;

    $response = \Pest\Laravel\actingAs($user)
        ->get(route('tag.edit', ['tag' => $nonExistentTagId]));

    $response->assertNotFound();
});
