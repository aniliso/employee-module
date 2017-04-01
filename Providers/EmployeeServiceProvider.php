<?php

namespace Modules\Employee\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Employee\Composers\EmployeeComposer;
use Modules\Employee\Composers\MenuModify;
use Modules\Media\Image\ThumbnailManager;

class EmployeeServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

        if(view()->exists('partials.header')) {
            view()->composer('partials.header', MenuModify::class);
        }
    }

    public function boot()
    {
        $this->publishConfig('employee', 'permissions');
        $this->publishConfig('employee', 'config');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        view()->composer('employee::admin.*', EmployeeComposer::class);

        //$this->registerThumbnails();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Employee\Repositories\EmployeeRepository',
            function () {
                $repository = new \Modules\Employee\Repositories\Eloquent\EloquentEmployeeRepository(new \Modules\Employee\Entities\Employee());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Employee\Repositories\Cache\CacheEmployeeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Employee\Repositories\CategoryRepository',
            function () {
                $repository = new \Modules\Employee\Repositories\Eloquent\EloquentCategoryRepository(new \Modules\Employee\Entities\Category());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Employee\Repositories\Cache\CacheCategoryDecorator($repository);
            }
        );

    }

    private function registerThumbnails()
    {
        $this->app[ThumbnailManager::class]->registerThumbnail('smallThumb', [
            'fit' => [
                'width' => '150',
                'height' => '150',
                'callback' => function ($constraint) {
                    $constraint->upsize();
                },
            ],
        ]);
    }
}
