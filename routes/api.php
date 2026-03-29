<?php

use App\Routes\WebhookRoutes;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebhookController;

Route::prefix('/v1')->group(function () {
    WebhookRoutes::register();
});