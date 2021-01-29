@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Companies')
</li>
@stop

@section('content')

<a href="/qa/report/pdf/{{$start}}/{{$end}}">Export PDF</a>
<div class="row">
    <div class="col-sm-12 col-lg-8">
        <h1>Quality Assurance Report</h1>
    </div>
    <div class="col-sm-12 col-lg-4">
        <table>
            <tbody>
                <tr>
                    <td></td>
                    <td>Quality Assurance Report</td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td>{{date('m-d-Y', strtotime($start))}}</td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td>{{date('m-d-Y', strtotime($end))}}</td>
                </tr>
                <tr>
                    <td>Requested By:</td>
                    <td>{{ auth()->user()->present()->nameOrEmail }}</td>
                </tr>
            </tbody>
        </table>
        
    </div> 
    <hr>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class = "table table">
            <thead>
                <tr>
                   <th align="center">Total Sufficient</th>
                    <th align="center">Total Insufficient</th> 
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($qa_count as $row)
                        <td align="center">{{$row->count}}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>

@foreach($qas as $row)
<div class="row">
    <h5>{{$row->first_name}} {{$row->last_name}} -- {{$row->eid}} -- Phone: {{ $row->phone_mobile ?? 'Unknown' }}</h5>
</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table">
            
                <tr>
                    <th width="5%">QA Date</th>
                   <th width="5%" >Run Date</th>
                   <th width="40%">Comments</th>
                    <th width="40%">Opportunities</th>
                    <th width="5%">Grade</th>
                    <th width="5%">Acknowledged</th>
                </tr>
            
            <tbody>
                @foreach($row->qa as $row2)
                <tr>
                   <td>{{date('m-d-Y', strtotime($row2->created_at))}}</td>
                   <td>{{date('m-d-Y', strtotime($row2->date))}}</td>
                    <td>{!!$row2->comments!!}</td>
                    <td>
                        @foreach($row2->deficiencies as $row3)
                            <p>{{$row3->defficiency}}</p>
                        @endforeach
                        
                    </td>
                    <td>@if($row2->grade == 1) Sufficient @elseif($row2->grade == 2) Insufficient @else Unknown @endif </td>
                    <td>@if(!$row2->acknowledged) Pending @else Acknowledged
 @endif</td>
                    
                </tr>
                @endforeach
                

                
            </tbody>
        </table>
    </div>
</div>

@endforeach






@stop

@section('styles')
<style>
    .btn-link{
  border:none;
  outline:none;
  background:none;
  cursor:pointer;
  color:#0000EE;
  padding:0;
  text-decoration:underline;
  font-family:inherit;
  font-size:inherit;
}
</style>
@stop

@section('scripts')

<script>
    // Data Picker Initialization
    $('.datepicker').pickadate();
</script>
@stop