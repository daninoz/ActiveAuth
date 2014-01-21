<?php namespace Daninoz\ActiveAuth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class ActiveAuthServiceProvider extends ServiceProvider {

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
		//
	}

    public function boot()
    {
        $this->package('daninoz/active-auth');

        AliasLoader::getInstance()->alias('ActiveAuth', 'Daninoz\ActiveAuth\ActiveAuth');
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