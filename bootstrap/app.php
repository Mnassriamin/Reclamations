<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Router;
use Illuminate\Routing\AliasRegistrar;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\TechnicianMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => EnsureIsAdmin::class,
            'tech'  => TechnicianMiddleware::class, 
        ]);
     })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
