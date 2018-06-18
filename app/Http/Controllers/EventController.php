<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\EventAttendee;
use DB;

class EventController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('events.events', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::findOrFail($id);

        $attendees = DB::table('event_attendees')
            ->where('event_id', '=', $event->event_id)->get();

        return view('events.event-details', compact('event', 'attendees'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    /**
     * Analysis page
     */
    public function all_events_analysis()
    {
        $all_events = Event::all();

        return view('events.analysis-all', compact('all_events'));

    }

    /**
     * Analysis page range
     */
    public function events_analysis_range($date_range)
    {
        $dates = explode('-', $date_range, 6);

        $date1 = $dates[1];
        $month1 = $dates[0];
        $year1 = $dates[2];

        $date2 = $dates[4];
        $month2 = $dates[3];
        $year2 = $dates[5];

        $from_date = $year1 . "-" . $month1 . "-" . $date1;
        $to_date = $year2 . "-" . $month2 . "-" . $date2;

        if($date_range != null){
            $all_events = Event::whereBetween('event_date', [$from_date, $to_date])->get();
            return view('events.analysis-all', compact('all_events'));
        }else{
            $all_events = Event::all();

            return view('events.analysis-all', compact('all_events'));
        }

    }

    /**
     * Open Events Analysis page
     */
    public function open_events_analysis()
    {
        $open_events = DB::table('events')
            ->where('event_status', '=', 'open')->get();

        return view('events.analysis-open', compact('open_events'));
    }

    /**
     * Analysis All Events page
     */
    /*
    public function analysis_all()
    {
        $events = Event::all();

        return view('events.analysis-all', compact('events'));
    }
    */

    /**
     * Event Details print
     */
    public function event_details_print($id)
    {
        $event = Event::findOrFail($id);

        $attendees = DB::table('event_attendees')
            ->where('event_id', '=', $event->event_id)->get();

        return view('events.event-details-print', compact('event', 'attendees'));
    }
}
