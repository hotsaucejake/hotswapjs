<?php

use App\Http\Controllers\HotSwapJSController;
use Illuminate\Support\Facades\Route;

Route::post('/set-frontend/{frontend}', function ($frontend) {
    session(['frontend' => $frontend]);
    return redirect('/');
})->name('set-frontend');

// This route captures all routes (/{any}) and passes them to the HotSwapJSController
// The where clause excludes any routes that start with api, allowing your API routes to function normally.
Route::any('/{any}', HotSwapJSController::class)->where('any', '^(?!api).*$')->name('home');

