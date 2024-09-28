<?php

namespace App\Contracts;

interface FrontendServiceInterface
{
    public function getCurrentFrontend(): string;

    public function setCurrentFrontend(string $frontend): void;
}
