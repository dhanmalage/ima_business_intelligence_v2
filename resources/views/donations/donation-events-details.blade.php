@extends('layouts.app')

@section('content')

    <div class="clearfix"></div>

    <div class="header-buttons-wrap">
        <a class="btn btn-app" href="/event-donations">
            <i class="fa fa-reply"></i> Event Donations
        </a>
    </div>

    <div class="clearfix"></div>

    <!-- page content -->
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Donation Details</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <section class="content invoice">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-xs-12 invoice-header">
                                <h1>
                                    <i class="fa fa-dollar"></i> {{number_format( $attendee->donation, 2 , '.' , ',' )}}
                                    <small class="pull-right">Date: {{date('d/m/Y', strtotime($attendee->date))}}</small>
                                </h1>
                            </div>
                            <!-- /.col -->
                        </div>

                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <strong>Personal Details</strong>
                                    <br><b>First Name:</b> {{$attendee->fname}}
                                    <br><b>Last Name:</b> {{$attendee->lname}}
                                    <br><b>Email Address:</b> <a href="mailto:{{$attendee->email}}">{{$attendee->email}}</a>
                                    <br><b>Email Address:</b> <a href="tel:{{$attendee->phone}}">{{$attendee->phone}}</a>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <strong>From</strong>
                                    <br><b>Post Code:</b> {{$attendee->post_code}}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <b>Reference: {{$attendee->reference}}</b>
                                <br><b>Amount:</b> ${{number_format( $attendee->donation, 2 , '.' , ',' )}}
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="x_title">
                            <h2>Main donations history of user <small>{{$attendee->fname}} {{$attendee->lname}}</small></h2>
                            <div class="clearfix"></div>
                        </div>

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Anonymous</th>
                                        <th>Category</th>
                                        <th>Reference</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i = 1; $md = 0; ?>
                                    @foreach($main_donations as $mdonation)
                                        <tr>
                                            <td class="text-capitalize">{{$mdonation->donation_type}}</td>
                                            <td>{{$mdonation->anonymous}}</td>
                                            <td>{{$mdonation->category}}</td>
                                            <td>{{$mdonation->order_id}}</td>
                                            <td>{{date('d/m/Y', strtotime($mdonation->date))}}</td>
                                            <td>{{number_format( $mdonation->amount, 2 , '.' , ',' )}}</td>
                                        </tr>
                                        <?php $i++; $md = $md + $mdonation->amount; ?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="x_title">
                            <h2>Event donations history of user <small>{{$attendee->fname}} {{$attendee->lname}}</small></h2>
                            <div class="clearfix"></div>
                        </div>

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-xs-12 table">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Reference</th>
                                        <th>Event Name</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $ed = 0; ?>
                                    @foreach($event_donations as $edetail)
                                        <tr>
                                            <td>{{$edetail->reference}}</td>
                                            <td>{{$edetail->event_name}}</td>
                                            <td>{{date('d/m/Y', strtotime($edetail->date))}}</td>
                                            <td>{{number_format( $edetail->donation, 2 , '.' , ',' )}}</td>
                                        </tr>
                                        <?php $ed = $ed + $edetail->donation; ?>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-xs-6">

                            </div>
                            <!-- /.col -->
                            <div class="col-xs-6">
                                <p class="lead">Donations Summary</p>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <th style="width:50%">Main Donations:</th>
                                            <td>${{number_format( $md, 2 , '.' , ',' )}}</td>
                                        </tr>
                                        <tr>
                                            <th>Event Donations:</th>
                                            <td>${{number_format( $ed, 2 , '.' , ',' )}}</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td>${{number_format( $md + $ed, 2 , '.' , ',' )}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

@endsection
