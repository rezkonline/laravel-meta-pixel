<?php

namespace Rezkonline\LaravelMetaPixel\Providers;

use Rezkonline\LaravelMetaPixel\MetaPixel;
use Illuminate\Support\ServiceProvider;

class MetaPixelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom($this->srcPath('views'), 'meta-pixel');

        $this->publishes([
            $this->srcPath('config/laravel-meta-pixel.php') => config_path('laravel-meta-pixel.php'),
        ], 'laravel-meta-pixel.config');

        $this->publishes([
            $this->srcPath('views') => resource_path('views/vendor/laravel-meta-pixel'),
        ], 'laravel-meta-pixel.views');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('meta.pixel', function () {
            return MetaPixel::getInstance();
        });

        $this->mergeConfigFrom(
            $this->srcPath('config/laravel-meta-pixel.php'), 'laravel-meta-pixel'
        );
    }

    /**
     * @return string
     */
    private function srcPath($path)
    {
        return __DIR__.'/../'.$path;
    }
}