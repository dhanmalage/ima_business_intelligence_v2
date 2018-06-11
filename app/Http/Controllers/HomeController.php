<?php

namespace App\Http\Controllers;

use App\ApiSync;
use Illuminate\Http\Request;
use App\EventImportHistory;
use DB;
use App\ImaEvent;
use App\ImaEventDetail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
/*
        $import_history = DB::table('event_import_histories')
            ->join('ima_events', 'ima_events.id', '=', 'event_import_histories.event_id')
            ->join('users', 'users.id', '=', 'event_import_histories.created_by')
            ->selectRaw('event_import_histories.*, users.name, ima_events.event_name')
            ->orderBy('event_import_histories.id','DESC')->take(2)->get();

        //$last_event_detail = ImaEventDetail::all()->take(1);

        $last_event_detail = DB::table('ima_event_details')
            ->selectRaw('created_at')
            ->orderBy('created_at','DESC')->take(1)->get();
*/
        //dd($last_event_detail);

        //$events = ImaEvent::all()->take(5);


        $events = DB::table("events_details")
                ->selectRaw("events_details.*, events_start_ends.start_time, events_settings.event_status, events_settings.imabi_attendees_complete, events_settings.imabi_attendees_incomplete")
                ->leftjoin("events_start_ends","events_start_ends.event_id","=","events_details.id")
                ->leftjoin("events_settings","events_settings.event_id","=","events_details.id")
                ->orderBy('events_details.id','DESC')->take(5)->get();

        $last_event_detail = DB::table('events_details')
            ->selectRaw('created_at')
            ->orderBy('created_at','DESC')->take(1)->get();

        $api_sync_data = ApiSync::all()->sortByDesc("id")->take(4);

        //dd($events);
        return view('layouts.home', compact( 'events', 'api_sync_data', 'last_event_detail'));
    }
}
