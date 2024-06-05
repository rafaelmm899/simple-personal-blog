<?php

declare(strict_types=1);

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class EditCategoryHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category, Request $request): View
    {
        return view('categories.edit', ['category' => $category]);
    }
}
