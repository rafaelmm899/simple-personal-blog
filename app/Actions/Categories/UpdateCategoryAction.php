<?php

declare(strict_types=1);

namespace App\Actions\Categories;

use App\Models\Category;

final class UpdateCategoryAction
{
    public function update(Category $category, string $name): void
    {
        $category->name = $name;
        $category->save();
    }
}
