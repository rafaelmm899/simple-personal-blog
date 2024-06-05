<?php

use App\Models\Tag;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;

beforeEach(function (){
   User::factory()->create();
   Tag::factory()->create();
});

test('should delete a category', function () {
    $response = actingAs(User::first())
        ->delete(route('tag.delete', Tag::first()));

    $response->assertRedirect(route('tag.list'));
    $this->assertDatabaseCount('tags', 0);
});

test('should throw 404 if tag not found', function () {
    $response = actingAs(User::first())
        ->delete(route('tag.delete', 9999));
    $response->assertNotFound();
});

test('should redirect to login if not authenticated', function () {
    $response = delete(route('tag.delete', Tag::first()));
    $response->assertRedirect(route('login'));
});
