@extends('layouts.app')

@section('page-title', trans('Unit Maintanance Request'))
@section('page-heading', trans('Maintanance Request'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')

@include('partials.toastr')
<div class="row-fluid" style="height: 100%; overflow:visible;">
    
{!! Form::open(['route' => 'maintanance.store', 'id' => 'maintanance-form']) !!}    
@include('mechanic.partials.malfunctionform')

{!! Form::close() !!}
</div>
@stop

@section('styles')

@stop
 
@section('scripts')
<?php
function fill_unit_select_box($malfunctions)
{ 
 $output= '';
 foreach($malfunctions as $malfunction)
 {
  
  $output .= '<option value="'.$malfunction->id.'">'.$malfunction->label.'</option>';
 }
 return $output;
}
?>
<script>
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr>';
  html += '<td><select name="problem[]" class="browser-default custom-select" searchable="Select Problem" ><option value="" selected>Select Problem</option> <?php echo fill_unit_select_box($malfunctions) ?> </select></td>';
  html += '<td><input type="text" name="pcomment[]" class="form-control"></td>';
  html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-eraser"></span></button></td></tr>';
  $('#item_table').append(html);
 });
 
 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });
 

 
});
</script>
@stop