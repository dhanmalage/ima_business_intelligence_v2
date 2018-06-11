<?php

namespace App\Http\Controllers;

use App\ImaEvent;
use App\Mail\EventImport;
use Illuminate\Http\Request;
use App\ImaEventDetail;
use Illuminate\Support\Facades\Input;
use DateTime;
use Illuminate\Support\Facades\Auth;
use DB;
use App\EventImportHistory;
use Illuminate\Support\Facades\Mail;

class ImaEventController extends Controller
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
        //$events = ImaEvent::orderBy('source_id', 'desc')->get();

        $events = DB::table("events_details")
            ->selectRaw("events_details.*, events_start_ends.start_time as event_start_time, events_prices.member_price as member_price")
            ->leftjoin("events_start_ends","events_start_ends.event_id","=","events_details.id")
            ->leftjoin("events_prices","events_prices.event_id","=","events_details.id")
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
        return view('events.import');
    }

    /**
     * CSV to Array
     * @param string $filename
     * @param string $delimiter
     * @return array|bool
     */
    function csvToArray($filename = '', $separator = ',', $enclosure = '"')
    {
        if (!file_exists($filename) || !is_readable($filename)){
            return false;
        }else{
            $header = null;
            $data = array();
            if (($handle = fopen($filename, 'r')) !== false)
            {
                while (($row = fgetcsv($handle, 1000, $separator, $enclosure)) !== false)
                {
                    if (!$header)
                        $header = $row;
                    else
                        $data[] = array_combine($header, $row);
                }
                fclose($handle);
            }

            return $data;
        }
    }

    function str_wrap($string = '', $char = '"')
    {
        return str_pad($string, strlen($string) + 2, $char, STR_PAD_BOTH);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth_user = Auth::user();

        //$eventData = new ImaEventDetail(Input::all());

        if (Input::hasFile('event-csv')){

            $csv_file = Input::file('event-csv');

            $file_name = $csv_file->getClientOriginalName();

            $eventArr = $this->csvToArray($csv_file);

            //dd($eventArr[0]['Event Name']);

            $check_event = ImaEvent::where('event_name', '=', $eventArr[0]['Event Name'])->first();



            if ($check_event === null) {
                $event = new ImaEvent();
                $event->group = $eventArr[0]['Group'];
                $event->event_name = $eventArr[0]['Event Name'];
                $event->event_date = $this->date_convert($eventArr[0]['Event Date']);
                $event->event_time = $this->time_convert($eventArr[0]['Event Time']);
                $event->price_total = 0;
                $event->attendees_total = 0;
                $event->amount_paid_total = 0;
                $event->created_by = $auth_user->id;

                $event->save();

                // add record to import history
                $import_history = new EventImportHistory();
                $import_history->event_id = $event->id;
                $import_history->import_note = "New event import";
                $import_history->file_name = $file_name;
                $import_history->new_records_count = count($eventArr);
                $import_history->created_by = $auth_user->id;

                $import_history->save();

                for ($i = 0; $i < count($eventArr); $i ++)
                {

                    $eventArr[$i]['group'] = $eventArr[$i]['Group'];
                    unset($eventArr[$i]['Group']);

                    $eventArr[$i]['web_ref_id'] = $eventArr[$i]['ID'];
                    unset($eventArr[$i]['ID']);

                    $eventArr[$i]['reg_id'] = $eventArr[$i]['Reg ID'];
                    unset($eventArr[$i]['Reg ID']);

                    $eventArr[$i]['pay_method'] = $eventArr[$i]['Payment Method'];
                    unset($eventArr[$i]['Payment Method']);

                    $eventArr[$i]['reg_date'] = $eventArr[$i]['Reg Date'];
                    unset($eventArr[$i]['Reg Date']);

                    $eventArr[$i]['pay_status'] = $eventArr[$i]['Pay Status'];
                    unset($eventArr[$i]['Pay Status']);

                    $eventArr[$i]['pay_type'] = $eventArr[$i]['Type of Payment'];
                    unset($eventArr[$i]['Type of Payment']);

                    $eventArr[$i]['transaction_id'] = $eventArr[$i]['Transaction ID'];
                    unset($eventArr[$i]['Transaction ID']);

                    $eventArr[$i]['price'] = $eventArr[$i]['Price'];
                    unset($eventArr[$i]['Price']);

                    $eventArr[$i]['coupon_code'] = $eventArr[$i]['Coupon Code'];
                    unset($eventArr[$i]['Coupon Code']);

                    $eventArr[$i]['attendees'] = $eventArr[$i]['# Attendees'];
                    unset($eventArr[$i]['# Attendees']);

                    $eventArr[$i]['amount_paid'] = $eventArr[$i]['Amount Paid'];
                    unset($eventArr[$i]['Amount Paid']);

                    $eventArr[$i]['date_paid'] = $eventArr[$i]['Date Paid'];
                    unset($eventArr[$i]['Date Paid']);

                    $eventArr[$i]['event_name'] = $eventArr[$i]['Event Name'];
                    unset($eventArr[$i]['Event Name']);

                    $eventArr[$i]['price_option'] = $eventArr[$i]['Price Option'];
                    unset($eventArr[$i]['Price Option']);

                    $eventArr[$i]['event_date'] = $eventArr[$i]['Event Date'];
                    unset($eventArr[$i]['Event Date']);

                    $eventArr[$i]['event_time'] = $eventArr[$i]['Event Time'];
                    unset($eventArr[$i]['Event Time']);

                    $eventArr[$i]['web_check_in'] = $eventArr[$i]['Website Check-in'];
                    unset($eventArr[$i]['Website Check-in']);

                    $eventArr[$i]['tickets_scanned'] = $eventArr[$i]['Tickets Scanned'];
                    unset($eventArr[$i]['Tickets Scanned']);

                    $eventArr[$i]['check_in_date'] = $eventArr[$i]['Check-in Date'];
                    unset($eventArr[$i]['Check-in Date']);

                    $eventArr[$i]['seat_tag'] = $eventArr[$i]['Seat Tag'];
                    unset($eventArr[$i]['Seat Tag']);

                    $eventArr[$i]['first_name'] = $eventArr[$i]['First Name'];
                    unset($eventArr[$i]['First Name']);

                    $eventArr[$i]['last_name'] = $eventArr[$i]['Last Name'];
                    unset($eventArr[$i]['Last Name']);

                    $eventArr[$i]['email'] = $eventArr[$i]['Email'];
                    unset($eventArr[$i]['Email']);

                    $eventArr[$i]['phone'] = $eventArr[$i]['Phone'];
                    unset($eventArr[$i]['Phone']);


                    $event_detail = new ImaEventDetail();

                    $event_detail->ima_admin_event_id = $event->id;
                    $event_detail->group = $eventArr[$i]['group'];
                    $event_detail->web_ref_id = $eventArr[$i]['web_ref_id'];
                    $event_detail->reg_id = $eventArr[$i]['reg_id'];
                    $event_detail->pay_method = $eventArr[$i]['pay_method'];
                    $event_detail->reg_date = $this->date_convert($eventArr[$i]['reg_date']);
                    $event_detail->pay_status = $eventArr[$i]['pay_status'];
                    $event_detail->pay_type = $eventArr[$i]['pay_type'];
                    $event_detail->transaction_id = $eventArr[$i]['transaction_id'];
                    $event_detail->price = $eventArr[$i]['price'];
                    $event_detail->coupon_code = $eventArr[$i]['coupon_code'];
                    $event_detail->attendees = $eventArr[$i]['attendees'];
                    $event_detail->amount_paid = $eventArr[$i]['amount_paid'];
                    $event_detail->date_paid = $this->date_convert($eventArr[$i]['date_paid']);
                    $event_detail->event_name = $eventArr[$i]['event_name'];
                    $event_detail->price_option = $eventArr[$i]['price_option'];
                    $event_detail->event_date = $this->date_convert($eventArr[$i]['event_date']);
                    $event_detail->event_time = $this->time_convert($eventArr[$i]['event_time']);
                    $event_detail->web_check_in = $eventArr[$i]['web_check_in'];
                    $event_detail->tickets_scanned = $eventArr[$i]['tickets_scanned'];
                    $event_detail->check_in_date = $this->date_convert($eventArr[$i]['check_in_date']);
                    $event_detail->seat_tag = $eventArr[$i]['seat_tag'];
                    $event_detail->first_name = $eventArr[$i]['first_name'];
                    $event_detail->last_name = $eventArr[$i]['last_name'];
                    $event_detail->email = $eventArr[$i]['email'];
                    $event_detail->phone = $eventArr[$i]['phone'];
                    $event_detail->created_by = $auth_user->id;

                    $event_detail->save();
                }

                $price_total = DB::table('ima_event_details')->where('ima_admin_event_id', '=', $event->id)->sum('price');
                $attendees_total = DB::table('ima_event_details')->where('ima_admin_event_id', '=', $event->id)->sum('attendees');
                $attendees_total_complete = DB::table('ima_event_details')->where('ima_admin_event_id', '=', $event->id)->where('pay_status', '=', 'Completed')->sum('attendees');
                $amount_paid_total = DB::table('ima_event_details')->where('ima_admin_event_id', '=', $event->id)->sum('amount_paid');

                if($event){
                    DB::table('ima_events')->where('id', '=', $event->id)->update(['price_total' => $price_total]);
                    DB::table('ima_events')->where('id', '=', $event->id)->update(['attendees_total' => $attendees_total]);
                    DB::table('ima_events')->where('id', '=', $event->id)->update(['attendees_total_complete' => $attendees_total_complete]);
                    DB::table('ima_events')->where('id', '=', $event->id)->update(['amount_paid_total' => $amount_paid_total]);
                }

                // send email for new event import
                //Mail::to('dmmdust@gmail.com')->send(new EventImport());

            }else{
                    //$existing_row_count = ImaEventDetail::where(['ima_admin_event_id' => $check_event->id])->count();

                    $j = 0;
                    for ($i = 0; $i < count($eventArr); $i ++)
                    {
                        $eventArr[$i]['group'] = $eventArr[$i]['Group'];
                        unset($eventArr[$i]['Group']);

                        $eventArr[$i]['web_ref_id'] = $eventArr[$i]['ID'];
                        unset($eventArr[$i]['ID']);

                        $eventArr[$i]['reg_id'] = $eventArr[$i]['Reg ID'];
                        unset($eventArr[$i]['Reg ID']);

                        $eventArr[$i]['pay_method'] = $eventArr[$i]['Payment Method'];
                        unset($eventArr[$i]['Payment Method']);

                        $eventArr[$i]['reg_date'] = $eventArr[$i]['Reg Date'];
                        unset($eventArr[$i]['Reg Date']);

                        $eventArr[$i]['pay_status'] = $eventArr[$i]['Pay Status'];
                        unset($eventArr[$i]['Pay Status']);

                        $eventArr[$i]['pay_type'] = $eventArr[$i]['Type of Payment'];
                        unset($eventArr[$i]['Type of Payment']);

                        $eventArr[$i]['transaction_id'] = $eventArr[$i]['Transaction ID'];
                        unset($eventArr[$i]['Transaction ID']);

                        $eventArr[$i]['price'] = $eventArr[$i]['Price'];
                        unset($eventArr[$i]['Price']);

                        $eventArr[$i]['coupon_code'] = $eventArr[$i]['Coupon Code'];
                        unset($eventArr[$i]['Coupon Code']);

                        $eventArr[$i]['attendees'] = $eventArr[$i]['# Attendees'];
                        unset($eventArr[$i]['# Attendees']);

                        $eventArr[$i]['amount_paid'] = $eventArr[$i]['Amount Paid'];
                        unset($eventArr[$i]['Amount Paid']);

                        $eventArr[$i]['date_paid'] = $eventArr[$i]['Date Paid'];
                        unset($eventArr[$i]['Date Paid']);

                        $eventArr[$i]['event_name'] = $eventArr[$i]['Event Name'];
                        unset($eventArr[$i]['Event Name']);

                        $eventArr[$i]['price_option'] = $eventArr[$i]['Price Option'];
                        unset($eventArr[$i]['Price Option']);

                        $eventArr[$i]['event_date'] = $eventArr[$i]['Event Date'];
                        unset($eventArr[$i]['Event Date']);

                        $eventArr[$i]['event_time'] = $eventArr[$i]['Event Time'];
                        unset($eventArr[$i]['Event Time']);

                        $eventArr[$i]['web_check_in'] = $eventArr[$i]['Website Check-in'];
                        unset($eventArr[$i]['Website Check-in']);

                        $eventArr[$i]['tickets_scanned'] = $eventArr[$i]['Tickets Scanned'];
                        unset($eventArr[$i]['Tickets Scanned']);

                        $eventArr[$i]['check_in_date'] = $eventArr[$i]['Check-in Date'];
                        unset($eventArr[$i]['Check-in Date']);

                        $eventArr[$i]['seat_tag'] = $eventArr[$i]['Seat Tag'];
                        unset($eventArr[$i]['Seat Tag']);

                        $eventArr[$i]['first_name'] = $eventArr[$i]['First Name'];
                        unset($eventArr[$i]['First Name']);

                        $eventArr[$i]['last_name'] = $eventArr[$i]['Last Name'];
                        unset($eventArr[$i]['Last Name']);

                        $eventArr[$i]['email'] = $eventArr[$i]['Email'];
                        unset($eventArr[$i]['Email']);

                        $eventArr[$i]['phone'] = $eventArr[$i]['Phone'];
                        unset($eventArr[$i]['Phone']);

                        $check_record = DB::table('ima_event_details')
                            ->where('web_ref_id', '=', $eventArr[$i]['web_ref_id'])
                            ->where('reg_id', '=', $eventArr[$i]['reg_id'])
                            ->first();

                        //$check_record = ImaEventDetail::where('web_ref_id', $eventArr[$i]['web_ref_id'])->where('reg_id', $check_event->id)->get();

                        //dd($check_record);

                        if($check_record == null){
                            $event_detail = new ImaEventDetail();

                            $event_detail->ima_admin_event_id = $check_event->id;
                            $event_detail->group = $eventArr[$i]['group'];
                            $event_detail->web_ref_id = $eventArr[$i]['web_ref_id'];
                            $event_detail->reg_id = $eventArr[$i]['reg_id'];
                            $event_detail->pay_method = $eventArr[$i]['pay_method'];
                            $event_detail->reg_date = $this->date_convert($eventArr[$i]['reg_date']);
                            $event_detail->pay_status = $eventArr[$i]['pay_status'];
                            $event_detail->pay_type = $eventArr[$i]['pay_type'];
                            $event_detail->transaction_id = $eventArr[$i]['transaction_id'];
                            $event_detail->price = $eventArr[$i]['price'];
                            $event_detail->coupon_code = $eventArr[$i]['coupon_code'];
                            $event_detail->attendees = $eventArr[$i]['attendees'];
                            $event_detail->amount_paid = $eventArr[$i]['amount_paid'];
                            $event_detail->date_paid = $this->date_convert($eventArr[$i]['date_paid']);
                            $event_detail->event_name = $eventArr[$i]['event_name'];
                            $event_detail->price_option = $eventArr[$i]['price_option'];
                            $event_detail->event_date = $this->date_convert($eventArr[$i]['event_date']);
                            $event_detail->event_time = $this->time_convert($eventArr[$i]['event_time']);
                            $event_detail->web_check_in = $eventArr[$i]['web_check_in'];
                            $event_detail->tickets_scanned = $eventArr[$i]['tickets_scanned'];
                            $event_detail->check_in_date = $this->date_convert($eventArr[$i]['check_in_date']);
                            $event_detail->seat_tag = $eventArr[$i]['seat_tag'];
                            $event_detail->first_name = $eventArr[$i]['first_name'];
                            $event_detail->last_name = $eventArr[$i]['last_name'];
                            $event_detail->email = $eventArr[$i]['email'];
                            $event_detail->phone = $eventArr[$i]['phone'];
                            $event_detail->created_by = $auth_user->id;

                            $event_detail->save();

                            $j++;
                        }

                    }

                    if($j > 0){
                        $import_note = "Event already exists. New records are imported";

                        //Mail::to('dmmdust@gmail.com')->send(new EventImport());

                    }else{
                        $import_note = "Event already exists. No new records";
                    }

                    // add record to import history
                    $import_history = new EventImportHistory();
                    $import_history->event_id = $check_event->id;
                    $import_history->import_note = $import_note;
                    $import_history->file_name = $file_name;
                    $import_history->new_records_count = $j;
                    $import_history->created_by = $auth_user->id;

                    $import_history->save();

                $price_total = DB::table('ima_event_details')->where('ima_admin_event_id', '=', $check_event->id)->sum('price');
                $attendees_total = DB::table('ima_event_details')->where('ima_admin_event_id', '=', $check_event->id)->sum('attendees');
                $attendees_total_complete = DB::table('ima_event_details')->where('ima_admin_event_id', '=', $check_event->id)->where('pay_status', '=', 'Completed')->sum('attendees');
                $amount_paid_total = DB::table('ima_event_details')->where('ima_admin_event_id', '=', $check_event->id)->sum('amount_paid');

                DB::table('ima_events')->where('id', '=', $check_event->id)->update(['price_total' => $price_total]);
                DB::table('ima_events')->where('id', '=', $check_event->id)->update(['attendees_total' => $attendees_total]);
                DB::table('ima_events')->where('id', '=', $check_event->id)->update(['attendees_total_complete' => $attendees_total_complete]);
                DB::table('ima_events')->where('id', '=', $check_event->id)->update(['amount_paid_total' => $amount_paid_total]);

                $events = ImaEvent::all();

                if($j > 0){

                    // send email for existing event import

                    $flashMsg = "Event already exists! " . $j . " Records are imported";
                }else{
                    $flashMsg = "Event already exists! " . $j . " Records are imported";
                }

                return view('events.events', compact('events','flashMsg'));

            }

        }

        $events = ImaEvent::all();
        return view('events.events', compact('events'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImaEvent  $imaEvent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = ImaEvent::findOrFail($id);

        $event_details = DB::table('ima_event_details')
            ->where('ima_admin_event_id', '=', $id)->get();
        return view('events.event-details', compact('event_details', 'event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ImaEvent  $imaEvent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = ImaEvent::findOrFail($id);

        return view('events.event-edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ImaEvent  $imaEvent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
                'tickets_total'=>'integer',
                'status' =>'string',
            ]
        );

        $event = ImaEvent::findOrFail($id);
        $event->update($request->all());
        return redirect('ima-event');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ImaEvent  $imaEvent
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImaEvent $imaEvent)
    {
        //
    }

    /**
     * Print an event
     *
     */
    public function print_event_details($id)
    {
        $event = ImaEvent::findOrFail($id);

        $event_details = DB::table('ima_event_details')
            ->where('ima_admin_event_id', '=', $id)->get();

        return view('events.event-details-print', compact('event', 'event_details'));
    }

}
