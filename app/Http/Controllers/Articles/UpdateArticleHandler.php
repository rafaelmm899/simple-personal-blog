<?php

declare(strict_types=1);

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

final class UpdateArticleHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Article $article, UpdateArticleRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $article->title = $data['title'];
        $article->content = $data['content'];
        $article->category()->associate($data['category']);

        $file = $request->file('image');
        if ($file) {
            Storage::delete($article->image_url);
            $path = $file->store('images', 'public');
            $article->image_url = $path;
        }

        $article->save();

        $article->tags()->sync($data['tags']);

        $article->save();

        return redirect(route('article.list'))
            ->with('status', 'Article Has Been updated');
    }
}
