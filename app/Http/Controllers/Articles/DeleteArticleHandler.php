<?php

declare(strict_types=1);

namespace App\Http\Controllers\Articles;

use App\Actions\Articles\DeleteArticleAction;
use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class DeleteArticleHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Article $article, Request $request, DeleteArticleAction $deleteArticleAction): RedirectResponse
    {
        $deleteArticleAction->delete($article);

        return redirect(route('article.list'))
            ->with('status', 'Article Has Been deleted');
    }
}
