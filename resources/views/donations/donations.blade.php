@extends('layouts.app')

@section('content')

    <div class="clearfix"></div>

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>IMA Donations Summary</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                        This is a summary report of all main donations
                    </p>
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th>Reference</th>
                            <th>Anonymous</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($donations as $donation)
                            <tr>
                                <td><a href="{{url('donations/' . $donation->id)}}">{{ $i }}</a></td>
                                <td class="text-right"><a href="{{url('donations/' . $donation->id)}}">{{number_format($donation->amount, 2 , '.' , ',' )}}</a></td>
                                <td class="text-capitalize"><a href="{{url('donations/' . $donation->id)}}">{{$donation->donation_type}}</a></td>
                                <td><a href="{{url('donations/' . $donation->id)}}">{{$donation->order_id}}</a></td>
                                <td><a href="{{url('donations/' . $donation->id)}}">{{$donation->anonymous}}</a></td>
                                <td><a href="{{url('donations/' . $donation->id)}}">{{$donation->date}}</a></td>
                                <td><a href="{{url('donations/' . $donation->id)}}">{{$donation->category}}</a></td>
                                <td class="text-center">
                                    <a href="{{url('donations/' . $donation->id)}}" class="" title="View"><span class="label btn-success"><i class="fa fa-search"></i> View</span></a>
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
