<?php

namespace Anla\Skipper;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Anla\Skipper\Http\Middleware\SkipperAdminMiddleware;
use Anla\Skipper\Models\User;

class SkipperServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->register(\Intervention\Image\ImageServiceProvider::class);
        $this->app->booting(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Menu', \Anla\Skipper\Models\Menu::class);
            $loader->alias('Skipper', Skipper::class);
        });

        if ($this->app->runningInConsole()) {
            $this->registerPublishableResources();
            $this->registerCommands();
        }
    }

    /**
     * Bootstrap the application services.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        if (config('skipper.user.add_default_role_on_register')) {
            $app_user = config('skipper.user.namespace');
            $app_user::created(function ($user) {
                $skipper_user = User::find($user->id);
                $skipper_user->addRole(config('skipper.user.default_role'));
            });
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'skipper');
        $this->registerRoutes($router);
    }

    /**
     * Register the routes.
     *
     * @param \Illuminate\Routing\Router $router
     */
    private function registerRoutes(Router $router)
    {
        $router->middleware('admin.user', SkipperAdminMiddleware::class);

        if (!$this->app->routesAreCached()) {
            $router->group([
                'prefix'    => config('skipper.routes.prefix', 'admin'),
                'namespace' => 'Anla\\Skipper\\Http\\Controllers',
            ], function () {
                require __DIR__.'/../routes/web.php';
            });
        }
    }

    /**
     * Register the publishable files.
     */
    private function registerPublishableResources()
    {
        $basePath = dirname(__DIR__);
        $publishable = [
            'skipper_assets' => [
                "$basePath/publishable/assets" => public_path('vendor/anla/skipper/assets'),
            ],
            'migrations' => [
                "$basePath/publishable/database/migrations/" => database_path('migrations'),
            ],
            'seeds' => [
                "$basePath/publishable/database/seeds/" => database_path('seeds'),
            ],
            'demo_content' => [
                "$basePath/publishable/demo_content/" => storage_path('app/public'),
            ],
            'config' => [
                "$basePath/publishable/config/skipper.php" => config_path('skipper.php'),
            ],
            'views' => [
                "$basePath/publishable/views/" => resource_path('views'),
            ],
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }
    }

    /**
     * Register the console commands.
     */
    private function registerCommands()
    {
        $this->commands(Commands\InstallCommand::class);
    }
}
