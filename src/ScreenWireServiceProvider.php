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

        $service = [
            false => \Mrbohem\ScreenWire\Service\PublicService::class,
            true => \Mrbohem\ScreenWire\Service\AuthService::class,
        ];

<<<<<<< HEAD
        $mainObj = $service[config('screen-wire.auth')] ?? null;
        if($mainObj){
=======
        if ($mainObj) {
>>>>>>> fb461ad6d8dcc2ceffda632eece7a415f61f0322
            (new MainService(new $mainObj()))->send();
        }
    }
}
