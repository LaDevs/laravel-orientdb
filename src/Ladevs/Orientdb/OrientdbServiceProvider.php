<?php

namespace Ladevs\Orientdb;

use Illuminate\Database\DatabaseManager;
use Illuminate\Queue\QueueManager;
use Illuminate\Support\ServiceProvider;
use Ladevs\Orientdb\Eloquent\Model;
use Ladevs\Orientdb\Queue\OrientConnector;

class OrientdbServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        Model::setConnectionResolver($this->app['db']);

        Model::setEventDispatcher($this->app['events']);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        // Add database driver.
        $this->app->resolving('db', function ($db) {
            /** @var DatabaseManager $db */
            $db->extend('orientdb', function ($config, $name) {
                $config['name'] = $name;
                return new Connection($config);
            });
        });

        // Add connector for queue support.
        $this->app->resolving('queue', function ($queue) {
            /** @var QueueManager $queue */
            $queue->addConnector('orientdb', function () {
                return new OrientConnector($this->app['db']);
            });
        });
    }
}