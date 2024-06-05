<?php

declare(strict_types=1);

use App\Models\Tag;
use App\Models\User;

use function Pest\Laravel\actingAs;

beforeEach(function () {
    User::factory()->create();
    \App\Models\Tag::factory()->create();
});

test('should update a tag', function () {
    $newName = fake()->text(10);
    $oldName = Tag::first()->name;
    $response = actingAs(User::first())
        ->put(
            route('tag.update', Tag::first()),
            [
                'name' => $newName,
            ]
        );

    $response->assertRedirect(route('tag.list'));
    $this->assertDatabaseCount('tags', 1);
    $this->assertDatabaseHas('tags', [
        'name' => $newName,
    ]);
    $this->assertDatabaseMissing('tags', [
        'name' => $oldName,
    ]);
});

test('should redirect to login if not authenticated', function () {
    $response = \Pest\Laravel\put(route('tag.update', Tag::first()), [
        'name' => fake()->text(10),
    ]);
    $response->assertRedirect(route('login'));
});

test('should throw 404 if tag not found', function () {
    $user = User::first();
    $nonExistentTagId = 9999;
    $response = \Pest\Laravel\actingAs($user)
        ->put(route('tag.update', $nonExistentTagId), [
            'name' => fake()->text(10),
        ]);
    $response->assertNotFound();
});

test('should throw validation error for required fields', function () {
    $response = actingAs(User::first())
        ->put(route('tag.update', Tag::first()));
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('tags', 1);
});

test('should throw validation error for max length', function () {
    $response = actingAs(User::first())
        ->put(route('tag.update', Tag::first()), [
            'name' => fake()->words(15),
        ]);
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('tags', 1);
});

test('should throw validation error for unique fields', function () {
    $tagAlreadyExists = Tag::first();
    $newTag = Tag::factory()->create();
    $response = actingAs(User::first())
        ->put(route('tag.update', $newTag), [
            'name' => $tagAlreadyExists->name,
        ]);
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('tags', 2);
});
