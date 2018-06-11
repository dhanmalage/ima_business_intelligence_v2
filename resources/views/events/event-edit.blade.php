@extends('layouts.app')

@section('content')

    <div class="page-title">
        <div class="title_left">
            <h3>Edit Event</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="header-buttons-wrap">
        <a class="btn btn-app" href="/ima-event">
            <i class="fa fa-reply"></i> Events
        </a>
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
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />

                        {!! Form::model($event, ['action' => ['EventsSettingsController@update', $event->id], 'role' => 'form', 'method' => 'PATCH', 'class'=>'form-horizontal form-label-left']) !!}
                        @csrf

                    <div class="form-group">
                        <div class="col-md-3 col-sm-3 col-xs-12"></div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <p class="text-muted font-13 m-b-30">
                                You are editing event <code>{{ $event->event_name  }}</code>
                            </p>
                        </div>
                    </div>
                    <!--
                    <div class="form-group">
                        {!! Form::label('name', 'Tickets', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        <div class="col-md-4 col-sm-4 col-xs-12">
                        {!! Form::text('tickets_total', null, ['class' => 'form-control col-md-7 col-xs-12', 'placeholder' => '#']) !!}
                        </div>
                    </div>
                    -->
                    <div class="form-group">
                        {!! Form::label('name', 'Status', ['class' => 'control-label col-md-3 col-sm-3 col-xs-12']) !!}
                        <div class="col-md-4 col-sm-4 col-xs-12">
                        {!! Form::select('event_status', ['' => 'Select a status', 'Open' => 'Open',  'Closed' => 'Closed', 'Postponed' => 'Postponed', 'Cancelled' => 'Cancelled' ], null , array('class' => 'form-control col-md-7 col-xs-12', 'id' => 'status')) !!}
                        </div>
                    </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <a class="btn btn-primary" href="/ima-event">Cancel</a>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
