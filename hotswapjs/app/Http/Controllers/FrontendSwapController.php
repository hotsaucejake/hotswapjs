<?php

namespace App\Http\Controllers;

use App\Contracts\FrontendServiceInterface;
use App\Http\Requests\FrontendSwapRequest;
use Illuminate\Http\RedirectResponse;

class FrontendSwapController extends Controller
{
    private FrontendServiceInterface $frontendService;

    public function __construct(FrontendServiceInterface $frontendService)
    {
        $this->frontendService = $frontendService;
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(FrontendSwapRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $this->frontendService->setCurrentFrontend($validated['frontend']);

        return redirect()->route('home', ['any' => '/']);
    }
}
