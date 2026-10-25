<?php

use App\Http\Controllers\LandingPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', LandingPageController::class)
    ->withoutMiddleware('web')
    ->middleware('cache.headers:public;max_age=300;s_maxage=86400;etag')
    ->name('landing');
