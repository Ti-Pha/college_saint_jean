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
    ->withMiddleware(function (Middleware $middleware) {
    // Middlewares Spatie Permission
    $middleware->alias([
        'role'             => \Spatie\Permission\Middleware\RoleMiddleware::class,
        'permission'       => \Spatie\Permission\Middleware\PermissionMiddleware::class,
        'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        'check.role'       => \App\Http\Middleware\CheckRole::class,
        'admin'            => \App\Http\Middleware\AdminMiddleware::class,
        'security.headers' => \App\Http\Middleware\SecurityHeaders::class,
    ]);

    // Appliquer les headers de sécurité à toutes les requêtes web
    $middleware->web(append: [
        \App\Http\Middleware\SecurityHeaders::class,
    ]);
})
    ->withExceptions(function (Exceptions $exceptions) {
        // Page 403 personnalisée
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e, $request) {
            return response()->view('errors.403', [], 403);
        });

        // Page 404 personnalisée
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            return response()->view('errors.404', [], 404);
        });
    })->create();