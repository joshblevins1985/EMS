@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')
<link href="/public/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
<link href="/public/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
<link href="/public/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
@endpush

@section('content')
<!-- begin breadcrumb -->
<ol class="breadcrumb float-xl-right">
    <li class="breadcrumb-item"><a href="javascript:;">Employee Dashboard</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Bad Run Sheets</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Patient Cre Report Addendum</a></li>
    
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header mb-3">Patient Care Report Addendum</h1>
<!-- end page-header -->

    



@endsection

<div id="pdf" style=" padding:75px">
    
</div>

@push('scripts')
<script src='/public/assets/js/webviewer/lib/webviewer.min.js'></script>
<script>
   
        WebViewer({
          path: '/public/assets/js/webviewer/lib',
          licenseKey: 'Insert commercial license key here after purchase',
          initialDoc: '/storage/app/{{$file->location}}'
        }, document.getElementById('pdf'))
          .then(function(instance) {
            var docViewer = instance.docViewer;
            var annotManager = instance.annotManager;
            var Annotations = instance.Annotations;
        
            instance.disableElement('searchButton');
            instance.setTheme('dark');
            docViewer.setMargin(20);
        
            docViewer.on('documentLoaded', function() {
              // Add customization here
              // Draw rectangle annotation on first page
              var rectangle = new Annotations.RectangleAnnotation();
              rectangle.PageNumber = 1;
              rectangle.X = 100;
              rectangle.Y = 100;
              rectangle.Width = 250;
              rectangle.Height = 250;
              rectangle.Author = annotManager.getCurrentUser();
              annotManager.addAnnotation(rectangle);
              annotManager.drawAnnotations(rectangle.PageNumber);
            });
        
            docViewer.on('fitModeUpdated', function(e, fitMode) {
              console.log('fit mode changed');
            });
          });
        
     
  
</script>
@endpush