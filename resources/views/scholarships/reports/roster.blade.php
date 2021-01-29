<html>
<head>
    <title>Quality Assurance - PDF</title>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="http://pro.fontawesome.com/releases/v5.12.1/css/all.css" integrity="sha384-TxKWSXbsweFt0o2WqfkfJRRNVaPdzXJ/YLqgStggBVRREXkwU7OKz+xXtqOU4u8+" crossorigin="anonymous">


    <style>
    thead { display: table-header-group }
tfoot { display: table-row-group }
tr { page-break-inside: avoid }
</style>
</head>
<body>
<div class="container">
    <div class="row mb-5">
        <div class="col-8">
            <h1>Scholarship Entrance Doc's</h1>
        </div>
        <div class="col-4">
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>Scholarship Entrance Doc's</td>
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
        <div class="row ">
            <div class="col-12 text-center mb-5">
                <h1>Accepted Students</h1>
            </div>

            <div class="col-12">

            </div>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>HS</th>
                <th>DL</th>
                <th>HLTH</th>
                <th>HLTH</th>
                <th>Drug</th>
                <th>CHS</th>
                <th>MEET</th>
                <th>AC</th>
                <th>BA</th>
                <th>status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($scholarship->applicants as $row)
            <tr @if($row->confirmed_orientation == 1) class="" @endif>
                <td>
                    
                    @if($row->confirmed_orientation == 1)
                    <span class="badge badge-pill green"><i class="fas fa-calendar-check"></i></span>
                    @endif

                </td>
                <td>{{$row->last_name or ''}}, {{$row->first_name or ''}}
                <p>{{ '('.substr($row->phone, 0, 3).') '.substr($row->phone, 3, 3).'-'.substr($row->phone,6)  }}</p>
                <p>{{$row->email ?? ''}}</p>
                </td>
                <td><span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span></td>
                <td><span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span></td>
                <td><span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span></td>
                <td><span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span></td>
                <td><span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span></td>
                <td><span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span></td>
                <td><span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span></td>
                <td><span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span></td>
                <td><span class="badge badge-pill red"><i class="fas fa-folder-times"></i></span></td>
                <td>
                    @if($row->status == 1) Applied @elseif($row->status == 2) Accepted @elseif($row->status == 3) Denied @elseif($row->status == 4) Enrolled @elseif($row->status == 5) Testing @elseif($row->status == 6) Passed @elseif($row->status == 7) Failed @elseif($row->status == 8) Dropped @endif
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>


</div>
</body>
<footer>

</footer>

</html>