<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;

class NoRewriteCompatibility
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (!has_rewrite() && $response instanceof RedirectResponse)
        {
            $base = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            $target = $response->getTargetUrl();

            if (starts_with($target, $base) && !starts_with($target, $base . 'index.php'))
            {
                $response->setTargetUrl($base . 'index.php/' . substr($target, strlen($base)));
            }
        }

        return $response;
    }
}