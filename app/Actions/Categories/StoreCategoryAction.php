<?php

declare(strict_types=1);

namespace App\Actions\Categories;

use App\Models\Category;

final class StoreCategoryAction
{
    public function store(string $name): void
    {
        $category = new Category();
        $category->name = $name;
        $category->save();
    }
}
