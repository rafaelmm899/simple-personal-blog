<?php

declare(strict_types=1);

namespace App\Http\Controllers\Articles;

use App\Actions\Articles\StoreArticleAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\StoreArticleRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class StoreArticleHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreArticleRequest $request, StoreArticleAction $storeArticleAction): RedirectResponse
    {
        $data = $request->validated();

        $storeArticleAction->store(
            $data['title'],
            $data['content'],
            (int) $data['category'],
            $data['tags'],
            $data['image'] ?? null
        );

        return redirect(route('article.list'))
            ->with('status', 'Article Has Been inserted');
    }
}
