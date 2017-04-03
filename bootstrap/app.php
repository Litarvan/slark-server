<?php

require_once __DIR__.'/../vendor/autoload.php';

try
{
    (new Dotenv\Dotenv(__DIR__ . '/../'))->load();
}
catch (Dotenv\Exception\InvalidPathException $e)
{
}


$app = new Laravel\Lumen\Application(
    realpath(__DIR__ . '/../')
);

$app->withFacades();

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    Slark\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    Laravel\Lumen\Console\Kernel::class
);


$app->middleware([
    Slark\Http\Middleware\NoRewriteCompatibility::class
]);

$app->routeMiddleware([
    'auth' => Slark\Http\Middleware\Authenticate::class,
    'guest' => Slark\Http\Middleware\Guest::class
]);


$app->register(Slark\Providers\AppServiceProvider::class);
// $app->register(Slark\Providers\EventServiceProvider::class);


$app->group(['namespace' => 'Slark\Http\Controllers'], function ($app) {
    require __DIR__ . '/../routes/web.php';
    require __DIR__ . '/../routes/api.php';
});


$app->configure('app');
$app->configure('auth');


return $app;
