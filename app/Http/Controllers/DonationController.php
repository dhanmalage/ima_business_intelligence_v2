<?php

namespace App\Http\Controllers;

use App\Donation;
use App\EventAttendee;
use Illuminate\Http\Request;
use DB;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donations = Donation::all();

        return view('donations.donations', compact('donations'));
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
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donation = Donation::findOrFail($id);

        $other_donations = DB::table('donations')
            ->where('email', '=', $donation->email)->get();
/*
        $event_donations = DB::table('event_attendees')
            ->where('email', '=', $donation->email)
            ->where('donation', '>', 0)->get();
*/
        $event_donations = DB::table('event_attendees')
            ->select('event_attendees.*','events.event_name')
            ->join('events', 'events.event_id', '=', 'event_attendees.event_id')
            ->where('event_attendees.email', $donation->email)
            ->where('event_attendees.donation', '>', 0)->get();

        return view('donations.donation-details', compact('donation', 'other_donations', 'event_donations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        //
    }

    /**
     * event_donations
     */
    public function event_donations()
    {
        $event_donations = DB::table('event_attendees')
            ->select('event_attendees.*','events.event_name')
            ->join('events', 'events.event_id', '=', 'event_attendees.event_id')
            ->where('event_attendees.donation', '>', 0)->get();

        return view('donations.donation-events', compact('event_donations'));
    }

    /**
     * Event Donation details
     */
    public function event_donation_details($id)
    {
        $attendee = EventAttendee::findOrFail($id);

        $event_donations = DB::table('event_attendees')
            ->select('event_attendees.*','events.event_name')
            ->join('events', 'events.event_id', '=', 'event_attendees.event_id')
            ->where('event_attendees.email', $attendee->email)
            ->where('event_attendees.donation', '>', 0)->get();

        $main_donations = DB::table('donations')
            ->where('email', '=', $attendee->email)->get();

        return view('donations.donation-events-details', compact('attendee', 'event_donations', 'main_donations'));
    }

}
