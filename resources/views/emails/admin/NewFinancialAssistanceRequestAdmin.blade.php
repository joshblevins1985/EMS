<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="http://fonts.googleapis.com/css2?family=Kristi&display=swap" rel="stylesheet">
<style>
    
table { overflow: visible !important; }
thead { display: table-header-group }
tfoot { display: table-row-group }
tr { page-break-inside: avoid }
</style>

</head>
<body style="font-family: Avenir, Helvetica, sans-serif; box-sizing: border-box; color: #74787E; height: 100%; hyphens: auto; line-height: 1.4; margin: 0; -moz-hyphens: auto; -ms-word-break: break-all; width: 100% !important; -webkit-hyphens: auto; -webkit-text-size-adjust: none; word-break: break-word;">

<div class="container">
    
        <div class="row">
            <h1 class="text-center">Educational Assistance Application and Agreement</h1>
            
            <table>
                <tr>
                    <td>Name:</td>
                    <td style="border-bottom: 1pt solid black;">{{$record->employee->first_name}} {{$record->employee->last_name}}</td>
                    <td>Date:</td>
                    <td style="border-bottom: 1pt solid black;">{{ Carbon\Carbon::parse($record->created_at)->format('m-d-Y') }}</td>
                </tr>
                <tr>
                    <td>Address:</td>
                    <td style="border-bottom: 1pt solid black;">{{$record->employee->street_number}} {{$record->employee->route}}</td>
                    <td>Phone:</td>
                    <td style="border-bottom: 1pt solid black;">{{$record->employee->phone_mobile}}</td>
                </tr>
                <tr>
                    <td>City / State/ Zip</td>
                    <td style="border-bottom: 1pt solid black;">{{$record->employee->locality}} {{$record->employee->state}} {{$record->employee->postal_code}}</td>
                </tr>
                <tr>
                    <td>SSN</td>
                    <td style="border-bottom: 1pt solid black;"><?php $s= \Crypt::decrypt($record->employee->ssn); $s=  substr($s, -4); ?> ***-**-{{$s}}</td>
                </tr>
            </table>
        </div>
        
        <div class="row">
            <h2>Course Information</h2>
            
            <table>
                <tr>
                    <td >School Name</td>
                    <td colspan="3" style="border-bottom: 1pt solid black;">{{$record->school}}</td>
                </tr>
                <tr>
                    <td>School Address</td>
                    <td colspan="3" style="border-bottom: 1pt solid black;">{{$record->school_contact}}</td>
                </tr>
                <tr>
                    <td>Courses</td>
                    <td colspan="3" style="border-bottom: 1pt solid black;">{{$record->courses}}</td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td style="border-bottom: 1pt solid black;">{{ Carbon\Carbon::parse($record->start_date)->format('m-d-Y') }}</td>
                    <td>End Date</td>
                    <td style="border-bottom: 1pt solid black;"> {{ Carbon\Carbon::parse($record->end_date)->format('m-d-Y') }} </td>
                </tr>
                <tr>
                    <td colspan="4">How will this course help improve your position with the company: {{$record->imporove or 'No input provided.'}} </td>
                    
                </tr>
            </table>
        </div>
        <div style="page-break-after: always; page-break-inside: avoid;">
            
        </div>
        
        <div class="row">
            <h1 class="text-center">Employee Performance Data</h1>
            
            <h3 class="text-center">Compliance Encounters</h3>
            <table class="table table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Incident Reported</th>
                    </tr>
                </thead>
                <tbody>
                    @if($record->employee->EmployeeEncounters)
                    @foreach($record->employee->EmployeeEncounters->where("created_at",">", Carbon\Carbon::now()->subMonths(12)) as $row)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($row->doi)->format('m-d-Y') }}</td>
                            <td>{!! $row->incident_report !!}</td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="2">No Incidents Found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            
        </div>
        
        <div class="row">
       
            <h3 class="text-center">Attendance Tracking</h>
            <table class="table table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Occurance Type</th>
                    </tr>
                </thead>
                <tbody>
                    @if($record->employee->attendance)
                    @foreach($record->employee->attendance->where("date",">", Carbon\Carbon::now()->subMonths(12)) as $row)
                        <tr>
                            <td>{{ Carbon\Carbon::parse($row->date)->format('m-d-Y') }}</td>
                            <td>{{$row->type->label or 'Unknown'}}</td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="2">No Incidents Found</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            
        </div>
        
        <div style="page-break-after: always; page-break-inside: avoid;">
            
        </div>
        
        
        <div class="row">
            <h1 class="text-center">OTHER DEDUCTION FORM</h1>
            <div class="row mt-5">
                <p>I, {{$record->employee->first_name}} {{$record->employee->last_name}}, authorize a payroll deduction of $ {{round($perPart, 2)}} on my wages/salary.</p>
            
                <p>I agree to repay this amount for the next 26 pay periods or until the full balance of $ {{$record->pmt_plan}} is paid in full.</p>
                
                <p>I also agree that if my employment is terminated prior to total repayment of this amount and any other amounts to which I have authorized a deduction, I authorize the company to deduct any and all unpaid amounts from any wages/salary owed me at the time of termination of memployment,</p>
            
            </div>
            
        </div>
        
        <div class="row mt-5">
            <table class="table">
                <tr>
                    <td><span style="font-family: 'Kristi', cursive; font-size: 30pt;" class="text-primary">{{$record->employee->first_name}} {{$record->employee->last_name}}</span> </td>
                    <td style="vertical-align:bottom;text-align:center;">{{ Carbon\Carbon::parse($record->created_at)->format('m-d-Y H:i:s') }}</td>
                </tr>
                <tr>
                    <td>Employee Signature</td>
                    <td>Date Signed</td>
                </tr>
            </table>
        </div>
        <div style="page-break-after: always; page-break-inside: avoid;">
            
        </div>
        
        <div class="row">
                <h1 class="text-center">Educational Loan Agreement</h1>

                <p>Portsmouth Management Firm has contracted with {{$record->employee->company->name}} to manage it's employees and maintain all contracts between employees and agency. </p>
    
        <p>This Agreement is made as of {{ Carbon\Carbon::parse($record->created_at)->format('F d Y') }}, between Portsmouth Management Firm <em>(PMF)</em>. and employee {{$record->employee->first_name}} {{$record->employee->last_name}} (employee) whom is currently employed as a {{$record->employee->employeepositions->label}} with {{$record->employee->company->name}}. For and in consideration of the provisions set forth below and the mutual covenants and promises herein contained, the receipt and adequacy of which are here-by acknowledged, the parties hereto, intending to be legally bound hereby, agree as follows.</p>
    
        <ol type="1">
            <li> {{$record->employee->company->name}} agrees to pay, on behalf of the employee, ${{$record->pmt_plan}} related to training of {{$record->courses}} courses at {{$record->school}}. </li>
    
            <li> In consideration for any expenses paid by {{$record->employee->company->name}}, the Employee agrees to use any training for which {{$record->employee->company->name}} has paid for the benefit of {{$record->employee->company->name}} only, for 1 year. If the Employee, while employed by {{$record->employee->company->name}}, provides services in direct or indirect competition with {{$record->employee->company->name}} within a 25-mile radius of any {{$record->employee->company->name}} station, whether by employment by a competitor, self-employment, or otherwise, he/she will pay the remaining balance as outlined in section 3 below. The Employee understands that this applies to any services in the car, ambulette, ambulance, emergency 911, mechanic, or billing services. Services approved in writing by administration of Portmouth Management Firm shall be excluded. </li>
    
            <li> 
            <div class="row">
                <div class="col-xl-12">
                <h4> Payment Plan </h4>
                <p>The Employees shall start repayment on <?php 
                $contract_date = Carbon\Carbon::parse($record->created_at)->format('Y-m-d');  
                $payment_start = Vanguard\PayPeriod::where('start', '>=', $contract_date)->where('end', '<=', $contract_date)->first(); 
                ?> 
               @if($payment_start)  {{ Carbon\Carbon::parse($payment_start->pay_date)->format('d-m-Y i') }} @else To Be Determined @endif
                </div>    
                <p> See Appendix A for payment table. </p>
                
            </div>
            </li>
    
            <li> Employee must remain in good standing throughout the term of this contract, the employee will make 26 payments of {{round($perPart, 2)}}.</li>
        
            <li>Any employee not considered to in good standing either by self-terminating employment or 
            termination by other means would not be considered an employee in good standing. At which time the employee will have deducted all remaining funds from their last paycheck. 
            Any balance left will be billed to ex-employee to be paid in full.</li>
    
            <li> All questions concerning the validity or meaning of this Agreement or relating to the rights and obligations of the Parties with respect to performance under this Agreement 
                shall be construed and resolved under the laws of the State of Ohio. </li>
    
            <li> The parties to this Agreement hereby designate the courts of Scioto County, Ohio, as the courts of proper jurisdiction and venue for any actions or proceedings relating to this 
                Agreement, consent to such designation, jurisdiction and venue, and waive any objections or defenses relating to jurisdiction or venue with respect to any action or proceedings 
                initiated therein. </li>
    
            <li> The intention of the Parties to this Agreement is to comply with all laws and public policies, and this Agreement shall be construed consistently with all such laws and public 
                policies to the extent possible. In the event that any of the provisions of this Agreement shall be held by a court of competent jurisdiction to be invalid or unenforceable, 
                the remaining provisions shall nevertheless continue to be valid and enforceable as though the invalid or unenforceable portions had not been included herein. In the event that 
                any provisions of this Agreement relating to duration, territory, and/or scope of restriction, and/or related aspects, shall be held by a court of competent jurisdiction to 
                exceed a maximum restrictiveness such court deems reasonable and enforceable, then the duration, territory, and/or scope of restriction, and/or related aspects deemed reasonable 
                and enforceable by the court shall be construed to be the terms hereunder and be enforced. </li>
    
            <li> No failure by any party to insist upon strict compliance with any term of this Agreement, exercise any option, enforce any right, or seek any remedy upon any default or any 
                other party shall affect, or constitute a waiver of, the party’s right to insist upon such strict compliance, exercise that option, enforce that right, or seek that remedy with 
                respect to that default or any prior, contemporaneous, or subsequent default. No custom or practice of the parties at variance with any provision of this Agreement shall affect 
                or constitute a waiver of any party’s right to demand strict compliance with all provisions of this Agreement. </li>
    
            <li> This document contains the entire agreement among the parties and supersedes any prior discussions, understandings, or agreements among them respecting the subject matter of this 
                Agreement. No alterations, additions, or other changes to this Agreement shall be made or be binding unless made in writing and signed by all parties to this Agreement. </li>
    
        </ol>
        </div>
    
        <div style="page-break-after: always; page-break-inside: avoid;">
            
        </div>
        <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <table class="table">
                            <tr class="text-center">
                                <td class="text-center" style="vertical-align:bottom;text-align:center;">{{$record->employee->first_name}} {{$record->employee->last_name}}</td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"><span style="font-family: 'Kristi', cursive; font-size: 30pt;" class="text-primary">{{$record->employee->first_name}} {{$record->employee->last_name}}</span></td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;">{{ Carbon\Carbon::parse($record->created_at)->format('m-d-Y H:i:s') }}</td>
                            </tr>
                            <tr class="text-center">
                                <td>Employee Name</td>
                                <td>Employee Signature</td>
                                <td>Date Signed</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                            <table class="table">
                            <tr class="text-center">
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                            </tr>
                            <tr class="text-center">
                                <td>Supervisor Name</td>
                                <td>Supervisor Signature</td>
                                <td>Date Signed</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                            <table class="table">
                            <tr class="text-center">
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                            </tr>
                            <tr class="text-center">
                                <td>Director of Education</td>
                                <td>DOE Signature</td>
                                <td>Date Signed</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                            <table class="table">
                            <tr class="text-center">
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                                <td class="text-center" style="vertical-align:bottom;text-align:center;"></td>
                            </tr>
                            <tr class="text-center">
                                <td>Administrator Name</td>
                                <td>Administrator Signature</td>
                                <td>Date Signed</td>
                            </tr>
                        </table>
                    </div>
                    
                </div>
        </div>
        
        
        <div style="page-break-after: always; page-break-inside: avoid;">
            
        </div>
        <div class="row">
                <div class="col-xl-12">
                <h2> Appendix A: Payment Schedule </h2>
                </div>
                
                    <div class="col-xl-12 mt-2">
                            <table class="table table-sm">
                                <tr>
                                    <th>Payment Number</th>
                                    <th>Payment Amount</th>
                                    <th>Balance Owed</th>
                                </tr>
                                @foreach($results as $key => $value)
                                <tr>
                                <th>{{$key}}</th>
                                <td>{{round($perPart, 2)}}</td>
                                <td>{{round($value, 2)}}</td>
                                </tr>
                                @endforeach
                        </div>
            </div>
</div>

</body>
</html>