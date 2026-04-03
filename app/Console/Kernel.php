<?php
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;

class Kernel
{

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('backup:database')->daily();
    }

}
