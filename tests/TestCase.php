<?php

namespace Tnaffh\ConnectLaravelNotificationChannel\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use Tnaffh\ConnectLaravelNotificationChannel\ConnectLaravelNotificationChannelServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Tnaffh\\ConnectLaravelNotificationChannel\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            ConnectLaravelNotificationChannelServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_connect-laravel-notification-channel_table.php.stub';
        $migration->up();
        */
    }
}
