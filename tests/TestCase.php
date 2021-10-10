<?php

namespace Mrbohem\ScreenWire\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Mrbohem\ScreenWire\ScreenWireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Mrbohem\\ScreenWire\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            ScreenWireServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_screen-wire_table.php.stub';
        $migration->up();
        */
    }
}
