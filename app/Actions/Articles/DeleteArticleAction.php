<?php

declare(strict_types=1);

namespace App\Actions\Articles;

use App\Models\Article;

final class DeleteArticleAction
{
    public function delete(Article $article): void
    {
        $article->tags()->detach();
        $article->delete();
    }
}
