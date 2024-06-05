<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class ListTagHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        $tags = Tag::query()->orderBy('created_at', 'asc')->paginate(15);

        return view('tags.list', ['tags' => $tags]);
    }
}
