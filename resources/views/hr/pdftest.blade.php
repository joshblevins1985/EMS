@extends('layouts.app')

@section('title', 'Administration Dashboard')

@push('css')
<link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
<link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />



@endpush

@section('content')
        <link href="https://cdn.syncfusion.com/16.1.0.24/js/web/flat-azure/ej.web.all.min.css" rel="stylesheet" />
<script src="https://cdn.syncfusion.com/js/assets/external/jquery-3.1.1.min.js"></script>
<script src="https://cdn.syncfusion.com/16.1.0.24/js/web/ej.web.all.min.js"></script>
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
    <li class="breadcrumb-item active">Dashboard v3</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header mb-3">Dashboard v3</h1>
<!-- end page-header -->


<div class="col">
    <!-- Creating a div tag which will act as a container for ejPdfViewer widget.-->
<div id="viewer"></div>
<script type="text/javascript">
        $(function () {
            $("#viewer").ejPdfViewer({ serviceUrl: '../api/PdfViewer', enableSignature: true, documentPath: "https://peasi.app/storage/app/attachments/0XZDjKosHDHvLLJxSv01nhez6n0BF5vN0Rmzw8IW.pdf" });
        });
</script>
</div>

@endsection


@push('scripts')
<script src="/assets/plugins/d3/d3.min.js"></script>
<script src="/assets/plugins/nvd3/build/nv.d3.js"></script>
<script src="/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="/assets/plugins/moment/moment.js"></script>
<script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="/assets/js/demo/dashboard-v3.js"></script>





@endpush
