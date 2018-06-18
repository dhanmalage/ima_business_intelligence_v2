@extends('layouts.app')

@section('content')

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="header-buttons-wrap">
                <a class="btn btn-app" href="/events">
                    <i class="fa fa-flag"></i> View Events
                </a>
                <a class="btn btn-app" href="/events-analysis-open">
                    <i class="fa fa-flag-checkered"></i> Open Events
                </a>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                <span><?php echo Date('m'); ?> <?php echo Date('d'); ?>, <?php echo Date('Y'); ?> - <?php echo Date('m'); ?> <?php echo Date('d'); ?>, <?php echo Date('Y'); ?></span> <b class="caret"></b>
            </div>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>IMA All Events</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        This is a graph of all events division by attendees
                    </p>
                    <div class="x_content">
                        <div id="graph_bar" style="width:100%; height:400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>IMA All Events</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        This is a graph of all events division by attendees
                    </p>
                    <div class="x_content">
                        <canvas id="lineChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hide">
        @foreach($all_events as $event)
            <span class="open-event-detail" data-event="{{$event->event_name}}" data-attendees="{{$event->attendees_total}}"></span>
        @endforeach
    </div>

@endsection
