@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>All Events <small>Summary Report</small></h3>
        </div>
    </div>

    <div class="clearfix"></div>

    @if(!empty($flashMsg))
        <div class="alert alert-success"> {{ $flashMsg }}</div>
    @endif

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>All IMA Events <small>Summary</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        This is a summary report of all events in IMA
                    </p>
                    <table @hasanyrole('super_admin|administrator') id="datatable-buttons" @else id="datatable" @endhasanyrole class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Attendees</th>
                                <th>Tickets</th>
                                <th>Paid Total</th>
                                <th>Status</th>

                                @role('super_admin|administrator')
                                    <th>Actions</th>
                                @endrole

                            </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($events as $event)
                            <tr>
                                <td><a href="{{url('ima-event/' . $event->id)}}">{{ $i }}</a></td>
                                <td><a href="{{url('ima-event/' . $event->id)}}">{{$event->event_name}}</a></td>
                                <td><a href="{{url('ima-event/' . $event->id)}}">{{date('d-m-Y', strtotime($event->start_date))}}</a></td>
                                <td><a href="{{url('ima-event/' . $event->id)}}">{{$event->event_start_time}}</a></td>
                                <td><a href="{{url('ima-event/' . $event->id)}}">{{$event->imabi_attendees_complete}}</a></td>
                                <td><a href="{{url('ima-event/' . $event->id)}}">{{$event->reg_limit}}</a></td>
                                <td><a href="{{url('ima-event/' . $event->id)}}">${{number_format( $event->member_price * $event->imabi_attendees_complete , 2 , '.' , ',' )}}</a></td>

                                <td>
                                    <a href="/ima-event/{{ $event->id }}" class="event-status">
                                        @if($event->event_status == "Open")
                                            <span class="label label-success">{{ $event->event_status }}</span>
                                        @endif
                                        @if($event->event_status == "Closed")
                                            <span class="label label-info">{{ $event->event_status }}</span>
                                        @endif
                                        @if($event->event_status == "Postponed")
                                            <span class="label label-warning">{{ $event->event_status }}</span>
                                        @endif
                                        @if($event->event_status == "Cancelled")
                                            <span class="label label-danger">{{ $event->event_status }}</span>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    @role('super_admin')
                                        <a href="{{url('event-settings/' . $event->setting_id . '/edit')}}" class="ima-color-red table-action-button" title="Edit"><i class="fa fa-pencil"></i></a>
                                    @endrole
                                    <a href="{{url('ima-event/ima-event-details-print/' . $event->id)}}" class="ima-color-red table-action-button" target="_blank" title="Print"><i class="fa fa-print"></i></a>
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
