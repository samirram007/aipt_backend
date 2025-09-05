<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeFullCrud extends Command
{
    protected $signature = 'make:full-crud {name}';
    protected $description = 'Generate Model, Controller, Resource, Request, Service and Interface';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $lowerName = Str::camel($name);
        $plural = Str::plural($name);

        // Generate files
        $this->makeModel($name);
        $this->makeController($name);
        $this->makeResource($name);
        $this->makeRequest($name);
        $this->makeService($name);
        $this->makeInterface($name);

        $this->info("Full CRUD for {$name} generated successfully.");
    }

    protected function makeModel($name)
    {
        $this->callSilent('make:model', [
            'name' => $name
        ]);
    }

    protected function makeController($name)
    {
        $this->callSilent('make:controller', [
            'name' => "Api/{$name}Controller",
            '--api' => true,
            '--model' => "App\\Models\\{$name}"
        ]);
    }

    protected function makeResource($name)
    {
        $this->callSilent('make:resource', [
            'name' => "{$name}Resource"
        ]);
    }

    protected function makeRequest($name)
    {
        $this->callSilent('make:request', [
            'name' => "{$name}Request"
        ]);
    }

    protected function makeService($name)
    {
        $servicePath = app_path("Services/{$name}Service.php");
        $interfacePath = app_path("Services/Contracts/{$name}ServiceInterface.php");

        // Ensure directories exist
        File::ensureDirectoryExists(dirname($servicePath));
        File::ensureDirectoryExists(dirname($interfacePath));

        // Service Interface
        if (!File::exists($interfacePath)) {
            File::put($interfacePath, <<<PHP
<?php

namespace App\Services\Contracts;

interface {$name}ServiceInterface
{
    //
}
PHP);
        }

        // Service class
        if (!File::exists($servicePath)) {
            File::put($servicePath, <<<PHP
<?php

namespace App\Services;

use App\Services\Contracts\\{$name}ServiceInterface;

class {$name}Service implements {$name}ServiceInterface
{
    //
}
PHP);
        }
    }

    protected function makeInterface($name)
    {
        // This is covered in makeService to avoid duplication
    }
}
