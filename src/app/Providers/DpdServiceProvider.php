<?php

namespace PatrykSawicki\DpdApi\app\Providers;

use Illuminate\Support\ServiceProvider;

class DpdServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot(): void
    {
        if (!defined('DPD_PATH')) {
            define('DPD_PATH', realpath(__DIR__ . '/../../'));
        }

        include DPD_PATH . '/routes/web.php';

        if (!file_exists($this->app->databasePath() . '/config/dpd.php')) {
            $this->publishes([DPD_PATH . '/config/dpd.php' => config_path('dpd.php')], 'config');
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        if (!defined('DPD_PATH')) {
            define('DPD_PATH', realpath(__DIR__ . '/../../'));
        }

        $this->mergeConfigFrom(DPD_PATH . '/config/dpd.php', 'dpd');
        $this->loadViewsFrom(DPD_PATH . '/resources/views/', 'dpd');
    }
}
