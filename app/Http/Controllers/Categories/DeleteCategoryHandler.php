<?php

declare(strict_types=1);

namespace App\Http\Controllers\Categories;

use App\Actions\Categories\DeleteCategoryAction;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class DeleteCategoryHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Category $category, Request $request, DeleteCategoryAction $deleteCategoryAction): RedirectResponse
    {
        if ($category->articles->count() > 0) {
            return redirect(route('category.list'))
                ->withErrors(['Category Has Articles']);
        }

        $deleteCategoryAction->delete($category);

        return redirect(route('category.list'))
            ->with('status', 'Category Has Been deleted');
    }
}
