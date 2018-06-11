<?php

namespace App\Http\Controllers;

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

class ApiSyncController extends Controller
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
     * @param  \App\ApiSync  $apiSync
     * @return \Illuminate\Http\Response
     */
    public function show(ApiSync $apiSync)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ApiSync  $apiSync
     * @return \Illuminate\Http\Response
     */
    public function edit(ApiSync $apiSync)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ApiSync  $apiSync
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ApiSync $apiSync)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ApiSync  $apiSync
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiSync $apiSync)
    {
        //
    }

    function date_convert($date)
    {
        $new_date = new DateTime($date);
        return $new_date->format('Y-m-d');
    }

    function time_convert($time){
        $new_time = new DateTime($time);
        return $new_time->format('H:i');
    }

    public function api_sync_auto_events()
    {

        $events_detail_max = EventsDetail::max('id');

        if($events_detail_max == null || $events_detail_max == ""){
            $events_detail_max = 0;
        }

        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'POST',
            'https://islamicmuseum.org.au/tickets/?rest_route=/ima_api/events',
            [
                'multipart' => [
                    [
                        'name'     => 'request_name',
                        'contents' => 'events'
                    ],
                    [
                        'name'     => 'last_rec',
                        'contents' => $events_detail_max
                    ]
                ]
        ]);

        //dd($response->getBody()->getContents());
        $status = $response->getStatusCode(); // 200
        $phrase = $response->getReasonPhrase(); // OK

        $data = json_decode($response->getBody()->getContents(), true);

        //dd($data);
        if($status == "200" && $phrase == "OK"){
            $i = 0;
            foreach ($data as $item){
                if($item['id'] > $events_detail_max){
                    $new_event_detail = new EventsDetail();
                    $new_event_detail->id = $item['id'];
                    $new_event_detail->event_code = $item['event_code'];
                    $new_event_detail->event_name = $item['event_name'];
                    $new_event_detail->event_desc = $item['event_desc'];
                    $new_event_detail->display_desc = $item['display_desc'];
                    $new_event_detail->event_identifier = $item['event_identifier'];
                    $new_event_detail->start_date = $item['start_date'];
                    $new_event_detail->end_date = $item['end_date'];
                    $new_event_detail->registration_start = $item['registration_start'];
                    $new_event_detail->registration_end = $item['registration_end'];
                    $new_event_detail->registration_startT = $item['registration_startT'];
                    $new_event_detail->registration_endT = $item['registration_endT'];
                    $new_event_detail->visible_on = $item['visible_on'];
                    $new_event_detail->address = $item['address'];
                    $new_event_detail->address2 = $item['address2'];
                    $new_event_detail->city = $item['city'];
                    $new_event_detail->state = $item['state'];
                    $new_event_detail->zip = $item['zip'];
                    $new_event_detail->phone = $item['phone'];
                    $new_event_detail->venue_title = $item['venue_title'];
                    $new_event_detail->venue_url = $item['venue_url'];
                    $new_event_detail->venue_image = $item['venue_image'];
                    $new_event_detail->venue_phone = $item['venue_phone'];
                    $new_event_detail->virtual_url = $item['virtual_url'];
                    $new_event_detail->virtual_phone = $item['virtual_phone'];
                    $new_event_detail->reg_limit = $item['reg_limit'];
                    $new_event_detail->allow_multiple = $item['allow_multiple'];
                    $new_event_detail->additional_limit = $item['additional_limit'];
                    $new_event_detail->send_mail = $item['send_mail'];
                    $new_event_detail->is_active = $item['is_active'];
                    $new_event_detail->event_status = $item['event_status'];
                    $new_event_detail->conf_mail = $item['conf_mail'];
                    $new_event_detail->use_coupon_code = $item['use_coupon_code'];
                    $new_event_detail->use_groupon_code = $item['use_groupon_code'];
                    $new_event_detail->category_id = $item['category_id'];
                    $new_event_detail->coupon_id = $item['coupon_id'];
                    $new_event_detail->tax_percentage = $item['tax_percentage'];
                    $new_event_detail->tax_mode = $item['tax_mode'];
                    $new_event_detail->member_only = $item['member_only'];
                    $new_event_detail->post_id = $item['post_id'];
                    $new_event_detail->post_type = $item['post_type'];
                    $new_event_detail->country = $item['country'];
                    $new_event_detail->externalURL = $item['externalURL'];
                    $new_event_detail->early_disc = $item['early_disc'];
                    $new_event_detail->early_disc_date = $item['early_disc_date'];
                    $new_event_detail->early_disc_percentage = $item['early_disc_percentage'];
                    $new_event_detail->question_groups = $item['question_groups'];
                    $new_event_detail->item_groups = $item['item_groups'];
                    $new_event_detail->event_type = $item['event_type'];
                    $new_event_detail->allow_overflow = $item['allow_overflow'];
                    $new_event_detail->overflow_event_id = $item['overflow_event_id'];
                    $new_event_detail->recurrence_id = $item['recurrence_id'];
                    $new_event_detail->email_id = $item['email_id'];
                    $new_event_detail->alt_email = $item['alt_email'];
                    $new_event_detail->event_meta = $item['event_meta'];
                    $new_event_detail->wp_user = $item['wp_user'];
                    $new_event_detail->require_pre_approval = $item['require_pre_approval'];
                    $new_event_detail->timezone_string = $item['timezone_string'];
                    $new_event_detail->likes = $item['likes'];
                    $new_event_detail->ticket_id = $item['ticket_id'];
                    $new_event_detail->submitted = $item['submitted'];
                    $new_event_detail->save();

                    $event_setting = new EventsSettings();
                    $event_setting->event_id = $item['id'];
                    $event_setting->event_name = $item['event_name'];
                    $event_setting->event_status = "Closed";
                    $event_setting->imabi_attendees_complete = 0;
                    $event_setting->imabi_attendees_incomplete = 0;
                    $event_setting->save();
                }

                $i++;
            }

            $new_api_sync_record = new ApiSync();
            $new_api_sync_record->event_details = $i;
            $new_api_sync_record->save();

        }

        return redirect('event-general-settings');

    }

    public function api_sync_auto_attendees()
    {

        $attendee_max = EventAttendee::max('id');

        if($attendee_max == null || $attendee_max == ""){
            $attendee_max = 0;
        }

        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'POST',
            'https://islamicmuseum.org.au/tickets/?rest_route=/ima_api/events',
            [
                'multipart' => [
                    [
                        'name'     => 'request_name',
                        'contents' => 'attendees'
                    ],
                    [
                        'name'     => 'last_rec',
                        'contents' => $attendee_max
                    ]
                ]
            ]);

        //dd($response->getBody()->getContents());
        $status = $response->getStatusCode(); // 200
        $phrase = $response->getReasonPhrase(); // OK

        //dd($response->getBody()->getContents());

        $data = json_decode($response->getBody()->getContents(), true);



        if($status == "200" && $phrase == "OK"){
            $i = 0;
            foreach ($data as $item){
                if($item['id'] > $attendee_max){
                    $new_attendee = new EventAttendee();
                    $new_attendee->id = $item['id'];
                    $new_attendee->registration_id = $item['registration_id'];
                    $new_attendee->is_primary = $item['is_primary'];
                    $new_attendee->lname = $item['lname'];
                    $new_attendee->fname = $item['fname'];
                    $new_attendee->address = $item['address'];
                    $new_attendee->address2 = $item['address2'];
                    $new_attendee->city = $item['city'];
                    $new_attendee->state = $item['state'];
                    $new_attendee->zip = $item['zip'];
                    $new_attendee->country_id = $item['country_id'];
                    $new_attendee->organization_name = $item['organization_name'];
                    $new_attendee->vat_number = $item['vat_number'];
                    $new_attendee->email = $item['email'];
                    $new_attendee->phone = $item['phone'];
                    $new_attendee->date = $item['date'];
                    $new_attendee->price_option = $item['price_option'];
                    $new_attendee->orig_price = $item['orig_price'];
                    $new_attendee->final_price = $item['final_price'];
                    $new_attendee->quantity = $item['quantity'];
                    $new_attendee->total_cost = $item['total_cost'];
                    $new_attendee->amount_pd = $item['amount_pd'];
                    $new_attendee->coupon_code = $item['coupon_code'];
                    $new_attendee->payment = $item['payment'];
                    $new_attendee->payment_status = $item['payment_status'];
                    $new_attendee->txn_type = $item['txn_type'];
                    $new_attendee->txn_id = $item['txn_id'];
                    $new_attendee->payment_date = $item['payment_date'];
                    $new_attendee->event_id = $item['event_id'];
                    $new_attendee->event_time = $item['event_time'];
                    $new_attendee->end_time = $item['end_time'];
                    $new_attendee->start_date = $item['start_date'];
                    $new_attendee->end_date = $item['end_date'];
                    $new_attendee->attendee_session = $item['attendee_session'];
                    $new_attendee->transaction_details = $item['transaction_details'];
                    $new_attendee->pre_approve = $item['pre_approve'];
                    $new_attendee->checked_in = $item['checked_in'];
                    $new_attendee->checked_in_quantity = $item['checked_in_quantity'];
                    $new_attendee->hashSalt = $item['hashSalt'];
                    $new_attendee->save();

                    if($item['payment_status'] == "Completed"){
                        DB::table("events_settings")
                            ->where('event_id', $item['event_id'] )
                            ->increment('imabi_attendees_complete', $item['quantity']);
                    }

                    if($item['payment_status'] == "Incomplete"){
                        DB::table("events_settings")
                            ->where('event_id', $item['event_id'] )
                            ->increment('imabi_attendees_incomplete', $item['quantity']);
                    }

                    if($item['payment_status'] == "" || $item['payment_status'] == Null){
                        DB::table("events_settings")
                            ->where('event_id', $item['event_id'] )
                            ->increment('imabi_attendees_incomplete', $item['quantity']);
                    }

                }

                $i++;
            }

            $new_api_sync_record = new ApiSync();
            $new_api_sync_record->attendees = $i;
            $new_api_sync_record->save();
        }

        return redirect('event-general-settings');

    }


    public function api_sync_auto_events_time()
    {

        EventsStartEnd::truncate();

        $event_time_max = EventsStartEnd::max('id');

        if($event_time_max == null || $event_time_max == ""){
            $event_time_max = 0;
        }

        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'POST',
            'https://islamicmuseum.org.au/tickets/?rest_route=/ima_api/events',
            [
                'multipart' => [
                    [
                        'name'     => 'request_name',
                        'contents' => 'time'
                    ],
                    [
                        'name'     => 'last_rec',
                        'contents' => $event_time_max
                    ]
                ]
            ]);

        //dd($response->getBody()->getContents());
        $status = $response->getStatusCode(); // 200
        $phrase = $response->getReasonPhrase(); // OK

        //dd($response->getBody()->getContents());

        $data = json_decode($response->getBody()->getContents(), true);



        if($status == "200" && $phrase == "OK"){

            $i = 0;
            foreach ($data as $item){
                if($item['id'] > $event_time_max){
                    $new_time = new EventsStartEnd();
                    $new_time->id = $item['id'];
                    $new_time->event_id = $item['event_id'];
                    $new_time->start_time = $item['start_time'];
                    $new_time->end_time = $item['end_time'];
                    $new_time->reg_limit = $item['reg_limit'];
                    $new_time->save();
                }

                $i++;
            }

            /*
            $new_api_sync_record = new ApiSync();
            $new_api_sync_record->event_time = $i;
            $new_api_sync_record->save();
            */
        }

        return redirect('event-general-settings');

    }



    public function api_sync_auto_events_price()
    {
        EventsPrices::truncate();

        $event_price_max = EventsPrices::max('id');

        if($event_price_max == null || $event_price_max == ""){
            $event_price_max = 0;
        }

        $client = new GuzzleHttp\Client();

        $response = $client->request(
            'POST',
            'https://islamicmuseum.org.au/tickets/?rest_route=/ima_api/events',
            [
                'multipart' => [
                    [
                        'name'     => 'request_name',
                        'contents' => 'price'
                    ],
                    [
                        'name'     => 'last_rec',
                        'contents' => $event_price_max
                    ]
                ]
            ]);

        //dd($response->getBody()->getContents());
        $status = $response->getStatusCode(); // 200
        $phrase = $response->getReasonPhrase(); // OK

        //dd($response->getBody()->getContents());

        $data = json_decode($response->getBody()->getContents(), true);



        if($status == "200" && $phrase == "OK"){

            $i = 0;
            foreach ($data as $item){
                if($item['id'] > $event_price_max){
                    $new_time = new EventsPrices();
                    $new_time->id = $item['id'];
                    $new_time->event_id = $item['event_id'];
                    $new_time->price_type = $item['price_type'];
                    $new_time->event_cost = $item['event_cost'];
                    $new_time->surcharge = $item['surcharge'];
                    $new_time->surcharge_type = $item['surcharge_type'];
                    $new_time->member_price_type = $item['member_price_type'];
                    $new_time->member_price = $item['member_price'];
                    $new_time->max_qty = $item['max_qty'];
                    $new_time->max_qty_members = $item['max_qty_members'];
                    $new_time->save();
                }

                $i++;
            }

            /*
            $new_api_sync_record = new ApiSync();
            $new_api_sync_record->event_price = $i;
            $new_api_sync_record->save();
            */
        }

        return redirect('event-general-settings');

    }


    public function force_sync_all()
    {
        $this->api_sync_auto_events();
        $this->api_sync_auto_attendees();
        $this->api_sync_auto_events_time();
        $this->api_sync_auto_events_price();

        return redirect('ima-event');
    }

    public function force_sync_all_new_db()
    {
        EventAttendee::truncate();
        EventsDetail::truncate();
        EventsStartEnd::truncate();
        EventsPrices::truncate();
        EventsSettings::truncate();

        $this->api_sync_auto_events();
        $this->api_sync_auto_attendees();
        $this->api_sync_auto_events_time();
        $this->api_sync_auto_events_price();

        return redirect('ima-event');
    }

}
