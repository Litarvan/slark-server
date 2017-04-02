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
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    Laravel\Lumen\Console\Kernel::class
);


$app->middleware([
    App\Http\Middleware\NoRewriteCompatibility::class
]);

$app->routeMiddleware([
    'auth' => App\Http\Middleware\Authenticate::class,
    'guest' => App\Http\Middleware\Guest::class
]);


$app->register(App\Providers\AppServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);


$app->group(['namespace' => 'App\Http\Controllers'], function ($app) {
    require __DIR__ . '/../routes/web.php';
});


$app->configure('app');
$app->configure('auth');


return $app;
