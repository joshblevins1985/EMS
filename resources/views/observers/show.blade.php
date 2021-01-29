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
    <div class="col-lg-9 col-md-12">
        <table class="table table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Peceptor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($od as $row)
                    <tr>
                        
                        <td>{{date('D m-d-Y', strtotime($row->start))}}</td>
                        <td>{{date('H:i', strtotime($row->start))}}</td>
                        <td>{{date('H:i', strtotime($row->end))}}</td>
                        <td>{{$row->preceptors->first_name or 'No'}}  {{$row->preceptors->last_name or ' Preceptor'}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
    
    <div class="col-lg-3 col-md-12">
        <div class="row">
            <!--Deep-orange-->
                <button type="button" class="btn btn-deep-orange" data-toggle="modal" data-target="#basicExampleModal">Add Attachment</button>
        </div>
        
        <div class="row">
            
        </div>
    </div>

</div>

 <!--Modal for Adding Attachments-->

    <!-- Modal -->
    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Attachments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/observerattachments" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        <div class="form-group">

                            <label for="Product Name">Attachment Name</label>

                            <input type="text" name="name" class="form-control"  placeholder="Attachment Title" >

                        </div>

                        <label for="Attachment Title">Attachment:</label>

                        <input type="hidden" name="pid" value="{{$observers->id}}">

                        <br />

                        <input type="file" class="form-control" name="attachments[]" multiple />

                        <br /><br />

                        <input type="submit" class="btn btn-primary" value="Upload" />

                    </form>
                </div>

            </div>
        </div>
    </div>

@stop

@section('styles')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@stop

@section('scripts')

<script>
    $('#starttime').pickatime({
        // 12 or 24 hour
        twelvehour: false,
    });

    $('#endtime').pickatime({
        // 12 or 24 hour
        twelvehour: false,
    });
</script>
@stop
