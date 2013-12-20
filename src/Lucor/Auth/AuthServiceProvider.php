<?php namespace Lucor\Auth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Guard;

class AuthServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('lucor/laravel-auth-file-driver');
        \Auth::extend('file', function ($app) {
            $users = \Config::get('laravel-auth-file-driver::users');
            return new Guard(
                new FileUserProvider($users, $app['hash']),
                $app['session.store']
            );
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
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

}