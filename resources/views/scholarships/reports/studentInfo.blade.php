<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Quality Assurance - PDF</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.9.0/css/all.css" integrity="sha384-vlOMx0hKjUCl4WzuhIhSNZSm2yQCaf0mOU1hEDK/iztH3gU4v5NMmJln9273A6Jz" crossorigin="anonymous">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/mdb.min.css') }}">
    <link media="all" type="text/css" rel="stylesheet" href="{{ url('public/assets/css/style.min.css') }}">

    <script src="https://kit.fontawesome.com/6c1803817f.js"></script>

<style>
    thead { display: table-header-group }
tfoot { display: table-row-group }
tr { page-break-inside: avoid }
</style>
</head>
<body>
<div class="container">
    <div class="row mb-5">
        <div class="col-8">
            <h1>Scholarship Entrance Doc's</h1>
        </div>
        <div class="col-4">
            <table>
                <tbody>
                <tr>
                    <td></td>
                    <td>Scholarship Entrance Doc's</td>
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
        <div class="row ">
            <div class="col-12 text-center mb-5">
                <h1>Accepted Students</h1>
            </div>

            <div class="col-12">

            </div>
        </div>
    </div>

    <div class="row">
        <table class="table table-striped">
            <thead>
            <tr>

                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
            </thead>
            <tbody>
            @foreach($scholarship->applicants as $row)
            <tr>
                <td>{{ $row->last_name }}, {{ $row->first_name }}</td>
                <td> {{ $row->phone }}</td>
                <td> {{ $row->email }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>


</div>
</body>
<footer>

</footer>

</html>