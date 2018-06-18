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

    <h3>IMA Business Intelligence Event Report</h3>

    <h2>Event Name: {{$event->event_name}}</h2>
    <h2>Date: {{$event->event_date}}</h2>
    <h2 class="text-uppercase">Time: {{$event->event_start_time}}</h2>
    <h2>Attendees: {{$event->attendees_total}}</h2>

    <table class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Tickets</th>
                <th>Total ($)</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attendees as $attendee)
                <tr>
                    <td>{{$attendee->fname}}</td>
                    <td>{{$attendee->lname}}</td>
                    <td>{{$attendee->email}}</td>
                    <td>{{$attendee->phone}}</td>
                    <td>{{$attendee->quantity}}</td>
                    <td class="text-right">{{$attendee->ticket_total}}</td>
                    <td>{{date('d-m-Y', strtotime($attendee->date))}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script type="text/javascript">
        window.onload = function() { window.print(); }
    </script>

</body>
</html>