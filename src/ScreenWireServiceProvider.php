<?php

namespace Mrbohem\ScreenWire;

use Mrbohem\ScreenWire\Service\MainService;
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

        $mainObj = [
            false => \Mrbohem\ScreenWire\Service\PublicService::class,
            true => \Mrbohem\ScreenWire\Service\AuthService::class,
        ][config('screen-wire.auth')];

        if ($mainObj) {
            (new MainService(new $mainObj()))->send();
        }
    }
}
