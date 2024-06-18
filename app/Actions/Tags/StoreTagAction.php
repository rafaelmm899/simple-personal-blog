<?php

declare(strict_types=1);

namespace App\Actions\Tags;

use App\Models\Tag;

final class StoreTagAction
{
    public function store(string $name): void
    {
        $tag = new Tag();
        $tag->name = $name;
        $tag->save();
    }
}
