<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class EditTagHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Tag $tag, Request $request): View
    {
        return view('tags.edit', ['tag' => $tag]);
    }
}
