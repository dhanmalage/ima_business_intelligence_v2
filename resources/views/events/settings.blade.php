@extends('layouts.app')

@section('content')

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Event Settings</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="">

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>General Sync <small>API sync data basic</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <p>This command will allow you to sync data from IMA website using API and update system database. This will only sync the updated data records</p>
                            <!-- start pop-over -->
                            <div class="bs-example-popovers">
                                <a href="{{url('api-sync-auto-events')}}" class="btn btn-default">Events</a>
                                <a href="{{url('api-sync-auto-attendees')}}" class="btn btn-default">Attendees</a>
                                <a href="{{url('api-sync-auto-time')}}" class="btn btn-default">Time</a>
                                <a href="{{url('api-sync-auto-price')}}" class="btn btn-default">Price</a>
                                <a href="{{url('api-force-sync-all')}}" class="btn btn-dark">Sync All</a>
                            </div>
                            <!-- end pop-over -->
                        </div>
                    </div>
                </div>


                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Force Sync <small>API sync data force</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <p>This command will allow you to sync data from IMA website using API and <code>Replace</code> system database. This will rewrite the database.</p>
                            <p><code>Don't do it if you don't know what you are doing :)</code></p>
                            <!-- start pop-over -->
                            <div class="bs-example-popovers">
                                <a href="{{url('api-force-sync-all-new-db')}}" class="btn btn-danger">Force Sync All</a>
                            </div>
                            <!-- end pop-over -->
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
