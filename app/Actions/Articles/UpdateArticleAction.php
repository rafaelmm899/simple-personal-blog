<?php

declare(strict_types=1);

namespace App\Actions\Articles;

use App\Models\Article;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class UpdateArticleAction
{
    /**
     * @param  array<int>  $tags
     */
    public function update(
        Article $article,
        string $title,
        string $content,
        int $category,
        array $tags,
        ?UploadedFile $image
    ): void {
        $article->title = $title;
        $article->content = $content;
        $article->category()->associate($category);

        if ($image) {
            Storage::delete($article->image_url);
            $path = $image->store('images', 'public');
            $article->image_url = $path;
        }

        $article->save();

        $article->tags()->sync($tags);

        $article->save();
    }
}
