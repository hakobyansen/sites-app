<?php

use App\Http\Controllers\API\V1\SiteController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('site/find-by-type', [SiteController::class, 'findByType']);

    Route::resource('site', SiteController::class, [
        'except' => ['index', 'create', 'edit']
    ]);
});

