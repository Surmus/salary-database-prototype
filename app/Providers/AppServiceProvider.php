<?php

namespace App\Providers;

use App\Services\AuthLoggerInterface;
use Illuminate\Support\ServiceProvider;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(AuthLoggerInterface::class, function ($app) {
            // create a log channel
            $logger = new class (AuthLoggerInterface::class) extends Logger implements AuthLoggerInterface {
                public function __construct($name)
                {
                    parent::__construct($name);
                }
            };

            //new Logger(AuthLoggerInterface::class);
            $logger->pushHandler(
                new RotatingFileHandler($app->storagePath() . '/logs/authentication.log', 5)
            );

            return $logger;
        });
    }
}
