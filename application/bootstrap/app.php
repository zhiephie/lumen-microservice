<?php

require_once __DIR__ . '/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__ . '/../')
);

$app->instance('path.config', app()->basePath() . DIRECTORY_SEPARATOR . 'config');
$app->instance('path.storage', app()->basePath() . DIRECTORY_SEPARATOR . 'storage');

$app->withFacades();
$app->withEloquent();

/*
|--------------------------------------------------------------------------
| Manager Service Provider
|--------------------------------------------------------------------------
|
| The automatic providers manager loads the providers included in config/manager.php file
| If you want to load new providers just enter in the array(global, local, production)
| 'name'  => \path\NameProvider::class
| This will allow you to better manage the loading.
| If you want to create a provider through artisan, just run:
| php artisan create:provider
|
*/

//Load Manager Providers of Framework
$app->register(Kosmosx\Framework\Providers\ManagerServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/
$app->router->group([
    'namespace' => 'App\Http\Controller',
], function ($router) {
    require __DIR__ . '/../routes/web.php';
});

return $app;
