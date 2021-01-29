<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Quality Assurance - PDF</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<style>
   body {
font-family: -apple-system, BlinkMacSystemFont, “Segoe UI”, Roboto, “Helvetica Neue”, Arial, sans-serif, “Apple Color Emoji”, “Segoe UI Emoji”, “Segoe UI Symbol”;
/* default is 1rem or 16px */
font-size: 14px;
font-weight: 400;
line-height: 1.0;
}
table {
font-family: -apple-system, BlinkMacSystemFont, “Segoe UI”, Roboto, “Helvetica Neue”, Arial, sans-serif, “Apple Color Emoji”, “Segoe UI Emoji”, “Segoe UI Symbol”;
/* default is 1rem or 16px */
font-size: 14px;
font-weight: 400;
line-height: 1.0;
}
</style>

</head>
<body>
<div class="container" style="font-size: 10px;">
    <div class="row mb-2">
        <div class="col-8">
            <img src="https://peasi.app/storage/app/photos/peasi.png" style="height:200px; width:700px;">
        </div>
        <div class="col-4">
            <table class="table table-bordered">
                <tr>
                    <th>First Name</th>
                    <td>{{ decrypt($pcs->patient->first_name) ?? '' }}</td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td>{{ decrypt($pcs->patient->last_name) ?? '' }}</td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td>{{ Carbon\Carbon::parse($pcs->patient->dob)->format('M d Y') }}</td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td></td>
                </tr>
                <tr>
                    <th>Insurance</th>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <table class="table table-bordered">
            <tr>
                <td>
                    <div class="row">
                        <div class="col-5">
                            <i>Date of order, if different from signature date (MM/DD/YYYY): </i>
                        </div>
                        <div class="col-2 border-bottom">
                            {{ Carbon\Carbon::parse($pcs->created_at)->format('m/d/Y') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            Start Date:
                        </div>
                        <div class="col-3 border-bottom">
                            {{ Carbon\Carbon::parse($pcs->start_date)->format('m/d/Y') }}
                        </div>
                        <div class="col-1">
                            End Date:
                        </div>
                        <div class="col-2 border-bottom">
                            {{ Carbon\Carbon::parse($pcs->end_date)->format('m/d/Y') }}
                        </div>
                        <div class="col-3">
                            Round Trip  @if($pcs->round_trip) <i class="far fa-check-square"></i>  @else <i class="far fa-square-full"></i> @endif Yes @if(!$pcs->round_trip) <i class="far fa-check-square"></i>  @else <i class="far fa-square-full"></i> @endif No
                        </div>
                    </div>
                    
                     </p>
                    
                    Transport From: <u>{{ $pcs->pick_up_address ?? '' }}</u>  Transport To: <u>{{ $pcs->drop_off_address ?? '' }}</u> </p>
                    Number of transports requested: <u>{{ $pcs->number_of_transports }}</u> Procedure Code: <u>{{ $pcs->procedure->code }} - {{ $pcs->procedure->description }}</u>
                    
                    
                </td>
            </tr>
        </table>
    </div>
</div>
</body>

</html>