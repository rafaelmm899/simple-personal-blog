<?php

declare(strict_types=1);

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class EditArticleHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Article $article, Request $request): View
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('articles.edit', ['article' => $article, 'categories' => $categories, 'tags' => $tags]);
    }
}
