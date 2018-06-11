<?php

namespace App\Http\Controllers;

use App\EventsDetail;
use Illuminate\Http\Request;
use App\ImaEvent;
use App\Mail\EventImport;
use App\ImaEventDetail;
use Illuminate\Support\Facades\Input;
use DateTime;
use Illuminate\Support\Facades\Auth;
use DB;
use App\EventImportHistory;
use Illuminate\Support\Facades\Mail;

class EventsDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = DB::table("events_details")
            ->selectRaw("events_details.*, events_start_ends.start_time as event_start_time, events_prices.member_price as member_price, events_settings.id as setting_id, events_settings.event_status, events_settings.imabi_attendees_complete, events_settings.imabi_attendees_incomplete")
            ->where("events_details.start_date",">","2018-01-01")
            ->leftjoin("events_start_ends","events_start_ends.event_id","=","events_details.id")->latest()
            ->leftjoin("events_prices","events_prices.event_id","=","events_details.id")
            ->leftjoin("events_settings","events_settings.event_id","=","events_details.id")
            ->orderBy('events_details.id','DESC')->get();

        return view('events.events', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\EventsDetail  $eventsDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$event = EventsDetail::findOrFail($id);

        $event = DB::table("events_details")
            ->selectRaw("events_details.*, events_start_ends.start_time as event_start_time, events_prices.member_price as member_price, events_settings.event_status, events_settings.imabi_attendees_complete, events_settings.imabi_attendees_incomplete")
            ->where("events_details.id","=",$id)
            ->leftjoin("events_start_ends","events_start_ends.event_id","=","events_details.id")
            ->leftjoin("events_prices","events_prices.event_id","=","events_details.id")
            ->leftjoin("events_settings","events_settings.event_id","=","events_details.id")->first();

        $event_details = DB::table('event_attendees')
            ->where('event_id', '=', $id)->get();
        return view('events.event-details', compact('event_details', 'event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventsDetail  $eventsDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = EventsDetail::findOrFail($id);

        return view('events.event-edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventsDetail  $eventsDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'imabi_event_status' =>'string',
            ]
        );

        $event = EventsDetail::findOrFail($id);
        $event->update($request->all());
        return redirect('ima-event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventsDetail  $eventsDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventsDetail $eventsDetail)
    {
        //
    }

    /**
     * Print an event
     *
     */
    public function print_event_details($id)
    {
        $event = DB::table("events_details")
            ->selectRaw("events_details.*, events_start_ends.start_time as event_start_time, events_prices.member_price as member_price, events_settings.event_status, events_settings.imabi_attendees_complete, events_settings.imabi_attendees_incomplete")
            ->where("events_details.id","=",$id)
            ->leftjoin("events_start_ends","events_start_ends.event_id","=","events_details.id")
            ->leftjoin("events_prices","events_prices.event_id","=","events_details.id")
            ->leftjoin("events_settings","events_settings.event_id","=","events_details.id")->first();

        $event_details = DB::table('event_attendees')
            ->where('event_id', '=', $id)->get();

        return view('events.event-details-print', compact('event', 'event_details'));
    }

}
