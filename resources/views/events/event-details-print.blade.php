<html>

    <head>
        <title>IMA Business Intelligence</title>

        <link href="{{url('vendor/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{url('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{url('vendor/nprogress/nprogress.css" rel="stylesheet')}}">
        <link href="{{url('vendor/iCheck/skins/flat/green.css" rel="stylesheet')}}">
        <link href="{{url('vendor/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{url('vendor/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{url('vendor/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{url('vendor/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{url('vendor/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{url('build/css/custom.min.css')}}" rel="stylesheet">
        <link href="{{url('css/styles.css')}}" rel="stylesheet">
    </head>

<body>

    <h3>IMA Business Intelligence Report</h3>

    <h2>Event Name: {{$event->event_name}}</h2>
    <h2>Date: {{$event->start_date}}</h2>
    <h2>Time: {{$event->event_start_time}}</h2>
    <h2>Attendees: {{$event->imabi_attendees_complete}}</h2>

    <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline">
        <thead>
            <tr>
                <th>Reg Date</th>
                <th>Pay Status</th>
                <th>Qty</th>
                <th>Paid</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($event_details as $event_detail)
                <tr>
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

                    <td>{{$event_detail->quantity}}</td>
                    <td>${{$event_detail->amount_pd}}</td>
                    <td>{{$event_detail->fname}}</td>
                    <td>{{$event_detail->lname}}</td>
                    <td>{{$event_detail->email}}</td>
                    <td>{{$event_detail->phone}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script type="text/javascript">
        window.onload = function() { window.print(); }
    </script>

</body>
</html>