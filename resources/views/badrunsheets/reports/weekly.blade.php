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
    <div class="col-lg-6">
        <canvas id="lineChart"></canvas>
    </div>
    <div class="col-lg-6">
        <canvas id="horizontalBar"></canvas>
    </div>
</div>
<div class="row">
    <table class="table">
            <thead>
            <tr>
                <th>Employee</th>
                <th>Phone Number</th>
                <th>Total PCR</th>
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

@stop

@section('styles')

@stop

@section('scripts')
<script>
  //line
  var ctxL = document.getElementById("lineChart").getContext('2d');
  var myLineChart = new Chart(ctxL, {
    type: 'line',
    data: {
      labels: <?php echo json_encode( array_column($brs_count->toArray(), 'monname')) ?>,
      datasets: [{
          label: "Total Added",
          data: [{{ implode(' , ', array_column($brs_count->toArray(), 'count')) }}],
          backgroundColor: [
            'rgba(105, 0, 132, .2)',
          ],
          borderColor: [
            'rgba(200, 99, 132, .7)',
          ],
          borderWidth: 2
        },
        {
          label: "Total Uncorrected",
          data: [{{ implode(' , ', array_column($brs_count->toArray(), 'bad')) }}],
          backgroundColor: [
            'rgba(0, 137, 132, .2)',
          ],
          borderColor: [
            'rgba(0, 10, 130, .7)',
          ],
          borderWidth: 2
        },
        {
          label: "Total Corrected",
          data: [{{ implode(' , ', array_column($brs_count->toArray(), 'fixed')) }}],
          backgroundColor: [
            'rgba(46, 204, 113, 1)',
          ],
          borderColor: [
            'rgba(30, 130, 76, 1)',
          ],
          borderWidth: 2
        }
      ]
    },
    options: {
      responsive: true
    }
  });

</script>

<script>
  new Chart(document.getElementById("horizontalBar"), {
    "type": "horizontalBar",
    "data": {
      "labels": <?php echo json_encode($lastname) ?>,
      "datasets": [{
        "label": "Total Returned Run Sheets",
        "data": [{{ implode(' , ', array_column($employee_count->toArray(), 'count')) }}],
        "fill": false,
        "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)",
          "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)",
          "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"
        ],
        "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)",
          "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"
        ],
        "borderWidth": 1
      }]
    },
    "options": {
      "scales": {
        "xAxes": [{
          "ticks": {
            "beginAtZero": true
          }
        }]
      }
    }
  });

</script>

@stop