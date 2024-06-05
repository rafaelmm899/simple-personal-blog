<?php

declare(strict_types=1);

namespace App\Http\Controllers\Articles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Articles\StoreArticleRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

final class StoreArticleHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreArticleRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $article = new Article;
        $article->title = $data['title'];
        $article->content = $data['content'];

        /** @var UploadedFile|null $file */
        $file = $request->file('image');
        if ($file) {
            $path = $file->store('images', 'public');
            $article->image_url = $path;
        }

        $article->category()->associate($data['category']);
        $article->save();

        $article->tags()->attach($data['tags']);

        $article->save();

        return redirect(route('article.list'))
            ->with('status', 'Article Has Been inserted');
    }
}
