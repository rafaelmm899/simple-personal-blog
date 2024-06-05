<?php

declare(strict_types=1);

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class ListCategoryHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $categories = Category::query()
            ->orderBy('created_at', 'asc')
            ->paginate(15);

        return view('categories.list', ['categories' => $categories]);
    }
}
