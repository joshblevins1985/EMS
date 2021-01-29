@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Companies')
</li>
@stop

@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-8">
        <h1>Employee Quarterly Attendance Report</h1>
    </div>
    <div class="col-sm-12 col-lg-4">
        <table>
            <tbody>
                <tr>
                    <td>Report</td>
                    <td>Attendance Report</td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td>August 01, 2020</td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td>December 31, 2020</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('attend.excell') }}" class="btn btn-success">Export to Excel</a>
    </div> 
</div>
<div class="row">
    @foreach($employees as $row)
    @if($row->total > 6)
    <?php $color = 'table-danger'; ?>
    @else
    <?php $color = '' ?>
    @endif
    <div class="col-lg-12">
         {{$row->first_name}} {{$row->last_name}} - {{$row->eid}}
    </div>
    <div class="col-lg-12">
        <table class="table table">
            <thead>
                <tr>
                    <th>Tardy > 5 min</th>
                    <th>Tardy > 120 min</th>
                    <th>Black Out Call Off</th>
                    <th>No Call No Show</th>
                    <th>Call Off</th>
                    <th>No Time Clock</th>
                    <th>Left Early</th>
                    <th>Compliance</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="{{$color}}">
                    <td>{{$row->late}}</td>
                    <td>{{$row->late120}}</td>
                    <td>{{$row->blackout}}</td>
                    <td>{{$row->nocall}}</td>
                    <td>{{$row->calloff}}</td>
                    <td>{{$row->ntc}}</td>
                    <td>{{$row->lo}}</td>
                    <td>{{$row->compliance}}</td>
                    <td>{{$row->total}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    @endforeach
    {{ $employees->links() }}
</div>
@include('partials.toastr')


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