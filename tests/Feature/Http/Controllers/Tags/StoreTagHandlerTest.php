<?php


use App\Models\User;

beforeEach(function (){
    User::factory()->create();
});

test('should store a new tag', function () {
    $name = fake()->text(10);
    $response = $this
        ->actingAs(User::first())
        ->post(route('tag.store'), [
            'name' => $name,
        ]);

    $response->assertRedirect(route('tag.list'));
    $this->assertDatabaseCount('tags', 1);
    $this->assertDatabaseHas('tags', [
        'name' => $name,
    ]);
});

test('should redirect to login if not authenticated', function () {
    $response = \Pest\Laravel\post(route('tag.store'), [
        'name' => fake()->text(10),
    ]);
    $response->assertRedirect(route('login'));
});

test('should throw validation error for required fields', function () {
    $response = $this
        ->actingAs(User::first())
        ->post(route('tag.store'));
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('tags', 0);
});

test('should throw validation error for unique fields', function () {
    $tag = \App\Models\Tag::factory()->create();
    $response = $this
        ->actingAs(User::first())
        ->post(route('tag.store'), [
            'name' => $tag->name,
        ]);
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('tags', 1);
});

test('should throw validation error for max length', function () {
    $response = $this
        ->actingAs(User::first())
        ->post(route('tag.store'), [
            'name' => fake()->words(15),
        ]);
    $response->assertSessionHasErrors();
    $this->assertDatabaseCount('tags', 0);
});


