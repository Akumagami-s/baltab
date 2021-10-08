<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\datapokok;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Log;


use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CronController;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {



    $schedule->call(function () {
        app('App\Http\Controllers\CronController')->profiling();

    })->monthlyOn(2, '02:00');

    $schedule->call(function () {
        app('App\Http\Controllers\CronController')->validate_profiling();

    })->monthlyOn(2, '05:30');

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
