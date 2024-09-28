<?php

namespace App\Http\Controllers;

use App\Contracts\FrontendServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotSwapJSController extends Controller
{
    private FrontendServiceInterface $frontendService;

    public function __construct(FrontendServiceInterface $frontendService)
    {
        $this->frontendService = $frontendService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View|RedirectResponse
    {
        $frontend = $this->frontendService->getCurrentFrontend();

        return view($frontend);
    }
}
