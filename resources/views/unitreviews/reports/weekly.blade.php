@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Companies')
</li>
@stop

@section('content')

@include('partials.toastr')

<div class="row">
    <div class="col-8">
        <h1>Weekly Drive Cam Report</h1>
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
    <div class="col-6">
        <canvas id="line-chart" ></canvas>
        
    </div>
    <div class="col-6">
        <canvas id="bar-chart-horizontal"></canvas>
        
    </div>
</div>
<div class="row">
    <table class="table">
            <thead>
            <tr>
                <th>Date Entered</th>
                <th>Employee</th>
                <th>Comments</th>
            </tr>
            </thead>
            <tbody>
                @foreach($da_bad as $row)
                <tr>
                    <td>{{ Carbon\Carbon::parse($row->date_of_evaluation)->format('m-d-Y') }}</td>
                    <td>{{$row->employee->first_name}} {{$row->employee->last_name}}</td>
                    <td>{!!$row->comments!!}</td>
                </tr>
                @endforeach
           </tbody>
        </table>
</div>

@stop

@section('styles')

@stop

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

<script>

var lineChartData = {
			labels: <?php echo json_encode( array_column($da->toArray(), 'monname')) ?>,
    datasets: [{ 
        data: [{{ implode(' , ', array_column($da->toArray(), 'time')) }}],
        label: "Total Minutes Viewed",
        borderColor: "#3e95cd",
        fill: false
      }
    ]
        }
    
function done(){
  var url=myLine.toBase64Image();
  document.getElementById("url").src=url;
}
var options = {
  bezierCurve : false,
  animation: {
    onComplete: done
  }
};

	
var myLine = new Chart(document.getElementById("line-chart").getContext("2d"),{
	data:lineChartData,
  type:"line",
  options:options
});

</script>

<script>
//bar chart
var myBar =new Chart(document.getElementById("bar-chart-horizontal"), {
    type: 'horizontalBar',
    data: {
      labels: <?php echo json_encode($lastname) ?>,
      datasets: [
        {
          label: "Patient Reports",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
          data: [{{ implode(' , ', array_column($employee_count->toArray(), 'score')) }}]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Patient Care Reports By Employees'
      },
      animation: {
        duration: 0
    }
    }
});
</script>



@stop