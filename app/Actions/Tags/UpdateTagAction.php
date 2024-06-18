<?php

declare(strict_types=1);

namespace App\Actions\Tags;

use App\Models\Tag;

final class UpdateTagAction
{
    public function update(Tag $tag, string $name): void
    {
        $tag->name = $name;
        $tag->save();
    }
}
