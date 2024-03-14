<?php

use App\Http\Controllers\API\SiteController;
use Illuminate\Support\Facades\Route;

Route::resource('site', SiteController::class, [
    'except' => ['index', 'create', 'edit']
]);

Route::get('/site/find-by-type', [SiteController::class, 'findByType']);
