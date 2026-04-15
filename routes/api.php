<?php

use App\Routes\AuthenticationRoutes;
use App\Routes\ProtectedRoutes;
use App\Routes\WebhookRoutes;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1')->group(function () {
    AuthenticationRoutes::register();
    ProtectedRoutes::register();
    WebhookRoutes::register();
});