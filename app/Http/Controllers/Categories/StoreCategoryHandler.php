<?php

declare(strict_types=1);

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class StoreCategoryHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(CategoryStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $category = new Category($data);
        $category->save();

        return redirect(route('category.list'))
            ->with('status', 'Category Has Been inserted');
    }
}
