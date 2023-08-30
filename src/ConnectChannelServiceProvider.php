<?php

namespace Tnaffh\ConnectLaravelNotificationChannel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tnaffh\ConnectSms\ConnectSms;

class ConnectChannelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('connect-laravel-notification-channel');
    }

    public function boot()
    {
        parent::boot();

        $this->app->singleton(ConnectSms::class, function ($app) {
            return new ConnectSms();
        });
    }
}
