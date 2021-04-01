<?php

namespace App\Console;

use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Document;
use App\Station;
use App\missing_document as missing;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
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

            Missing::truncate();

            $stations = Station::all();
            
            foreach ($stations as $s) {

                $documents = Document::where('station_id', $s->id)->get()->sortBy('code')->groupBy('code');
            
                for ($i = $documents->first()[0]->code; $i < $documents->last()[0]->code; $i++) { 
                    if (!isset($documents[$i][0])) {
                        Missing::create([
                            'station_id' => $s->id,
                            'name' => $s->name,
                            'code' => $i,
                        ]);
                    }
                }
            }

        })->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
