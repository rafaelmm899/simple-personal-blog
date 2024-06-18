<?php

declare(strict_types=1);

namespace App\Http\Controllers\Categories;

use App\Actions\Categories\UpdateCategoryAction;
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
    public function __invoke(Category $category, CategoryUpdateRequest $request, UpdateCategoryAction $updateCategoryAction): RedirectResponse
    {
        $request->validated();

        $updateCategoryAction->update($category, $request->name);

        return redirect(route('category.list'))
            ->with('status', 'Category Has Been updated');
    }
}
