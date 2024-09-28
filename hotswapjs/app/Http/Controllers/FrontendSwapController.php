<?php

namespace App\Http\Controllers;

use App\Http\Requests\FrontendSwapRequest;
use Illuminate\Http\RedirectResponse;

class FrontendSwapController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(FrontendSwapRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // TODO: make this a service
        session(['frontend' => $validated['frontend']]);

        return redirect()->route('home', ['any' => '/']);
    }
}
