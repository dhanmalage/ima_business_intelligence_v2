@extends('layouts.app')

@section('content')

    <div class="clearfix"></div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Events history as at @foreach($last_event_detail as $eve_detail) {{date('d/m/Y', strtotime($eve_detail->created_at))}} @endforeach</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <ul class="list-unstyled timeline">
                    @foreach($events as $event)
                        <li>
                            <div class="block">
                                <div class="tags">
                                    <a href="/ima-event/{{ $event->id }}" class="tag ima-bg-orange">
                                        <span>Event</span>
                                    </a>
                                </div>
                                <div class="block_content position-relative dashboard-history-wrap">
                                    <div class="num-new-records-events"><span class="home-attendees-num">{{ $event->imabi_attendees_complete }} / {{ $event->imabi_attendees_complete + $event->imabi_attendees_incomplete }}</span><span>Attendees / Total</span></div>
                                    <h2 class="title home-event-title">
                                        <a href="/ima-event/{{ $event->id }}">
                                            {{ $event->event_name }}
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
                                    </h2>
                                    <p class="excerpt dashboard-import-note">{{date('d/m/Y', strtotime($event->start_date))}} at {{ $event->start_time }}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data update history</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <ul class="list-unstyled timeline">
                    @foreach($api_sync_data as $record)
                        @if($record->event_details != null)
                            <li>
                                <div class="block">
                                    <div class="tags">
                                        <a href="" class="tag ima-bg-green">
                                            <span>API Sync</span>
                                        </a>
                                    </div>
                                    <div class="block_content position-relative dashboard-history-wrap">
                                        <div class="num-new-records"><span class="numberCircle">{{ $record->event_details }}</span><span>New Records</span>
                                        </div>
                                        <h2 class="title">
                                            <a>Events Data Sync</a>
                                        </h2>
                                        <div class="byline">
                                            <span>{{ $record->created_at }}</span> by <a>System automation</a>
                                        </div>
                                        <p class="excerpt dashboard-file-name">New Data Sync: <span> System generated automatically</span></p>
                                    </div>
                                </div>
                            </li>
                        @endif
                            @if($record->attendees != null)
                                <li>
                                    <div class="block">
                                        <div class="tags">
                                            <a href="" class="tag ima-bg-green">
                                                <span>API Sync</span>
                                            </a>
                                        </div>
                                        <div class="block_content position-relative dashboard-history-wrap">
                                            <div class="num-new-records"><span class="numberCircle">{{ $record->attendees }}</span><span>New Records</span>
                                            </div>
                                            <h2 class="title">
                                                <a>Attendees Data Sync</a>
                                            </h2>
                                            <div class="byline">
                                                <span>{{ $record->created_at }}</span> by <a>System automation</a>
                                            </div>
                                            <p class="excerpt dashboard-file-name">New Data Sync: <span> System generated automatically</span></p>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($record->event_time != null)
                                <li>
                                    <div class="block">
                                        <div class="tags">
                                            <a href="" class="tag ima-bg-green">
                                                <span>API Sync</span>
                                            </a>
                                        </div>
                                        <div class="block_content position-relative dashboard-history-wrap">
                                            <div class="num-new-records"><span class="numberCircle">{{ $record->event_time }}</span><span>New Records</span>
                                            </div>
                                            <h2 class="title">
                                                <a>Event Times Update</a>
                                            </h2>
                                            <div class="byline">
                                                <span>{{ $record->created_at }}</span> by <a>System automation</a>
                                            </div>
                                            <p class="excerpt dashboard-file-name">New Data Sync: <span> System generated automatically</span></p>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($record->event_price != null)
                                <li>
                                    <div class="block">
                                        <div class="tags">
                                            <a href="" class="tag ima-bg-green">
                                                <span>API Sync</span>
                                            </a>
                                        </div>
                                        <div class="block_content position-relative dashboard-history-wrap">
                                            <div class="num-new-records"><span class="numberCircle">{{ $record->event_price }}</span><span>New Records</span>
                                            </div>
                                            <h2 class="title">
                                                <a>Event Prices Update</a>
                                            </h2>
                                            <div class="byline">
                                                <span>{{ $record->created_at }}</span> by <a>System automation</a>
                                            </div>
                                            <p class="excerpt dashboard-file-name">New Data Sync: <span> System generated automatically</span></p>
                                        </div>
                                    </div>
                                </li>
                            @endif
                    @endforeach
                </ul>

            </div>
        </div>
    </div>

@endsection
