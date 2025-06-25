<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {})
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(static function (ValidationException $exception, Request $request) {
            if ($request->wantsJson()) {
                return response()->json(['errors' => $exception->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            return htmx()->isRequest()
                ? response()->json(['errors' => $exception->errors()], Response::HTTP_UNPROCESSABLE_ENTITY)
                : back()->withErrors($exception->validator->errors());
        });
    })->create();
