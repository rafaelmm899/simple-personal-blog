<?php

declare(strict_types=1);

namespace App\Actions\Articles;

use App\Models\Article;
use Illuminate\Http\UploadedFile;

final class StoreArticleAction
{
    /**
     * @param  array<int>  $tags
     */
    public function store(string $title, string $content, int $category, array $tags, ?UploadedFile $image): void
    {
        $article = new Article;
        $article->title = $title;
        $article->content = $content;

        if ($image) {
            $path = $image->store('images', 'public');
            $article->image_url = $path;
        }

        $article->category()->associate($category);
        $article->save();

        $article->tags()->attach($tags);

        $article->save();
    }
}
