<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>
<body>

<div class="row mb-3">
    <div class="col-12">
        <div class="float-right">
            <table class="table">
                <tr>
                    <th>Report Type</th>
                    <td> IT Tickets By Stations </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td> {{\Carbon\Carbon::now()->format('m/d/Y H:i')}} </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <h3>Completed Today</h3>
        <ol>
            @foreach($today as $row)
                <li>{{$row->description}}</li>
            @endforeach

        </ol>
    </div>
</div>

<div class="row">
    <div class="col-12">
        @foreach($stations as $row)
            <?php
                $tickets = Vanguard\ItSupportTicket::where('station', $row->id)->where('status', '<=', 80)->get()
            ?>

            <div class="card">
                <div class="card-header">
                    <h3>{{$row->station ?? 'Unknown Station'}}  Station {{$row->id ?? 'Unknown Number'}}</h3>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Asset ID</th>
                            <th>Reported By</th>
                            <th>Problem</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($tickets))
                        @foreach($tickets as $row)
                            <tr>
                                <td>{{$row->asset_id ?? 'No Asset'}}</td>
                                <td>{{$row->reported_by ?? 'Unknown'}}</td>
                                <td>{{$row->description ?? 'Unknown'}}</td>
                            </tr>
                        @endforeach
                        @else
                            <tr>
                                <td colspan="3" class="text-center">No Known Issues</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">

                </div>
            </div>
        @endforeach
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>