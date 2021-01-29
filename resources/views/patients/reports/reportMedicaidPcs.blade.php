<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Quality Assurance - PDF</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
<style>

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
<div class="row">
    <div class="col-3">
        <img src="https://peasi.app/storage/app/photos/ambualnce.jpg"  style="height:100px; width:200px;">
    </div>
    <div class="col-6 text-center">
        Ohio Department of Medicaid </br>
        <strong>CERTIFICATION OF NECESSITY</strong> </br>
        <strong>FOR NON-EMERGENCY TRANSPORTATION</strong> </br>
        <strong>BY GROUND AMBULANCE</strong>
    </div>
    <div class="col-3">
        <img src="https://peasi.app/storage/app/photos/peasi.png" style="height:100px; width:200px;">

    </div>
</div>

<div class="row">
    <div class="col-12">
            <strong>Individual Information</strong>
    <table class="table table-bordered mb-2">
        <tr>
            <td>
                <span class="text-danger">1. Name <i>(Enter the full name of the individual transported.)</i></span> </br>
                {{ decrypt($pcs->patient->first_name) ?? '&nbsp' }} {{ decrypt($pcs->patient->last_name) ?? '' }}
            </td>
            <td>
                <span class="text-danger">2. Ohio Medicaid Billing Number - <i>12 Digits</i></span> </br>
                &nbsp;
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="text-danger">3. Address <i>(Enter the individual's home address. This information may be used to confirm the idenity of the individual.)</i></span> </br>
                {{ $pcs->patient->street_number ?? '&nbsp' }} {{ decrypt($pcs->patient->route ?? '') }} {{ decrypt($pcs->patient->address_2) ?? '' }} {{ decrypt($pcs->patient->locality) ?? '' }} {{ decrypt($pcs->patient->state) ?? '' }} {{ decrypt($pcs->patient->postal_code) ?? '' }}
            </td>
        </tr>
    </table>
    <strong>Transportation Provider Information</strong>
    <table class="table table-bordered mb-2">
        <tr>
            <td colspan="2">
                <span class="text-danger">4. Provider Name<i>(Enter the Business Name of the tranportation provider.)</i></span> </br>
                <strong>Portsmouth Emergency Ambulance Service Inc</strong>
            </td>
        </tr>
        <tr>
            <td>
                <span class="text-danger">5. Ohio Medicaid Provider Number - <i>7 Digits</i></span> </br>
                <strong>9999999</strong>
            </td>
            <td>
                <span class="text-danger">6. National Provider Number (NPI) - <i>10 Digits</i></span> </br>
                <strong>9999999</strong>
            </td>
        </tr>
        
    </table>
    
    <strong>Certification</strong>
    <table class="table table-bordered mb-2">
        <tr>
            <td rowspan="2" width="50%">
                <span class="text-danger">7. Provider Name<i>(Mark each reason why tranport is being certified as necessary for this individual)</i></span> </br>
               
                During transport, this individual requires. </br>
                
                <?php $s= 0 ?>
                @foreach($pcs->patient->qualification as $row)
                @if($row->qualifier->supervision)
                <?php $s = 1 ?>
                @endif
                @endforeach
                
                @if($s)
                <i class="far fa-check-square fa-2x"></i>
                @else
                <i class="fal fa-stop fa-2x"></i>
                @endif
                 medical treatment or continouts supervision by an EMT. </br>
            
            <?php $o= 0 ?>
                @foreach($pcs->patient->qualification as $row)
                @if($row->qualifier->oxygen)
                <?php $o = 1 ?>
                @endif
                @endforeach
                
                @if($o)
                <i class="far fa-check-square fa-2x"></i>
                @else
                <i class="fal fa-stop fa-2x"></i>
                @endif
                
             the administration or regulation of oxygen by another person. </br>
             
                <?php $r= 0 ?>
                @foreach($pcs->patient->qualification as $row)
                @if($row->qualifier->restraint)
                <?php $r = 1 ?>
                @endif
                @endforeach
                
                @if($r)
                <i class="far fa-check-square fa-2x"></i>
                @else
                <i class="fal fa-stop fa-2x"></i>
                @endif
                
                supervised protective restraint </br>
            </td>
            <td width="50%">
                <span class="text-danger">8. Period Begining Date<i>(Enter the first date of the dertification period.)</i></span> </br>
                {{ Carbon\Carbon::parse($pcs->start_date)->format('M d Y') }}
            </td>
        </tr>
        <tr>
            <td>
                <span class="text-danger">9. Length <i>(Enter the end date to indicate the legth of time for which the individual is certified for transport. For certification on a temporary basis you can enter a date up to 90 days. I f no time period is indicated, then the certification is valid for the Period Begining Date Only.)</i></span> </br>
                End Date: {{ Carbon\Carbon::parse($pcs->end_date)->format('M d Y') }}</br>
                Total Days Valid: 
                <?php 
                $date = Carbon\Carbon::parse($pcs->start_date);
                $now = Carbon\Carbon::parse($pcs->end_date);
                
                $diff = $date->diffInDays($now);
                
                echo $diff;
                ?>
            </td>
        </tr>
    </table>
    
    <strong>Additional Information Relevant to Certification</strong>
    <table class="table table-bordered mb-2">
        <tr>
            <td>
                <span class="text-primary">10. Comments or Explanations. If necessary or appropriate.</span> </br>
               @if($pcs->patient->qualification)
               <table class="table table-borderless">
                   @foreach($pcs->patient->qualification as $row)
                   <tr>
                       <td>{{ $row->qualifier->description }}</td>
                       <td>Secondary to {{ $row->pt_condition->condition->label }}</td>
                   </tr>
                   @endforeach
               </table>
               @else
               &nbsp
               @endif
            </td>
        </tr>
    </table>
    
    <strong>Certifying Practitioner Information</strong>
    <table class="table table-bordered mb-2">
        <tr>
            <td colspan="2">
                <span class="text-danger">11. Name of the  Practitioner <i>(Enter the full name of the certifying practioner.)</i></span> </br>
               {{ $pcs->pt_physician->doctor->first_name ?? '&nbsp' }} {{ $pcs->pt_physician->doctor->middle_initial }} {{ $pcs->pt_physician->doctor->last_name ?? '' }} 
            </td>
        </tr>
        <tr>
            <td>
                <span class="text-danger">12. Ohio Medicaid Provider Number, If Applicable - <i>(7 digits)</i></span> </br>
               {{ $pcs->pt_physician->doctor->medicaid ?? '' }}
            </td>
            <td>
                <span class="text-danger">13. National Provider Number (NPI) - <i>10 Digits</i></span> </br>
                {{ $pcs->pt_physician->doctor->npi }}
            </td>
        </tr>
    </table>
    <strong>Signature Information</strong>
    <table class="table table-bordered mb-2">
        <tr>
            <td>
                <span class="text-danger">14. Date of Signature </span> </br>
               &nbsp
            </td>
            <td>
                <span class="text-danger">15. Name of Person Signing </span> </br>
               &nbsp
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <span class="text-danger">16. Signature and Professional Designation - <i>Persons who, with proper authority or approval, sign on behalf of the certifying practitioner must include the practitioner's name as well as their own signature and designation or job title.</i></span> </br>
              </br>
              </br>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <i class="fal fa-stop fa-2x"></i> Medical Doctor  <i class="fal fa-stop fa-2x"></i>  Doctor of Osteopathic Medicine <i class="fal fa-stop fa-2x"></i> Physician Assistant <i class="fal fa-stop fa-2x"></i> Registered Nurse <i class="fal fa-stop fa-2x"></i> Licensed Social Worker <i class="fal fa-stop fa-2x"></i> Other:_____________________________
            </td>
        </tr>
    </table>
    
    <strong class="text-center">False Certification Constitutes Medicaid Fraud</strong>
    <hr>
    <table class="table table-bordered mb-2">
       <tr>
           <td>
               <small>
               <strong>
                   <i>
                   This form confirms the certification of one individual for transport by one service provider; certification is not transferrable between 
                   individuals or service providers. A phtocopy, an electronic copy, or facsimile transmittal of the completed, signed, and dated certification 
                   form is as valid as the original for documentation purposes. Completion of this form is required in accordance with Chapter 5160-15 of the Ohio Administrative Code.
                   </i>
               </strong>
               </small>
           </td>
       </tr>
    </table>
    </div>
</div>
</div>
</body>

</html>