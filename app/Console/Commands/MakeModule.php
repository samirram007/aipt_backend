<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Generate full-featured API module: Controller, Service, Interface, Request, Resource, Routes, Tests, Migration, Seeder';

    public function handle(): void
    {
        $name = Str::studly($this->argument('name'));
        $lower = Str::snake($name);
        $plural = Str::plural($lower);
        $modulePath = app_path("Modules/{$name}");

        // Create directory structure
        $folders = [
            'Controllers/Api',
            'Models',
            'Requests',
            'Resources',
            'Services',
            'Contracts',
            'Routes',
            'Providers',
            'Tests/Feature',
            'Database/Migrations',
            'Database/Seeders',
        ];

        foreach ($folders as $folder) {
            File::ensureDirectoryExists("{$modulePath}/{$folder}");
        }

        // Create all module files
        $this->createApiRoutesFile($modulePath, $name, $plural);
        $this->createController($modulePath, $name, $plural);
        $this->createServiceInterface($modulePath, $name);
        $this->createService($modulePath, $name);
        $this->createModel($modulePath, $name, $plural);
        $this->createResource($modulePath, $name);
        $this->createCollection($modulePath, $name);
        $this->createRequest($modulePath, $name, $plural, $lower);
        $this->createTest($modulePath, $name, $plural);
        $this->createMigration($modulePath, $plural);
        $this->createSeeder($modulePath, $name);
        $this->createServiceProvider($modulePath, $name);

        $this->info("✅ Module '{$name}' created successfully with all components!");
        $this->info("📝 Don't forget to:");
        $this->info("   1. Register the service provider in config/app.php");
        $this->info("   2. Run the migration: php artisan migrate");
        $this->info("   3. Update the model fillable fields as needed");
        $this->info("   4. Ensure SuccessResource and SuccessCollection base classes exist");
    }

    private function createApiRoutesFile(string $modulePath, string $name, string $plural): void
    {
        $content = "<?php

use Illuminate\Support\Facades\Route;
use App\Modules\\{$name}\Controllers\Api\\{$name}Controller;

Route::apiResource('{$plural}', {$name}Controller::class)->middleware(['jwt.cookies']);
";
        File::put("{$modulePath}/Routes/api.php", $content);
    }

    private function createController(string $modulePath, string $name, string $plural): void
    {
        $content = "<?php

namespace App\Modules\\{$name}\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Modules\\{$name}\Contracts\\{$name}ServiceInterface;
use App\Modules\\{$name}\Resources\\{$name}Resource;
use App\Modules\\{$name}\Resources\\{$name}Collection;
use App\Modules\\{$name}\Requests\\{$name}Request;
use App\Http\Resources\SuccessResource;
use App\Http\Resources\SuccessCollection;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class {$name}Controller extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected {$name}ServiceInterface \$service) {}

    public function index(): SuccessCollection
    {
        \$data = \$this->service->getAll();
        return new {$name}Collection(\$data);
    }

    public function show(int \$id): SuccessResource
    {
        \$data = \$this->service->getById(\$id);
        return  new {$name}Resource(\$data);
    }

    public function store({$name}Request \$request): SuccessResource
    {
        \$data = \$this->service->store(\$request->validated());
       return  new {$name}Resource(\$data, \$messages='{$name} created successfully');
    }

    public function update({$name}Request \$request, int \$id): SuccessResource
    {
        \$data = \$this->service->update(\$request->validated(), \$id);
        return  new {$name}Resource(\$data, \$messages='{$name} updated successfully');
    }

        public function destroy(int \$id): JsonResponse
    {

        \$result=\$this->service->delete(\$id);
        return new JsonResponse([
            'status' => \$result,
            'code' => 204,
            'message' => \$result?'{$name} deleted successfully':'{$name} not found',
        ]);
    }
}
";
        File::put("{$modulePath}/Controllers/Api/{$name}Controller.php", $content);
    }

    private function createServiceInterface(string $modulePath, string $name): void
    {
        $content = "<?php

namespace App\Modules\\{$name}\Contracts;

use Illuminate\Database\Eloquent\Collection;
use App\Modules\\{$name}\Models\\{$name};

interface {$name}ServiceInterface
{
    public function getAll(): Collection;
    public function getById(int \$id): ?{$name};
    public function store(array \$data): {$name};
    public function update(array \$data, int \$id): {$name};
    public function delete(int \$id): bool;
}
";
        File::put("{$modulePath}/Contracts/{$name}ServiceInterface.php", $content);
    }

    private function createService(string $modulePath, string $name): void
    {
        $content = "<?php

namespace App\Modules\\{$name}\Services;

use App\Modules\\{$name}\Contracts\\{$name}ServiceInterface;
use App\Modules\\{$name}\Models\\{$name};
use Illuminate\Database\Eloquent\Collection;

class {$name}Service implements {$name}ServiceInterface
{
    protected \$resource=[];

    public function getAll(): Collection
    {
        return {$name}::with(\$this->resource)->get();
    }

    public function getById(int \$id): ?{$name}
    {
        return {$name}::with(\$this->resource)->findOrFail(\$id);
    }

    public function store(array \$data): {$name}
    {
        return {$name}::create(\$data);
    }

    public function update(array \$data, int \$id): {$name}
    {
        \$record = {$name}::findOrFail(\$id);
        \$record->update(\$data);
        return \$record->fresh();
    }

    public function delete(int \$id): bool
    {
        \$record = {$name}::findOrFail(\$id);
        return \$record->delete();
    }
}
";
        File::put("{$modulePath}/Services/{$name}Service.php", $content);
    }

    private function createModel(string $modulePath, string $name, string $plural): void
    {
        $content = "<?php

namespace App\Modules\\{$name}\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Blamable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class {$name} extends Model
{
    use HasFactory,Blamable;

    protected \$table = '{$plural}';

    protected \$fillable = [
        'name',
        'code',
        'description',
        'status',
        'created_by',
        'updated_by'
    ];

    protected \$casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
";
        File::put("{$modulePath}/Models/{$name}.php", $content);
    }

    private function createResource(string $modulePath, string $name): void
    {
        $content = "<?php

namespace App\Modules\\{$name}\Resources;

use Illuminate\Http\Request;

use App\Http\Resources\SuccessResource;
class {$name}Resource extends SuccessResource
{
    public function toArray(Request \$request): array
    {
        return [
            'id' => \$this->id,
            'name' => \$this->name,
            'created_at' => \$this->created_at?->toISOString(),
            'updated_at' => \$this->updated_at?->toISOString(),
        ];
    }
}
";
        File::put("{$modulePath}/Resources/{$name}Resource.php", $content);
    }

    private function createCollection(string $modulePath, string $name): void
    {
        $content = "<?php

namespace App\Modules\\{$name}\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\SuccessCollection;

class {$name}Collection extends SuccessCollection
{

         /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request \$request): array
    {
        return parent::toArray(\$request);
    }
}
";
        File::put("{$modulePath}/Resources/{$name}Collection.php", $content);
    }

    private function createRequest(string $modulePath, string $name, string $plural, string $lower): void
    {
        $content = "<?php

namespace App\Modules\\{$name}\Requests;

use Illuminate\Foundation\Http\FormRequest;

class {$name}Request extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        \$rules = [
            'name' => ['required', 'string', 'max:255','unique:{$plural},name'],
            'code' => ['sometimes','required', 'string', 'max:255','unique:{$plural},code'],
            'description' => ['sometimes','required', 'string', 'max:255'],
            'status' => ['sometimes','required', 'string', 'max:255'],
        ];

        // For update requests, make validation more flexible
        if (\$this->isMethod('PUT') || \$this->isMethod('PATCH')) {
            \$id=\$this->route('$lower');
            \$rules['name'] = ['sometimes', 'required', 'string', 'max:255', 'unique:{$plural},name,' . \$id,];
            \$rules['code'] = ['sometimes', 'required', 'string', 'max:255', 'unique:{$plural},code,' . \$id,];

        }

        return \$rules;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'name.unique' => 'The name has already been taken.',
            'code.required' => 'The code field is required.',
            'code.string' => 'The code must be a string.',
            'code.max' => 'The code may not be greater than 255 characters.',
            'code.unique' => 'The code has already been taken.',
            'description.required   ' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description may not be greater than 255 characters.',
            'status.required' => 'The status field is required.',
            'status.string' => 'The status must be a string.',
        ];
    }
}
";
        File::put("{$modulePath}/Requests/{$name}Request.php", $content);
    }

    private function createTest(string $modulePath, string $name, string $plural): void
    {
        $content = "<?php

namespace App\Modules\\{$name}\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\\{$name}\Models\\{$name};

class {$name}Test extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_{$plural}(): void
    {
        \$response = \$this->getJson('/api/{$plural}');
        \$response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_create_{$name}(): void
    {
        \$data = ['name' => 'Test {$name}'];

        \$response = \$this->postJson('/api/{$plural}', \$data);
        \$response->assertStatus(201)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        \$this->assertDatabaseHas('{$plural}', \$data);
    }

    public function test_can_show_{$name}(): void
    {
        \${$name} = {$name}::factory()->create();

        \$response = \$this->getJson('/api/{$plural}/' . \${$name}->id);
        \$response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         'id',
                         'name',
                         'created_at',
                         'updated_at'
                     ],
                     'status',
                     'code',
                     'message'
                 ]);
    }

    public function test_can_update_{$name}(): void
    {
        \${$name} = {$name}::factory()->create();
        \$data = ['name' => 'Updated {$name}'];

        \$response = \$this->putJson('/api/{$plural}/' . \${$name}->id, \$data);
        \$response->assertStatus(200)
                 ->assertJsonStructure([
                     'data',
                     'status',
                     'code',
                     'message'
                 ]);

        \$this->assertDatabaseHas('{$plural}', \$data);
    }

    public function test_can_delete_{$name}(): void
    {
        \${$name} = {$name}::factory()->create();

        \$response = \$this->deleteJson('/api/{$plural}/' . \${$name}->id);
        \$response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'code',
                     'message'
                 ]);

        \$this->assertDatabaseMissing('{$plural}', ['id' => \${$name}->id]);
    }

    public function test_validation_errors_on_create(): void
    {
        \$response = \$this->postJson('/api/{$plural}', []);
        \$response->assertStatus(422)
                 ->assertJsonValidationErrors(['name']);
    }
}
";
        File::put("{$modulePath}/Tests/Feature/{$name}Test.php", $content);
    }

    private function createMigration(string $modulePath, string $plural): void
    {
        $migrationName = date('Y_m_d_His') . "_create_{$plural}_table.php";
        $content = "<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('{$plural}', function (Blueprint \$table) {
            \$table->id();
            \$table->string('name')->unique();
            \$table->string('code')->unique();
            \$table->string('description')->nullable();
            \$table->string('status')->default('active');
            \$table->string('icon')->nullable();
            \$table->unsignedBigInteger('created_by')->nullable();
            \$table->unsignedBigInteger('updated_by')->nullable();
            \$table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('{$plural}');
    }
};
";
        File::put("{$modulePath}/Database/Migrations/{$migrationName}", $content);
    }

    private function createSeeder(string $modulePath, string $name): void
    {
        $content = "<?php

namespace App\Modules\\{$name}\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\\{$name}\Models\\{$name};

class {$name}Seeder extends Seeder
{
    public function run(): void
    {
        {$name}::create(['name' => 'Sample {$name}']);

        // Uncomment to use factory if available
        // {$name}::factory()->count(10)->create();
    }
}
";
        File::put("{$modulePath}/Database/Seeders/{$name}Seeder.php", $content);
    }

    private function createServiceProvider(string $modulePath, string $name): void
    {
        $content = "<?php

namespace App\Modules\\{$name}\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Modules\\{$name}\Contracts\\{$name}ServiceInterface;
use App\Modules\\{$name}\Services\\{$name}Service;

class {$name}ServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        \$this->app->bind({$name}ServiceInterface::class, {$name}Service::class);
    }

    public function boot(): void
    {
        \$this->loadRoutes();
        \$this->loadMigrations();
    }

    private function loadRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(__DIR__ . '/../Routes/api.php');
    }

    private function loadMigrations(): void
    {
        \$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
}
";
        File::put("{$modulePath}/Providers/{$name}ServiceProvider.php", $content);
    }
}
