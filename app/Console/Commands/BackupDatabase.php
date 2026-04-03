<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class BackupDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:backup-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = 'backup_' . now()->format('Y_m_d_H_i_s') . '.sql';
        $path = storage_path("app/backups/$filename");

        $command = sprintf(
            'mariadb -u%s -p%s %s < %s',
            env('DB_USERNAME'),
            env('DB_PASSWORD'),
            env('DB_DATABASE'),
            $path
        );

        $output = [];
        $returnVar = 0;

        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            $this->error('Backup failed!');
            Log::error('Database backup failed', ['output' => $output]);
            dd($output); // shows actual error
        }

        $this->info('Backup created: ' . $filename);
    }
}
