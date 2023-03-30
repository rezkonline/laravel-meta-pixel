<?php

namespace Laraeast\LaravelBootstrapForms\Tests;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Rezkonline\LaravelMetaPixel\Facades\MetaPixelFacade;
use Laraeast\LaravelLocales\Providers\LocalesServiceProvider;
use Rezkonline\LaravelMetaPixel\Providers\MetaPixelServiceProvider;

abstract class TestCase extends OrchestraTestCase
{
    use RefreshDatabase;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->createTables();

        $this->withFactories(realpath(__DIR__.'/Factories'));

        $this->app->setLocale('en');
    }

    /**
     * @return void
     */
    protected function createTables(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('currency');
            $table->string('category');
            $table->double('price');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Load package service provider.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            MetaPixelServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'LaravelMetaPixel' => MetaPixelFacade::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('session.driver', 'array');
    }
}