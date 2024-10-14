<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\EnsureUserIsAdmin;
use App\Http\Middleware\EnsureUserIsAgent;
use App\Http\Middleware\EnsureUserIsPartenaire;
use App\Http\Middleware\EnsureUserIsSuperviseur;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(
            ['agent' => EnsureUserIsAgent::class,
             'admin' => EnsureUserIsAdmin::class,
             'partenaire' => EnsureUserIsPartenaire::class,
             'superviseur'=> EnsureUserIsSuperviseur::class  
            ]
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
