<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Inspire::class,
        Commands\GetData::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('upd:data')
        //          ->hourly();
        $schedule->call('App\Http\Controllers\UetNews@getTuitionNotification')->everyMinute();
        $schedule->call('App\Http\Controllers\UetNews@getScheduleNotification')->everyMinute();
        $schedule->call('App\Http\Controllers\UetNews@point')->everyMinute();
        // $schedule->command('upd:data')->cron('* * * * *');
    }
}
