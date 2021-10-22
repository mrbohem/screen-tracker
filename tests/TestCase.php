<?php

namespace Mrbohem\ScreenTracker\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Mrbohem\ScreenTracker\ScreenTrackerServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Mrbohem\\ScreenTracker\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            ScreenTrackerServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_screen-tracker_table.php.stub';
        $migration->up();
        */
    }
}
