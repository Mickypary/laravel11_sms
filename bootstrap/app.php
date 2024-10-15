<?php

use App\Http\Middleware\Custom\Admin;
use App\Http\Middleware\Custom\SuperAdmin;
use App\Http\Middleware\Custom\Teacher;
use App\Http\Middleware\Custom\TeamSA;
use App\Http\Middleware\Custom\TeamSAT;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'super_admin' => SuperAdmin::class,
            'admin' => Admin::class,
            'teacher' => Teacher::class,
            'teamSA' => TeamSA::class,
            'teamSAT' => TeamSAT::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
