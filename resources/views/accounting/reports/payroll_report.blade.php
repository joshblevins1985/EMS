@extends('layouts.app')


@section('page-title', 'Accounting Dashborad')


@section('content')
<div class="row">
    <div class="col-8">
        <h1>Payroll Report</h1>
    </div>
    
        <div class="col-sm-4 ">
        <table>
            <thead>
                <tr>
                    <th>Report Type</th>
                    <td>All Active Employee Payroll</td>
                </tr>
                <tr>
                    <th>Start Date</th>
                    <td>{{$start}}</td>
                </tr>
                <tr>
                    <th>End Date</th>
                    <td>{{$end}}</td>
                </tr>
                <tr>
                    <th>Report Ran By</th>
                    <td>{{ auth()->user()->present()->nameOrEmail }}</td>
                </tr>
            </thead>
        </table>
    </div>
    
    
</div>
@foreach($employees as $row)
<?php
                    $wk1tot = 0;
                    $wk2tot = 0;

                    $wk1st = 0;
                    $wk2st = 0;
                    $wk1ot = 0;
                    $wk2ot = 0;
                    $ppst = 0;
                    $ppot = 0;
                    ?>
<div class="row">
    <div class="col-12">
        {{$row->first_name}} {{$row->middle_name}} {{$row->last_name}}
    </div>
    
  
    
                    @if(count($row->timepunch))
                    <?php

                    $ppstart = $start;
                    $wk1end = strtotime($ppstart . '+ 6 days');

                    $ppend = $end;
                    $wk2start = strtotime($ppend . '- 6 days');

                    $ppstart = strtotime($ppstart);
                    $ppend = strtotime($ppend);


                    ?>
                    @foreach($row->timepunch as $add)
                    <?php
                    if ($add->time_out === NULL){

                    }else {
                        $time_in = strtotime($add->time_in);
                        $time_out = strtotime($add->time_out);
                        if ($time_in >= $start && $time_in <= $wk1end) {

                            $shifthours = $time_out - $time_in;

                            $wk1tot = $wk1tot + $shifthours / (60 * 60);

                            if ($wk1tot > 40) {
                                $wk1st = 40;
                                $wk1ot = $wk1tot - 40;
                            } elseif ($wk1tot <= 0) {
                                $wk1ot = 0;
                                $wk1st = $wk1tot;
                            } else {
                                $wk1ot = 0;
                                $wk1st = $wk1tot;
                            }

                        } elseif ($time_in >= $wk2start && $time_in <= $ppend) {

                            if ($add->time_out === NULL) {
                                $shifthours = 0;
                            } else {
                                $shifthours = $time_out - $time_in;

                                $wk2tot = $wk2tot + $shifthours / (60 * 60);


                                if ($wk2tot > 40) {
                                    $wk2st = 40;
                                    $wk2ot = $wk2tot - 40;
                                } elseif ($wk2tot <= 0) {
                                    $wk2ot = 0;
                                    $wk2st = $wk1tot;
                                } else {
                                    $wk2ot = 0;
                                    $wk2st = $wk2tot;
                                }
                            }

                        }
                    }


                    ?>
                    @endforeach

                    <?php
                    $ppst = $wk1st + $wk2st;
                    $ppot = $wk1ot + $wk2ot;
                    $stpay = '0';
                    $otpay = '0';
                    ?>
                    @foreach($row->PayRate as $prow)
                    
                    @if($prow->pay_type == 1)
                    <?php $stpay = $ppst * $prow->rate ?>
                    @elseif($prow->pay_type == 2)
                     <?php $otpay = $ppot * $prow->rate; ?>
                    @elseif($prow->pay_type == 3)
                    <?php $vapay = '' ?>
                    @endif
                    
                    <?php
                    $deposit = $stpay + $otpay ;
                    ?>
                    
                    @endforeach
                    <?php $insurance = 0; 
                        $pretax= 0;
                    ?>
                    @foreach($row->Insurances as $irow)
                    @if($irow->pre_tax == 1)
                    <?php $pretax = $insurance + $irow->rate ?>
                    @else
                    <?php $insurance = $insurance + $irow->rate ?>
                    @endif
                    @endforeach
                    @endif
    
                    <?php
                    $pretaxtotal= $stpay + $otpay - $pretax;
                    $deposit = $pretaxtotal ;
                    ?>
    <div class="col-12">
        <table class="table table">
            <thead>
                <tr>
                    <th>ST</th> <th>OT</th> <th>VAMC</th> <th>PT</th> <th>FED</th> <th>SS</th> <th>MED</th> <th>STATE</th> <th>CITY</th> <th>CHILD</th> <th>INSURANCE</th> <th>DEDUCTION</th> <th>DEPOSIT</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>${{number_format((float)$stpay,2,'.','')}}</td> <td>${{number_format((float)$otpay,2,'.','')}}</td><td></td><td>${{number_format((float)$pretaxtotal,2,'.','')}}</td><td></td><td></td><td></td><td></td><td></td><td></td><td>${{number_format((float)$insurance,2,'.','')}}</td><td></td><td>${{number_format((float)$deposit,2,'.','')}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endforeach
@stop


@section('styles')

@stop

@section('scripts')


@stop


