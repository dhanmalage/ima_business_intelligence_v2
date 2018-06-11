<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\EventsPrices;
use App\EventsStartEnd;
use App\Mail\EventImport;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        '\App\Console\Commands\SyncEvents',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->command('SyncEvents:sync')->withoutOverlapping(3);

        $schedule->command('SyncAttendees:sync')->withoutOverlapping(3);

        $schedule->command('SyncEventTimes:sync')->withoutOverlapping(3);

        $schedule->command('SyncEventPrice:sync')->withoutOverlapping(3);

        $schedule->call(function () {
            Mail::to('dmmdust@gmail.com')->send(new EventImport());
            //Mail::to('ash@osmium.com.au')->send(new EventImport());
            //Mail::to('manjula@osmium.com.au')->send(new EventImport());
        });

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
