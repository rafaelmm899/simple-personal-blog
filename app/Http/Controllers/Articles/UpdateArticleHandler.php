<?php

declare(strict_types=1);

namespace App\Http\Controllers\Articles;

use App\Actions\Articles\UpdateArticleAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class UpdateArticleHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Article $article, UpdateArticleRequest $request, UpdateArticleAction $updateArticleAction): RedirectResponse
    {
        $data = $request->validated();

        $updateArticleAction->update(
            $article,
            $data['title'],
            $data['content'],
            (int) $data['category'],
            $data['tags'],
            $data['image'] ?? null
        );

        return redirect(route('article.list'))
            ->with('status', 'Article Has Been updated');
    }
}
