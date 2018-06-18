<?php

namespace App\Http\Controllers;

use App\ApiRequest;
use App\EventAttendee;
use Illuminate\Http\Request;
use GuzzleHttp;
use App\Event;
use DB;
use App\Donation;

class ApiRequestController extends Controller
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
     * @param  \App\ApiRequest  $apiRequest
     * @return \Illuminate\Http\Response
     */
    public function show(ApiRequest $apiRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ApiRequest  $apiRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(ApiRequest $apiRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ApiRequest  $apiRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApiRequest $apiRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ApiRequest  $apiRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiRequest $apiRequest)
    {
        //
    }

    public function api_event_request()
    {
        Event::truncate();

        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'POST',
            'http://162.144.90.115/~ima/wp-json/ima_api/imabi_events_sync',
            [
                'multipart' => [
                    [
                        'name'     => 'request_name',
                        'contents' => 'events'
                    ]
                ]
            ]);

        // dd($response->getBody()->getContents());
        $status = $response->getStatusCode(); // 200
        $phrase = $response->getReasonPhrase(); // OK

        $data = json_decode($response->getBody()->getContents(), true);

        //dd($data);
        if($status == "200" && $phrase == "OK") {
            foreach ($data as $item){
                $event = new Event();
                $event->event_id = $item['id'];
                $event->event_name = $item['title'];
                $event->event_date = $item['date'];
                $event->event_start_time = $item['stime'];
                $event->event_end_time = $item['etime'];
                $event->event_status = $item['status'];
                $event->seats = $item['seats'];
                $event->price = $item['price'];
                $event->save();
            }
        }

        return redirect('events');
    }

    public function api_attendee_request()
    {

        $last_attendee_id = EventAttendee::max('web_id');

        if($last_attendee_id == null || $last_attendee_id == ""){
            $last_attendee_id = 0;
        }

        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'POST',
            'http://162.144.90.115/~ima/wp-json/ima_api/imabi_events_sync',
            [
                'multipart' => [
                    [
                        'name'     => 'request_name',
                        'contents' => 'attendees'
                    ],
                    [
                        'name'     => 'last_rec',
                        'contents' => $last_attendee_id
                    ]
                ]
            ]);

        // dd($response->getBody()->getContents());
        $status = $response->getStatusCode(); // 200
        $phrase = $response->getReasonPhrase(); // OK

        $data = json_decode($response->getBody()->getContents(), true);

        //dd($data);
        if($status == "200" && $phrase == "OK") {
            foreach ($data as $item) {
                $attendee = new EventAttendee();
                $attendee->web_id = $item['id'];
                $attendee->fname = $item['fname'];
                $attendee->lname = $item['lname'];
                $attendee->email = $item['email'];
                $attendee->phone = $item['phone'];
                $attendee->post_code = $item['post_code'];
                $attendee->how_did = $item['how_did'];
                $attendee->quantity = $item['quantity'];
                $attendee->event_id = $item['event_id'];
                $attendee->ticket_price = $item['ticket_price'];
                $attendee->ticket_total = $item['ticket_total'];
                $attendee->donation = $item['donation'];
                $attendee->reference = $item['reference'];
                $attendee->date = $item['date'];
                $attendee->save();
            }
        }

        return redirect('events');
    }

    public function api_events_update_request()
    {
        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'POST',
            'http://162.144.90.115/~ima/wp-json/ima_api/imabi_events_sync',
            [
                'multipart' => [
                    [
                        'name'     => 'request_name',
                        'contents' => 'event_update'
                    ]
                ]
            ]);

        //dd($response->getBody()->getContents());
        $status = $response->getStatusCode(); // 200
        $phrase = $response->getReasonPhrase(); // OK

        $data = json_decode($response->getBody()->getContents(), true);

        //dd($data);
        if($status == "200" && $phrase == "OK") {
            foreach ($data as $item) {

                DB::table('events')
                    ->where('event_id', $item['event_id'])  // find your user by their email
                    ->limit(1)  // optional - to ensure only one record is updated.
                    ->update(
                        array(
                            'attendees_total' => $item['attendees'],
                            'paid_total' => $item['paid_total']
                        )
                    );  // update the record in the DB.

            }
        }

        return redirect('events');
    }

    public function api_donations_request()
    {

        $last_record_id = Donation::max('web_id');

        if($last_record_id == null || $last_record_id == ""){
            $last_record_id = 0;
        }

        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'POST',
            'http://162.144.90.115/~ima/wp-json/ima_api/imabi_donations_sync',
            [
                'multipart' => [
                    [
                        'name'     => 'request_name',
                        'contents' => 'donations'
                    ],
                    [
                        'name'     => 'last_rec',
                        'contents' => $last_record_id
                    ]
                ]
            ]);

        // dd($response->getBody()->getContents());
        $status = $response->getStatusCode(); // 200
        $phrase = $response->getReasonPhrase(); // OK

        $data = json_decode($response->getBody()->getContents(), true);

        //dd($data);
        if($status == "200" && $phrase == "OK") {
            foreach ($data as $item) {
                $donation = new Donation();
                $donation->web_id = $item['id'];
                $donation->fname = $item['fname'];
                $donation->lname = $item['lname'];
                $donation->email = $item['email'];
                $donation->address = $item['address'];
                $donation->city = $item['city'];
                $donation->country = $item['country'];
                $donation->donation_type = $item['donation_type'];
                $donation->category = $item['category'];
                $donation->amount = $item['amount'];
                $donation->order_id = $item['order_id'];
                $donation->payment_status = $item['payment_status'];
                $donation->anonymous = $item['anonymous'];
                $donation->date = $item['date'];
                $donation->save();
            }
        }

        return redirect('donations');
    }
}
