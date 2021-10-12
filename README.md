# screen-wire
This is a Laravel Livewire package. It allow you to see what users are doing on their screen.

# Installation
     composer require mrbohem/screen-wire


Add Blade directives before the end body tag in your template.

    <x-screen-wire::script />

Publish Config File
    
    php artisan vendor:publish --force --tag=screen-wire-config

Publish Frontend Assets
    
    php artisan vendor:publish --force --tag=screen-wire-views

To keep the assets up-to-date and avoid issues in future updates, we highly recommend adding the command to the post-autoload-dump scripts in your composer.json file:

    
    {
        "scripts": {
            "post-autoload-dump": [
                "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
                "@php artisan package:discover --ansi",
                "@php artisan vendor:publish --force --tag=livewire:assets --ansi",
                "@php artisan vendor:publish --force --tag=screen-wire-config --ansi",
                "@php artisan vendor:publish --force --tag=screen-wire-views --ansi"
            ]
        }
    }
    
# Usage
Call Trait in which component you want to monitor.
    
    use Mrbohem\ScreenWire\Traits\ScreenWireable;
    ...
    use ScreenWireable;
    