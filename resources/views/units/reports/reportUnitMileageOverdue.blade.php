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
        <h1>Weekly Vehicle Overdue Mileage </h1>
    </div>
    <div class="col-4">
        <table>
            <tbody>
                <tr>
                    <td></td>
                    <td>Vehicle Overdue Mileage Report</td>
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
                    <th>Unit Number</th>
                    <th>Location</th>
                    <th>Last Odometer Reading</th>
                    <th>Last Date</th>
                    <th>Reported Miles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collection->sortBy('location') as $row)
                <tr>
                    <td>{{ $row['unit_number'] }}</td>
                    <td>{{ $row['location'] }}</td>
                    <td>{{ $row['odometer'] }}</td>
                    <td> {{ Carbon\Carbon::parse($row['odometer_date'])->format('m-d-Y') }} </td>
                    <td>_______________</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    

</div>
</body>





</html>