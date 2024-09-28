<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotSwapJSController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View|RedirectResponse
    {
        // TODO: make this a service
        $frontend = $request->session()->get('frontend', 'welcome');

        return view($frontend);
    }
}
