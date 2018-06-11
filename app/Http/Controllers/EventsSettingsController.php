<?php

namespace App\Http\Controllers;

use App\EventsSettings;
use Illuminate\Http\Request;
use App\EventsDetail;

class EventsSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\EventsSettings  $eventsSettings
     * @return \Illuminate\Http\Response
     */
    public function show(EventsSettings $eventsSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EventsSettings  $eventsSettings
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = EventsSettings::findOrFail($id);

        return view('events.event-edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventsSettings  $eventsSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'event_status' =>'string',
            ]
        );

        $event = EventsSettings::findOrFail($id);
        $event->update($request->all());
        return redirect('ima-event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventsSettings  $eventsSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventsSettings $eventsSettings)
    {
        //
    }


    public function settings()
    {
        return view('events.settings');
    }
}
