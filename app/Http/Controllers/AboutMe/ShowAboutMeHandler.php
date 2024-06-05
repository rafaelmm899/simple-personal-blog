<?php

declare(strict_types=1);

namespace App\Http\Controllers\AboutMe;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

final class ShowAboutMeHandler extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        return view('about-me');
    }
}
