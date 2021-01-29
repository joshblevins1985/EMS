<html>
<head>
	<title>Quality Assurance - PDF</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

<style>
        thead {
            display: table-header-group;
        }
        tfoot {
            display: table-row-group;
        }
        tr {
            page-break-inside: avoid;
        }
</style>

</head>
<body>
<div class="container">
    <div class="row">
    <div class="col-8">
        <h1>Weekly Patient Care Report</h1>
    </div>
    <div class="col-4">
        <table>
            <tbody>
                <tr>
                    <td></td>
                    <td>Weekly Report</td>
                </tr>
                <tr>
                    <td>Date Ran</td>
                    <td>{{date('m-d-Y', strtotime('now'))}}</td>
                </tr>
                
                <tr>
                    <td>Requested By:</td>
                    <td>{{ auth()->user()->present()->nameOrEmail or 'System Generated' }}</td>
                </tr>
            </tbody>
        </table>
        
    </div> 
    <hr>
    </div>
<div class="row">
    <div class="col-6" >
        <div class="row">
        <h3 class="text-centered">Returned Run Sheet Count by Week</h3>
    </div>
    
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    @foreach($brs_count as $row)
                    <th>{{$row->monname}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total</td>
                    @foreach($brs_count as $row)
                    <td>{{$row->count}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Total Fixed</td>
                    @foreach($brs_count as $row)
                    <td>{{$row->fixed}}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Total Uncorrected</td>
                    @foreach($brs_count as $row)
                    <td>{{$row->bad}}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
        
        
        
    </div>
    <div class="col-6">
        <div class="row">
        <h3 class="text-centered">Top 10 Employees with Most Returned PCR</h3>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Employee</th>
                    
                    <th>Total Bad Run Sheets</th>

                </tr>
            </thead>
            <tbody>
                @foreach($employee_count as $row)
                <tr>
                    <td>{{ $row->Employee->first_name }} {{ $row->Employee->last_name }}</td>
                    <td>{{ $row->count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        
        
    </div>
    <hr>
</div>
<div class="col-12">
    <div class="row">
    <div class="row">
        <h3 class="text-centered">All Patient Care Reports Greater Than 5 Days</h3>
    </div>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th>Date Entered</th>
                <th>Employee</th>
                <th>Phone Number</th>
                <th>PCR #</th>
            </tr>
            </thead>
            <tbody>

            @if(count($brs_five))
            @foreach($brs_five as $row)
            @include('badrunsheets.partials.rowfive')
            @endforeach
            @else
            <tr><td colspan=5><h2>No Bad Run Sheets Found</h2></td></tr>
            @endif


            </tbody>
        </table>
    </div>
    
    
</div>
</div>


    

</div>
</body>


</html>