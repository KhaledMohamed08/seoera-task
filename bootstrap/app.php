<?php

use App\helpers\ApiResponse;
use App\Http\Middleware\ApiGuest;
use Illuminate\Foundation\Application;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'api.guest' => ApiGuest::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (ValidationException $e) {
            return ApiResponse::validationError($e->errors(), 'Invalid Data', 422);
        });
        $exceptions->render(function (QueryException $e) {
            return ApiResponse::error('An unexpected error occurred while processing your request. Please try again later.', 500, ['error' => $e->getMessage()]);
        });
        $exceptions->render(function (AuthenticationException $e) {
            return ApiResponse::unauthorized('You are not authenticated. Please log in to access this resource.', 401);
        });
    })->create();
