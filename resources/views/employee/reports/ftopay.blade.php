<html>
<head>
    <title>Quality Assurance - PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
</head>
<body>
@foreach()
<div class="container">
    <div class="row">
        <div class="col-8">
            <h1>Training Officer Pay Report</h1>
        </div>
        <div class="col-4">
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>Training Officer Pay</td>
                </tr>
                <tr>
                    <td>Start Date</td>
                    <td>{{date('m-d-Y', strtotime('now'))}}</td>
                </tr>
                <tr>
                    <td>End Date</td>
                    <td>{{date('m-d-Y', strtotime('now'))}}</td>
                </tr>
                <tr>
                    <td>Requested By:</td>
                    <td>Auto Generated Email</td>
                </tr>
                </tbody>
            </table>

        </div>
        <hr>
    </div>

    <div class="row">
        <div class="col-lg-3">
            Field Training Officer:
        </div>

        <div class="col-lg-3">
            {{$employee->first_name}} {{$employee->last_name}}
        </div>

        <div class="col-lg-3">
            Employee ID:
        </div>
        <div class="col-lg-3">
            {{$employee->eid}}
        </div>
    </div>


    



</div>
</body>
</html>