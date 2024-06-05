<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\TagUpdateRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class UpdateTagHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Tag $tag, TagUpdateRequest $request): RedirectResponse
    {
        $request->validated();

        $tag->name = $request->name;
        $tag->save();

        return redirect(route('tag.list'))
            ->with('status', 'Tag Has Been updated');
    }
}
