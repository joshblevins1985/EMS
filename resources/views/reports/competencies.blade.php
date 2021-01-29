<html>
<head>
    <title>Employee Competency Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <link media="all" type="text/css" rel="stylesheet" href="https://peasi.app/public/assets/css/mdb.min.css">
    <link media="all" type="text/css" rel="stylesheet" href="https://peasi.app/public/assets/css/style.min.css">

</head>
<body>
<div class="container">
    <div class="row mb-5">
        <div class="col-8">
            <h1>Employee Competency Report</h1>
        </div>
        <div class="col-4">
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>Employee Competency Report</td>
                </tr>
                <tr>
                    <td>Date Ran</td>
                    <td>{{date('m-d-Y', strtotime('now'))}}</td>
                </tr>

                <tr>
                    <td>Requested By:</td>
                    <td>System Generated</td>

                </tr>

                </tbody>
            </table>

        </div>
        <hr>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Employee</th>
                    <th>Station</th>
                    <th>Eagle Vent</th>
                    <th>AHP-3000 Vent</th>
                    <th>BiPap Management</th>
                </tr>
                </thead>
                <tbody>

                @foreach($employees as $e)
                    <tr>
                        <td>{{ $e->last_name }} {{ $e->first_name }}</td>
                        <td>{{ $e->station->station }}</td>
                        <td>
                            @if(count($e->competencies->where('competency_id', 11)))
                                @foreach($e->competencies->where('competency_id', 11) as $c)
                                    @if(is_null($c->completed))

                                    @else
                                        {{ Carbon\Carbon::parse($c->completed)->format('m-d-Y') }}
                                    @endif
                                @endforeach
                            @else

                            @endif
                        </td>
                        <td>
                            @if(count($e->competencies->where('competency_id', 12)))
                                @foreach($e->competencies->where('competency_id', 12) as $c)
                                    @if(is_null($c->completed))

                                    @else
                                        {{ Carbon\Carbon::parse($c->completed)->format('m-d-Y') }}
                                    @endif
                                @endforeach
                            @else

                            @endif
                        </td>
                        <td>
                            @if(count($e->competencies->where('competency_id', 10)))
                                @foreach($e->competencies->where('competency_id', 10) as $c)
                                    @if(is_null($c->completed))

                                    @else
                                        {{ Carbon\Carbon::parse($c->completed)->format('m-d-Y') }}
                                    @endif
                                @endforeach
                            @else

                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>


</div>
</body>
<footer>

</footer>

</html>