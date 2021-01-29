<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>CPR Invoice - PDF</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-4">
            <img src="{{ public_path('/assets/img/peasi_lg.png') }}" height="100" width="100%" alt="{{ settings('app_name') }}">
        </div>
        <div class="col-4">
           
        </div>
        <div class="col-4">
            <h1>ID: {{$cpr->id}}</h1>
        </div>
    </div>
    <div class="row" style="min-height: 200px;">
        <div class="col-6">
            <h2>Bill To</h2>
            <address>
              <strong>{{$cpr->facility->name}}</strong><br>
              {{$cpr->facility->house_number}} {{$cpr->facility->street}}<br>
              {{$cpr->facility->city}}, {{$cpr->facility->state}} {{$cpr->facility->zip}}<br>
              <abbr title="Email">E:</abbr> {{$cpr->email or 'No Email Provided' }}
            </address>
        </div>
        <div class="col-6">
            <h2>Send Payment to</h2>
            <address>
              <strong>Portsmouth Emergecny Ambulance</strong><br>
              <strong>Accounting Training</strong><br>
              2796 Gallia Street<br>
              Portsmouth, Ohio 45662<br>
              <abbr title="Email">E:</abbr> training@peasi.net
            </address>
        </div>
    </div>
    
    <div class="row">
        <div class="col-4">
            <h4>Date of Class:</h4>
        </div>
        <div class="col-4">
            <h4>{{ Carbon\Carbon::parse($cpr->start_date)->format('M d, Y') }}</h4>
            
        </div>
    </div>

    
    <div class="row" style="min-height: 500px ;">
        <table class="table table-striped table-sm">
            <thead class="black white-text">
                <tr>
                    <th>Student Name</th>
                    <th>Card Cost</th>
                </tr>
            </thead>
            <tbody>
                @if($cpr->students)
                @foreach($cpr->students as $row)
                <tr>
                    <td>{{$row->student}}</td>
                    <td>@if($cpr->facility->contracted == 1) $6.00 @else $50.00 @endif</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-4"></div>
        <div class="col-4"></div>
        <div class="col-4">
            <table class="table">
                <tbody>
                    <tr>
                        <td>Subtotal</td>
                        <td>
                            <?php
                                if($cpr->facility->contracted == 1){
                                    $subtotal = count($cpr->students) * 6;
                                    echo '$'. number_format($subtotal, 2);
                                }else{
                                    
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tax</td>
                        <td>$0.00</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>$ {{number_format($subtotal, 2)}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>

</html>