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

<style>
    body {
        background-color: #05304d !important;
    }
</style>
<div class="row">

    <div class="col-sm-2">

    </div>

    <div class="col-sm-12 align-self-center">
        <div class="row">
            <div class="col">
                <img src="{{ url('public/assets/img/peasi.png') }}" alt="{{ settings('app_name') }}" height="200">
            </div>
        </div>
        <div class="row">
            <div class="col">

                <ul class="nav md-pills nav-justified pills-blue " id="pills-tab" role="tablist">
                    
                    <li class="nav-item ">
                        <a class="nav-link  active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="true">Narcotic Logging</a>
                    </li>
                    
                    <li class="nav-item " style="display: none;">
                        <a class="nav-link  disabled" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="false" >Clock In</a>
                    </li>
                    

                </ul>


                <div class="tab-content pt-2 pl-1" id="pills-tabContent">
                    <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <form role="search" method="GET" action="{{ route('timeclock.punch') }}" autocomplete="off">
                            <div class="mb-form">
                                <input type="password" class="form-control form-control-lg clock_id" id="clock_id" name="clock_id" autocomplete="off"></input>
                                <label class="" for="demo">Employee Clock In Id</label>
                            </div>

                            <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                                    type="submit">
                                Clock In / Out
                            </button>
                        </form>
                    </div>
                    <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <form role="search" method="GET" action="{{ route('logistic.mnbcreate') }}" autocomplete="off">

                            <div class="mb-form">
                                <select class="mdb-select md-form" id="rfid" name="rfid" searchable="Search here.." >
                                    <option value="" disabled selected>Choose Box Number</option>
                                    @foreach($narcoticboxes as $id => $nb)
                                    <option value="{{$id}}" >{{$nb}}</option>
                                    @endforeach
                                </select>
                                <label class="" for="box_id">Narcotic Box Scan</label>
                            </div>
                                
                            <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0"
                                    type="submit">
                                Log Narcotic Box
                            </button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>


    

    </div>

</div>

@stop


@section('styles')
<style>
    .vertical-center {
        min - height: 100 % ; /* Fallback for browsers do NOT support vh unit */
        min - height: 100vh; /* These two lines are counted as one :-)       */

        display: flex;
        align - items: center;
    }

    .nmpd-grid {border: none; padding: 20px; }
    .nmpd-grid>tbody>tr>td {border: none; }

    /* Some custom styling for Bootstrap */
    .qtyInput {display: block;
        width: 100 % ;
        padding: 6px 12px;
        color: #556;
        background - color: blue;
        border: 1px solid #ccc;
        border - radius: 4px;
        - webkit - box - shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        box - shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
        - webkit - transition: border - color ease - in - out .15s, - webkit - box - shadow ease - in - out .15s;
        - o - transition: border - color ease - in - out .15s, box - shadow ease - in - out .15s;
        transition: border - color ease - in - out .15s, box - shadow ease - in - out .15s;
    }


</style>

@stop

@section('scripts')




<script type="text/javascript">
        $(function() {
        // Set NumPad defaults for jQuery mobile. 
        // These defaults will be applied to all NumPads within this document!
        $.fn.numpad.defaults.hideDecimalButton = true;
        $.fn.numpad.defaults.hidePlusMinusButton = true;
        $.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
        $.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
        $.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control  input-lg" />';
        $.fn.numpad.defaults.buttonNumberTpl = '<button type="button" class="btn btn-danger btn-lg"></button>';
        $.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn btn-warning btn-lg" style="width: 100%;"></button>';
        $.fn.numpad.defaults.onKeypadCreate = function(){$(this).find('.done').addClass('btn-success'); };
                
                // Instantiate NumPad once the page is ready to be shown
                $(document).ready(function(){

                $('#clock_id').numpad({
        displayTpl: '<input class="form-control" type="password" />'
                        });
                        
                });
        });
</script>



@stop