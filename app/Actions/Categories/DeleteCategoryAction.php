<?php

declare(strict_types=1);

namespace App\Actions\Categories;

use App\Models\Category;

final class DeleteCategoryAction
{
    public function delete(Category $category): void
    {
        $category->delete();
    }
}
