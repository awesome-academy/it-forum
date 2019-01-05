<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    protected $repositoryList = [
        'App\Repositories\Contracts\UserRepositoryInterface' => 'App\Repositories\Eloquents\UserRepository',
        'App\Repositories\Contracts\PostRepositoryInterface' => 'App\Repositories\Eloquents\PostRepository',
        'App\Repositories\Contracts\TagRepositoryInterface' => 'App\Repositories\Eloquents\TagRepository',
    ];

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositoryList as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }
}
