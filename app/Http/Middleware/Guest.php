<?php

namespace App\Http\Middleware;

use Closure;

class Guest
{
    public function handle($request, Closure $next)
    {
        if (isset($_SESSION['auth']) && $_SESSION['auth']) {
            return redirect(route('home'));
        }

        return $next($request);
    }
}
