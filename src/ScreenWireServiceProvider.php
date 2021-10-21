<?php

namespace Mrbohem\ScreenWire;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

// use Illuminate\Support\Facades\Broadcast;

class ScreenWireServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('screen-wire')
            ->hasConfigFile()
            ->hasRoute('screen-wire')
            ->hasViews();
    }

    public function packageBooted(): void
    {
        app('ScreenTracker')->send();
    }

    public function registeringPackage(): void
    {
        $service = [
            false => \Mrbohem\ScreenWire\Service\PublicService::class,
            true => \Mrbohem\ScreenWire\Service\AuthService::class,
        ];


        $mainClass = $service[config('screen-wire.auth')] ?? \Mrbohem\ScreenWire\Service\AuthService::class;

        if ($mainClass) {
            $this->app->singleton('ScreenTracker', $mainClass);
        }
    }
}
