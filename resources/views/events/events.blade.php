@extends('layouts.app')

@section('content')

    <div class="clearfix"></div>

    <div class="header-buttons-wrap">
        <a class="btn btn-app" href="/events-analysis">
            <i class="fa fa-bar-chart"></i> View Analysis
        </a>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>IMA Events Summary</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        This is a summary report of all events
                    </p>
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>Attendees</th>
                                <th>Total (A$)</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($events as $event)
                            <tr>
                                <td><a href="{{url('events/' . $event->id)}}">{{ $i }}</a></td>
                                <td><a href="{{url('events/' . $event->id)}}">{{$event->event_name}}</a></td>
                                <td><a href="{{url('events/' . $event->id)}}">{{date('d-m-Y', strtotime($event->event_date))}}</a></td>
                                <td class="text-uppercase"><a href="{{url('events/' . $event->id)}}">{{$event->event_start_time}}</a></td>
                                <td><a href="{{url('events/' . $event->id)}}">{{$event->attendees_total}}</a></td>
                                <td class="text-right"><a href="{{url('events/' . $event->id)}}">{{$event->paid_total}}</a></td>
                                <td>
                                    <a href="{{url('events/' . $event->id)}}" class="event-status text-center">
                                        @if($event->event_status == "open")
                                            <span class="label label-success">Open</span>
                                        @endif
                                        @if($event->event_status == "closed")
                                            <span class="label label-info">Closed</span>
                                        @endif
                                        @if($event->event_status == "sold")
                                            <span class="label label-default">Sold out</span>
                                        @endif
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{url('events/' . $event->id)}}" class="" title="View"><span class="label btn-success"><i class="fa fa-search"></i> View</span></a>
                                    <a href="{{url('event-details-print/' . $event->id)}}" class="" target="_blank" title="Print"><span class="label btn-dark"><i class="fa fa-print"></i> Print</span></a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
