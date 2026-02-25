<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateEnumFromDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'app:generate-enum-from-d-b';
    protected $signature = 'make:enum-from-db {table} {column} {enumName}';
    /**
     * The console command description.
     *
     * @var string
     */

    protected $description = 'Generate a PHP enum from DB values';

    /**
     * Execute the console command.
     */
    public function handle()
    {
         $table = $this->argument('table');          // e.g., accounting_effects
        $column = $this->argument('column');        // e.g., name
        $enumName = $this->argument('enumName');    // e.g., AccountingEffect

        $values = DB::table($table)->distinct()->pluck($column)->toArray();

        if (empty($values)) {
            $this->error("No values found in {$table}.{$column}");
            return;
        }

        $enumNamespace = 'App\\Enums';
        $filePath = app_path("Enums/{$enumName}.php");

        $lines = [];
        $lines[] = "<?php\n";
        $lines[] = "namespace {$enumNamespace};\n";
        $lines[] = "enum {$enumName}: string\n{";

        foreach ($values as $val) {
            $caseName = Str::studly($val);
            $lines[] = "    case {$caseName} = '{$val}';";
        }

        $lines[] = "}\n";

        file_put_contents($filePath, implode("\n", $lines));

        $this->info("Enum {$enumName} generated successfully at: Enums/{$enumName}.php");
    }
}
