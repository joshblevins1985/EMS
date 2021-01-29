@extends('layouts.auth')


        @section('page-title', 'Time Clock Login')


        @section('content')
        @include('partials.messages')
<style>
    body {
        background-color: #05304d !important;
    }
</style>
<div class="row">
    <h1 class="white-text">Your RFID badge has failed. You may click the button below to go back to the start screen and try again. If you get this error again contact Human Resources to replace your ID badge.</h1>

<div class="col-sm-12"><a href="/timeclock"><button class="btn btn-danger btn-rounded btn-block my-4 waves-effect z-depth-0"
        >
            Go Back to main screen
        </button></a></div>
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




@stop


