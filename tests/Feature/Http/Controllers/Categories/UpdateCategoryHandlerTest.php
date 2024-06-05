<?php

use App\Models\Category;
use App\Models\User;
use function Pest\Laravel\actingAs;

beforeEach(function (){
    User::factory()->create();
    Category::factory()->create();
});

test('should update a category', function () {
    $newName = fake()->text(10);
    $oldName = Category::first()->name;
    $response = actingAs(User::first())
        ->put(
            route('category.update',Category::first()),
            [
                'name' => $newName,
            ]
        );

    $response->assertRedirect(route('category.list'));
    $this->assertDatabaseCount('categories', 1);
    $this->assertDatabaseHas('categories', [
        'name' => $newName,
    ]);
    $this->assertDatabaseMissing('categories', [
        'name' => $oldName,
    ]);
});

test('should redirect to login if not authenticated', function () {
    $response = \Pest\Laravel\put(route('category.update', Category::first()), [
        'name' => fake()->text(10),
    ]);
    $response->assertRedirect(route('login'));
});

test('should throw 404 if category not found', function () {
    $user = User::first();
    $nonExistentCategoryId = 9999;
    $response = \Pest\Laravel\actingAs($user)
        ->put(route('category.update', $nonExistentCategoryId), [
            'name' => fake()->text(10),
        ]);
    $response->assertNotFound();
});

test('should throw validation error for required fields', function () {
    $response = actingAs(User::first())
        ->put(route('category.update', Category::first()));
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('categories', 1);
});

test('should throw validation error for max length', function () {
    $response = actingAs(User::first())
        ->put(route('category.update', Category::first()), [
            'name' => fake()->words(15),
        ]);
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('categories', 1);
});

test('should throw validation error for unique fields', function () {
    $categoryAlreadyExists = Category::first();
    $newCategory = Category::factory()->create();
    $response = actingAs(User::first())
        ->put(route('category.update', $newCategory), [
            'name' => $categoryAlreadyExists->name,
        ]);
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('categories', 2);
});
