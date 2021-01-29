<html>
<head>
	<title>Quality Assurance - PDF</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.12.1/css/all.css" integrity="sha384-TxKWSXbsweFt0o2WqfkfJRRNVaPdzXJ/YLqgStggBVRREXkwU7OKz+xXtqOU4u8+" crossorigin="anonymous">

<style>
        thead { display: table-header-group }
tfoot { display: table-row-group }
tr { page-break-inside: avoid }
</style>
</head>
<body>
<div class="container">
    <div class="row">
    <div class="col-8">
        <h1>Daily Vehicle Status/Mileage Report</h1>
    </div>
    <div class="col-4">
        <table>
            <tbody>
                <tr>
                    <td></td>
                    <td>Vehicle Status/Mileage Report</td>
                </tr>
                <tr>
                    <td>Date Ran</td>
                    <td>{{date('m-d-Y', strtotime('now'))}}</td>
                </tr>
                
                <tr>
                    <td>Requested By:</td>
                    <td>System Generated</td>
                </tr>
            </tbody>
        </table>
        
    </div> 
    <hr>
    </div>
    
    <div class="row">
        <table class="table table-stiped">
            <thead>
                <tr>
                    <th></th>
                    <th>Unit Number</th>
                    <th>Location</th>
                    <th>Scheduled Miles</th>
                    <th>Current Odometer</th>
                    <th>Miles Left in Schedule</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection->sortBy('remainder') as $row)
                <tr>
                    <td>@if($row['remainder'] <= 0) <span class="text-danger" ><i class="far fa-oil-can"></i></span> @endif </td>
                    <td>{{ $row['unit_number'] }}</td>
                    <td>{{ $row['location'] }}</td>
                    <td>{{ $row['scheduled_service'] }}</td>
                    <td>{{ $row['odometer'] }}</td>
                    <td>@if($row['remainder'] <= 0) <span class="text-danger" ><i class="far fa-oil-can"></i></span> <small>{{ $row['remainder'] }}</small> @else {{ $row['remainder'] }} @endif </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    

</div>
</body>





</html>