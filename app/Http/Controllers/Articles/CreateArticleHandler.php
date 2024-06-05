<?php

declare(strict_types=1);

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class CreateArticleHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $categories = Category::all();

        $tags = Tag::all();

        return view('articles.create', ['categories' => $categories, 'tags' => $tags]);
    }
}
