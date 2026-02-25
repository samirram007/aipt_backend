<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceLoader extends ServiceProvider
{
    public function register(): void
    {
        $moduleBasePath = app_path('Modules');
        $directories = glob("{$moduleBasePath}/*", GLOB_ONLYDIR);

        foreach ($directories as $modulePath) {
            $module = basename($modulePath);
            $providerClass = "App\\Modules\\{$module}\\Providers\\{$module}ServiceProvider";

            if (class_exists($providerClass)) {
                $this->app->register($providerClass);
            }
        }
    }
}
