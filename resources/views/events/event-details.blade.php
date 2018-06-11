@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>{{$event->event_name}} <small> Event #{{$event->id}} Detailed Report</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="header-buttons-wrap">
        <a class="btn btn-app" href="/ima-event">
            <i class="fa fa-reply"></i> Events
        </a>
<!--
        <a class="btn btn-app" href="/ima-event/ima-event-email/{{$event->id}}">
            <i class="fa fa-envelope"></i> Emails
        </a>
        -->
    </div>

    <div class="clearfix"></div>

    <div class="row tile_count">

        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Attendees / Total</span>
            <div class="count">{{$event->imabi_attendees_complete}} / {{$event->imabi_attendees_complete + $event->imabi_attendees_incomplete}}</div>
            <span class="count_bottom"><i class="green">Number of people </i> </span>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-dollar"></i> Total Amount</span>
            <div class="count">{{number_format( $event->imabi_attendees_complete * $event->member_price , 2 , '.' , ',' )}}</div>
            <span class="count_bottom"><i class="green">Total amount received </i> </span>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-calendar-o"></i> Event Date</span>
            <div class="count">{{date('d/m/Y', strtotime($event->start_date))}}</div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Event Time</span>
            <div class="count">{{$event->event_start_time}}</div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{$event->event_name}} <small>{{$event->start_date}}</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        This is a detailed report on <code>{{$event->event_name}}</code> as at {{date('d/m/Y', strtotime($event->start_date))}}
                    </p>
                    <table @hasanyrole('super_admin|administrator') id="datatable-buttons" @else id="datatable" @endhasanyrole class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Reg Date</th>
                            <th>Pay Status</th>
                            <!-- <th>Type of Payment</th> -->
                            <th>Transaction ID</th>
                            <th>Price</th>
                            <th># Attendees</th>
                            <th>Amount Paid</th>
                            <th>Date Paid</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($event_details as $event_detail)
                            <tr>
                                <td>{{$event_detail->id}}</td>
                                <td>{{date('d-m-Y', strtotime($event_detail->date))}}</td>

                                @if($event_detail->txn_type == "securepay_aus" && $event_detail->payment_status == "Completed")
                                    <td>Completed</td>
                                @endif

                                @if($event_detail->txn_type == "SecurePay" && $event_detail->payment_status == "Completed")
                                    <td>Completed</td>
                                @endif

                                @if($event_detail->txn_type == "securepay_aus" && $event_detail->payment_status == "Incomplete")
                                    <td>Payment Failed</td>
                                @endif
								
								@if($event_detail->txn_type == "securepay_aus" && $event_detail->payment_status == "Payment Declined")
                                    <td>Payment Failed</td>
                                @endif

                                @if($event_detail->txn_type == "SecurePay" && $event_detail->payment_status == "Incomplete")
                                    <td>Payment Failed</td>
                                @endif

                                @if($event_detail->txn_type == null && $event_detail->payment_status == "Incomplete")
                                    <td>Website Incomplete</td>
                                @endif

                                @if($event_detail->txn_type == null && $event_detail->payment_status == "Completed")
                                    <td>Free</td>
                                @endif

                                <!-- <td>{{$event_detail->txn_type}}</td> -->

                                <td>{{$event_detail->registration_id}}</td>
                                <td>${{$event_detail->final_price}}</td>
                                <td>{{$event_detail->quantity}}</td>
                                <td>${{$event_detail->amount_pd}}</td>
                                <!-- <td>{{date('d-m-Y', strtotime($event_detail->payment_date))}}</td> -->
                                <td>{{$event_detail->payment_date}}</td>
                                <td>{{$event_detail->fname}}</td>
                                <td>{{$event_detail->lname}}</td>
                                <td>{{$event_detail->email}}</td>
                                <td>{{$event_detail->phone}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
