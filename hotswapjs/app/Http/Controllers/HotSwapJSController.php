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
        if ($request->has('frontend')) {
            $request->session()->put('frontend', $request->frontend);

            return redirect('/');
        }

        $frontend = $request->session()->get('frontend', 'welcome');

        return view($frontend);
    }
}
