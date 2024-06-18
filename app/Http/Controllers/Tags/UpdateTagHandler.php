<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Actions\Tags\UpdateTagAction;
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
    public function __invoke(Tag $tag, TagUpdateRequest $request, UpdateTagAction $updateTagAction): RedirectResponse
    {
        $request->validated();

        $updateTagAction->update($tag, $request->name);

        return redirect(route('tag.list'))
            ->with('status', 'Tag Has Been updated');
    }
}
