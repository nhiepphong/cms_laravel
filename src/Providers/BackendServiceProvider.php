<?php

namespace Nhiepphong\Backend\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Sentinel;

class BackendServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            require __DIR__.'/../routes.php';
        }
        
        //View
        $this->loadViewsFrom(dirname(__DIR__).'/resources/views', 'backend');

        //Assets
        //Run cmd: php artisan vendor:publish --tag=public --force
        $this->publishes([
            __DIR__.'/../resources/assets' => public_path('packages/nhiepphong/assets'),
            dirname(__DIR__).'/resources/views' => base_path('resources/views/vendor/backend'),
        ], 'public');
        View::share('assetURL', asset('packages/nhiepphong/assets') . "/");
        define("ROOT_ASSET", asset('packages/nhiepphong/assets') . "/");
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->app->make('Nhiepphong\Backend\Http\Controllers\BackendController');

        require_once __DIR__ . '/../Helpers/MainHelper.php';
        require_once __DIR__ . '/../Helpers/InputHelper.php';

        /*
         * Register the service provider for the dependency.
         */
        $imageProvider = new \Intervention\Image\ImageServiceProvider($this->app);
        $imageProvider->register();
        /*
         * Create aliases for the dependency.
         */
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Image', 'Intervention\Image\Facades\Image');

    }
}
