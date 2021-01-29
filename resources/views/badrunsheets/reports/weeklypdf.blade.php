<html>
<head>
	<title>Quality Assurance - PDF</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

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
    <div class="col-6">
        <canvas id="line-chart" ></canvas>
        <img id="url" />
    </div>
    <div class="col-6">
        <canvas id="bar-chart-horizontal"></canvas>
        <img id="bar" />
    </div>
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
</body>


<script>

var lineChartData = {
			labels: <?php echo json_encode( array_column($brs_count->toArray(), 'monname')) ?>,
    datasets: [{ 
        data: [{{ implode(' , ', array_column($brs_count->toArray(), 'count')) }}],
        label: "Total Added",
        borderColor: "#3e95cd",
        fill: false
      }, { 
        data: [{{ implode(' , ', array_column($brs_count->toArray(), 'bad')) }}],
        label: "Total Uncorrected",
        borderColor: "#8e5ea2",
        fill: false
      }, { 
        data: [{{ implode(' , ', array_column($brs_count->toArray(), 'fixed')) }}],
        label: "Total Corrected",
        borderColor: "#3cba9f",
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
          data: [{{ implode(' , ', array_column($employee_count->toArray(), 'count')) }}]
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




</html>