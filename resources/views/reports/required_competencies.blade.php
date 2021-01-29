@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Create Employee')
    </li>
@stop

@section('content')

@include('partials.toastr')


    @foreach($station as $row)
    <div class="row">
        <div class="col-lg-12">
            <h3>{{$row->station}}</h>
            <hr>
        </div>
        <div class="col-lg-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>Skill</th>
                        <th>Employee Count</th>
                        <th>Basic</th>
                        <th>Advanced</th>
                        <th>Paramedic</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rc as $rowr)
                    <tr>
                        <td>{{$rowr->label}}</td>
                        <td>
                            
                        </td>
                        <td>
                            <? 
                            $employee = Vanguard\Employee::where('status', 5)->where('primary_position', 3)->where('primary_station', $row->id)->where('status', 5)->count();
                            $today = time();
                        
                            $start = strtotime('-'.$rowr->renew.'months', $today);
                            
                            $today = date('Y-m-d', $today);
                            
                            $start = date('Y-m-d', $start);
                             $ec = Vanguard\Employee::whereHas('competencies' , function ($q) use($rowr, $start, $today){$q->where('competency_id', $rowr->id); $q->whereBetween('completed', [$start, $today]);})->where('status', 5)->where('primary_position', 3)->where('primary_station', $row->id)->count(); 
                        
                            if($employee == 0)
                            {
                                $completed = "NA";
                            }elseif($ec > 0){
                              $completed = $ec / $employee * 100;  
                            }else{
                                $completed = 0;
                            }
                            
                            $completed = round($completed)
                            ?>
                           
                            <a href="competency/{{$row->id}}/{{$rowr->id}}/3">{{ $completed }} %</a>
                        </td>
                        <td>
                            <? 
                            $employee = Vanguard\Employee::where('status', 5)->where('primary_position', 4)->where('primary_station', $row->id)->where('status', 5)->count();
                            $today = time();
                        
                            $start = strtotime('-'.$rowr->renew.'months', $today);
                            //dd($start);
                            $today = date('Y-m-d', $today);
                            
                            $start = date('Y-m-d', $start);
                            
                           // dd($start);
                             $ec = Vanguard\Employee::whereHas('competencies' , function ($q) use($rowr, $start, $today){$q->where('competency_id', $rowr->id); $q->whereBetween('completed', [$start, $today]);})->where('status', 5)->where('primary_position', 4)->where('primary_station', $row->id)->count(); 
                        
                            if($employee == 0)
                            {
                                $completed = "NA";
                            }elseif($ec > 0){
                              $completed = $ec / $employee * 100;  
                              
                              
                            }else{
                                $completed = 0;
                            }
                            
                            $completed = round($completed)
                            ?>
                           
                            <a href="competency/{{$row->id}}/{{$rowr->id}}/4">{{ $completed }} %</a>
                        </td>
                        <td>
                            <? 
                            $employee = Vanguard\Employee::where('status', 5)->where('primary_position', 5)->where('primary_station', $row->id)->where('status', 5)->count();
                            $today = time();
                        
                            $start = strtotime('-'.$rowr->renew.'months', $today);
                            
                            $today = date('Y-m-d', $today);
                            
                            $start = date('Y-m-d', $start);
                            $level = Vanguard\Employee::where('primary_position', 5)->where('status', 5)->where('primary_station', $row->id)->count();
                             $ec = Vanguard\Employee::whereHas('competencies' , function ($q) use($rowr, $start, $today){$q->where('competency_id', $rowr->id); $q->whereBetween('completed', [$start, $today]);})->where('status', 5)->where('primary_station', $row->id)->where('primary_position', 5)->count(); 
                            
                            if($employee == 0)
                            {
                                $completed = "NA";
                            }elseif($ec > 0){
                              $completed = $ec / $employee * 100; 
                              
                              $test = $ec.' / '.$employee;
                            }else{
                                $completed = 0;
                            }
                            
                            $completed = round($completed) 
                            ?>
                           
                            <a href="competency/{{$row->id}}/{{$rowr->id}}/5">{{ $completed }} %</a>
                            
                        </td>
                    </tr>
                    @endforeach
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