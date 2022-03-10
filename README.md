# screen-tracker
This is a Laravel Livewire package. It allow you to see what users are doing on their screen.

![Screen Tracker](https://github.com/mrbohem/screen-tracker/blob/main/screenTracker.gif)

# Installation
     composer require mrbohem/screen-tracker


Add Blade directives before the end body tag in your template.

    <x-screen-tracker::script />

Publish Config File
    
    php artisan vendor:publish --force --tag=screen-tracker-config

Publish Frontend Assets
    
    php artisan vendor:publish --force --tag=screen-tracker-views

To keep the assets up-to-date and avoid issues in future updates, we highly recommend adding the command to the post-autoload-dump scripts in your composer.json file:

    
    {
        "scripts": {
            "post-autoload-dump": [
                "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
                "@php artisan package:discover --ansi",
                "@php artisan vendor:publish --force --tag=livewire:assets --ansi",
                "@php artisan vendor:publish --force --tag=screen-tracker-config --ansi",
                "@php artisan vendor:publish --force --tag=screen-tracker-views --ansi"
            ]
        }
    }
    
# Usage
Call Trait in which component you want to monitor.
    
    use Mrbohem\ScreenTracker\Traits\ScreenTrackerable;
    ...
    use ScreenTrackerable;
    
