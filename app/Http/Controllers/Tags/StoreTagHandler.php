<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Actions\Tags\StoreTagAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\TagStoreRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class StoreTagHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(TagStoreRequest $request, StoreTagAction $storeTagAction): RedirectResponse
    {
        $storeTagAction->store($request->name);

        return redirect(route('tag.list'))
            ->with('status', 'Tag Has Been inserted');
    }
}
