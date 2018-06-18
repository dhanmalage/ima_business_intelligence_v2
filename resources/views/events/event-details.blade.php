@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>{{$event->event_name}} <small> Event #{{$event->event_id}} Detailed Report</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="header-buttons-wrap">
        <a class="btn btn-app" href="/events">
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
            <div class="count">{{$event->attendees_total}}</div>
            <span class="count_bottom"><i class="green">Number of people </i> </span>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-dollar"></i> Total Amount</span>
            <div class="count">{{number_format( $event->paid_total, 2 , '.' , ',' )}}</div>
            <span class="count_bottom"><i class="green">Total amount received </i> </span>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-calendar-o"></i> Event Date</span>
            <div class="count">{{date('d/m/Y', strtotime($event->event_date))}}</div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Event Time</span>
            <div class="count text-uppercase">{{$event->event_start_time}}</div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>{{$event->event_name}}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        This is a detailed report on <code>{{$event->event_name}}</code> as at {{date('d/m/Y', strtotime($event->event_date))}}
                    </p>
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Post Code</th>
                            <th>Reg Date</th>
                            <th># Attendees</th>
                            <th>Paid (A$)</th>
                            <th>How did</th>
                            <th>Reference</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; $dc = 0; $dt = 0; ?>
                        @foreach($attendees as $detail)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$detail->fname}}</td>
                                <td>{{$detail->lname}}</td>
                                <td>{{$detail->email}}</td>
                                <td>{{$detail->phone}}</td>
                                <td>{{$detail->post_code}}</td>
                                <td>{{date('d-m-Y', strtotime($detail->date))}}</td>
                                <td>{{$detail->quantity}}</td>
                                <td class="text-right">{{$detail->ticket_total}}</td>
                                <td>{{$detail->how_did}}</td>
                                <td>{{$detail->reference}}</td>
                            </tr>

                            @if($detail->donation > 0)
                                <?php
                                    $dc++;
                                    $dt = $dt + $detail->donation;
                                ?>
                            @endif

                        <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="page-title">
        <div class="title_left">
            <h3>Donations from "{{$event->event_name}}" registered users</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row tile_count">
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Number of Donations</span>
            <div class="count">{{$dc}}</div>
            <span class="count_bottom"><i class="green">Number of people </i> </span>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-dollar"></i> Donation Total</span>
            <div class="count">{{number_format( $dt, 2 , '.' , ',' )}}</div>
            <span class="count_bottom"><i class="green">Total amount received </i> </span>
        </div>
    </div>

    <div class="clearfix"></div>

    @if($dc > 0)

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Donated Attendee Details</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        All donations from  <code>{{$event->event_name}}</code> as at {{date('d/m/Y', strtotime($event->event_date))}}
                    </p>
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Post Code</th>
                            <th>Date</th>
                            <th>Donation</th>
                            <th>Reference</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($attendees as $detail)
                            @if($detail->donation > 0)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$detail->fname}}</td>
                                    <td>{{$detail->lname}}</td>
                                    <td>{{$detail->email}}</td>
                                    <td>{{$detail->phone}}</td>
                                    <td>{{$detail->post_code}}</td>
                                    <td>{{date('d-m-Y', strtotime($detail->date))}}</td>
                                    <td class="text-right">{{number_format($detail->donation, 2 , '.' , ',' )}}</td>
                                    <td>{{$detail->reference}}</td>
                                </tr>
                            @endif
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Event Donations Bar Chart</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        This is a bar chart of <code>{{$event->event_name}}</code> event division by attendees
                    </p>
                    <div class="x_content evdtdonchart">
                        <div id="graphBarEventDonation"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Event Donations Doughnut Chart</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        This is a doughnut chart of <code>{{$event->event_name}}</code> event division by attendees
                    </p>
                    <div class="x_content evdtdonchart">
                        <canvas id="canvasDoughnutEventDonation"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif

    <div class="clearfix"></div>

    <div class="hide">
        @foreach($attendees as $attendee)
            <span class="open-event-detail" data-fname="{{$attendee->fname}}" data-donation="{{$attendee->donation}}"></span>
        @endforeach
    </div>

@endsection
