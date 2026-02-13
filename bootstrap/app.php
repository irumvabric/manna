<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\LocaleMiddleware::class,
        ]);

        $middleware->alias([
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
            'isDonator' => \App\Http\Middleware\IsDonator::class,
            'isBlogger' => \App\Http\Middleware\IsBlogger::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
