<?php namespace Coreplex\Navigator;

use ReflectionClass;
use Illuminate\Support\ServiceProvider;

class NavigatorServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/navigator.php' => config_path('navigator.php'),
        ]);

        $this->mergeConfigFrom(__DIR__.'/../config/navigator.php', 'navigator');

    }

    /**
     * Regsiter the service provider.
     */
    public function register()
    {
        $this->registerRenderer();
        $this->registerStore();
        $this->registerNavigator();
    }

    /**
     * Register the navigator renderer.
     */
    protected function registerRenderer()
    {
        $this->app['Coreplex\Navigator\Contracts\Renderer'] = $this->app->share(function($app)
        {
            return (new ReflectionClass($app['config']['navigator']['renderer']))->newInstanceArgs([$app['view']]);
        });
    }

    /**
     * Register the data store to be used by navigator.
     */
    protected function registerStore()
    {
        $this->app['Coreplex\Navigator\Contracts\Store'] = $this->app->share(function($app)
        {
            return (new ReflectionClass($app['config']['navigator']['store']))->newInstanceArgs([$app['config']['navigator']['menus']]);
        });
    }

    /**
     * Register the navigator instance.
     */
    protected function registerNavigator()
    {
        $this->app['Coreplex\Navigator\Contracts\Navigator'] = $this->app->share(function($app)
        {
            return new Navigator(
                $app['Coreplex\Navigator\Contracts\Renderer'],
                $app['Coreplex\Navigator\Contracts\Store'],
                $app['config']['navigator']
            );
        });
    }

}