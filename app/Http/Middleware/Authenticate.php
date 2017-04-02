<?php

namespace App\Http\Middleware;

use Closure;

class Authenticate
{
    public function handle($request, Closure $next)
    {
        if (!isset($_SESSION['auth']) || !$_SESSION['auth']) {
            return redirect(route('login'));
        }

        return $next($request);
    }
}
