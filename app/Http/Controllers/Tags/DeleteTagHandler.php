<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class DeleteTagHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Tag $tag, Request $request): RedirectResponse
    {
        if ($tag->articles->count() > 0) {
            return redirect(route('tag.list'))
                ->withErrors(['Tag Has Articles']);
        }

        $tag->delete();

        return redirect(route('tag.list'))
            ->with('status', 'Tag Has Been deleted');
    }
}
