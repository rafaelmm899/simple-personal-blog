<?php

declare(strict_types=1);

namespace App\Http\Controllers\Categories;

use App\Actions\Categories\StoreCategoryAction;
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
    public function __invoke(CategoryStoreRequest $request, StoreCategoryAction $storeCategoryAction): RedirectResponse
    {
        $data = $request->validated();

        $storeCategoryAction->store($data['name']);

        return redirect(route('category.list'))
            ->with('status', 'Category Has Been inserted');
    }
}
