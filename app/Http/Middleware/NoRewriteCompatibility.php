<?php

/*
 * Copyright 2014-2017 Adrien 'Litarvan' Navratil
 *
 * This file is part of Slark.

 * Slark is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Slark is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with Slark.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Slark\Http\Middleware;

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