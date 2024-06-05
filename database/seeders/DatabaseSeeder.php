<?php

declare(strict_types=1);

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $category = Category::factory()
            ->create();

        $articles = Article::factory(10)
            ->for(Category::factory())
            ->has(Tag::factory()->count(3))
            ->create();
    }
}
