<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        if (!$request->user()->hasAnyRole(['admin', 'directeur', 'secretaire'])) {
            abort(403, 'Accès réservé à l\'administration.');
        }

        return $next($request);
    }
}