<?php

namespace App\Console;

use App\Events\SendPromotionToPreferentialClients;
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
        // send promotions every 2 months
        $schedule->call(function () {
            // call the event of SendPromotionToPreferentialClients
            $eventSendPromotionToPreferentialClients = new SendPromotionToPreferentialClients;
            // Dispatch the event
            event($eventSendPromotionToPreferentialClients);
        })->cron('0 0 1 */2 *');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
