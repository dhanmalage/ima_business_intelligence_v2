<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ApiSync;
use Illuminate\Http\Request;
use GuzzleHttp;
use App\EventAttendee;
use App\EventsDetail;
use App\EventsPrices;
use App\EventsStartEnd;
use DateTime;
use DB;
use App\EventsSettings;
use App\Http\Controllers\ApiSyncController;

class SyncEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SyncEvents:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        app('App\Http\Controllers\ApiSyncController')->api_sync_auto_events();
        app('App\Http\Controllers\ApiSyncController')->api_sync_auto_attendees();
        app('App\Http\Controllers\ApiSyncController')->api_sync_auto_events_time();
        app('App\Http\Controllers\ApiSyncController')->api_sync_auto_events_price();
    }
}
