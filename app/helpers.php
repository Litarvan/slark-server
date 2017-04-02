<?php

if (!function_exists('urlGenerator')) {
    /**
     * @return \Laravel\Lumen\Routing\UrlGenerator
     */
    function urlGenerator() {
        return new \Laravel\Lumen\Routing\UrlGenerator(app());
    }
}

if (!function_exists('asset')) {
    /**
     * @param $path
     * @param bool $secured
     *
     * @return string
     */
    function asset($path, $secured = false) {
        return urlGenerator()->asset($path, $secured);
    }
}

if (!function_exists('has_rewrite')) {
    /**
     * @return boolean
     */
    function has_rewrite() {
        if (!function_exists('apache_get_modules'))
        {
            return true; // Probably, NGINX won't work else so
        }

        return in_array('mod_rewrite', apache_get_modules());
    }
}

if (!function_exists('path')) {
    /**
     * @param string $route
     *
     * @return string
     */
    function path($route) {
        return (!has_rewrite() ? '/index.php' : '') . route($route);
    }
}