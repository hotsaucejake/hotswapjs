<?php

namespace App\Services;

use App\Contracts\FrontendServiceInterface;

class FrontendService implements FrontendServiceInterface
{
    public function getCurrentFrontend(): string
    {
        return session('frontend', config('hotswapjs.default_frontend'));
    }

    public function setCurrentFrontend(string $frontend): void
    {
        session(['frontend' => $frontend]);
    }
}
