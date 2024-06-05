<?php

declare(strict_types=1);

use App\Models\Category;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;

beforeEach(function () {
    User::factory()->create();
    Category::factory()->create();
});

test('should delete a category', function () {
    $response = actingAs(User::first())
        ->delete(route('category.delete', Category::first()));

    $response->assertRedirect(route('category.list'));
    $this->assertDatabaseCount('categories', 0);
});

test('should throw 404 if category not found', function () {
    $response = actingAs(User::first())
        ->delete(route('category.delete', 9999));
    $response->assertNotFound();
});

test('should redirect to login if not authenticated', function () {
    $response = delete(route('category.delete', Category::first()));
    $response->assertRedirect(route('login'));
});
