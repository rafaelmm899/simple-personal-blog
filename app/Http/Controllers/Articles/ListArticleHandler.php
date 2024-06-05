<?php

declare(strict_types=1);

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class ListArticleHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $articles = Article::with('category')
            ->orderBy('created_at', 'asc')
            ->paginate(15);

        return view('articles.list', ['articles' => $articles]);
    }
}
