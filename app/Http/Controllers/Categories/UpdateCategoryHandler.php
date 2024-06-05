<?php

declare(strict_types=1);

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class UpdateCategoryHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category, CategoryUpdateRequest $request): RedirectResponse
    {
        $request->validated();

        $category->name = $request->name;
        $category->save();

        return redirect(route('category.list'))
            ->with('status', 'Category Has Been updated');
    }
}
