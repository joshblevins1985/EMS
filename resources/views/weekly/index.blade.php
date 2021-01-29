@extends('layouts.app')

@section('page-title', trans('Weekly Kick Off Reports'))
@section('page-heading', trans('Weekly Kick Off Rerports'))

@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('Companies')
</li>
@stop

@section('content')

@include('partials.toastr')

<div class="row">

    <div class="col-sm-7">
        @include('weekly.partials.accordian')
    </div>

</div>






@stop

@section('styles')

@stop

@section('scripts')

<script>
    $('#starttime').pickatime({
        // 12 or 24 hour
        twelvehour: false,
    });
</script>

<script>
    function printDiv() 
{

  var divToPrint=document.getElementById('payrollReport');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.write('<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">');
  
  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}

</script>
@stop