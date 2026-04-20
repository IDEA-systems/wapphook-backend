<?php

use App\Routes\IndependentRoutes;
use App\Routes\ProtectedRoutes;
use App\Routes\WebhookRoutes;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    IndependentRoutes::register();
    ProtectedRoutes::register();
    WebhookRoutes::register();
});