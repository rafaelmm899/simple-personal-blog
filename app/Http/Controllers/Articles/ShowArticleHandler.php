<?php

declare(strict_types=1);

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class ShowArticleHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Article $article, Request $request): View
    {
        return view('articles.detail', ['article' => $article]);
    }
}
