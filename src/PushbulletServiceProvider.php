<?php namespace Vansanblch\PushbulletLaravel;


use Illuminate\Support\ServiceProvider;
use Pushbullet\Pushbullet;

class PushbulletServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $configPath = $this->app->make('path.config').DIRECTORY_SEPARATOR.'pushbullet.php';

        $this->publishes([
            __DIR__ . '/../config/pushbullet.php' => $configPath,
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('pushbullet', function () {
            $apiKey = $this->app->make('config')->get('pushbullet.api_key');

            $pushbullet = new Pushbullet($apiKey);

            return $pushbullet;
        });
    }
}