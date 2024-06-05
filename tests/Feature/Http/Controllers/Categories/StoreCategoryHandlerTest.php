<?php

declare(strict_types=1);

use App\Models\User;

beforeEach(function () {
    User::factory()->create();
});

test('should create a new category', function () {
    $name = fake()->text(10);
    $response = $this
        ->actingAs(User::first())
        ->post(route('category.store'), [
            'name' => $name,
        ]);

    $response->assertRedirect(route('category.list'));
    $this->assertDatabaseCount('categories', 1);
    $this->assertDatabaseHas('categories', [
        'name' => $name,
    ]);
});

test('should redirect to login if not authenticated', function () {
    $response = \Pest\Laravel\post(route('category.store'), [
        'name' => fake()->text(10),
    ]);
    $response->assertRedirect(route('login'));
});

test('should throw validation error for required fields', function () {
    $response = $this
        ->actingAs(User::first())
        ->post(route('category.store'));
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('categories', 0);
});

test('should throw validation error for unique fields', function () {
    $category = \App\Models\Category::factory()->create();
    $response = $this
        ->actingAs(User::first())
        ->post(route('category.store'), [
            'name' => $category->name,
        ]);
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('categories', 1);
});

test('should throw validation error for max length', function () {
    $response = $this
        ->actingAs(User::first())
        ->post(route('category.store'), [
            'name' => fake()->words(15),
        ]);
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('categories', 0);
});
