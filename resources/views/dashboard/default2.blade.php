@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))
<style>
    body {
        background-color: #05304d !important;
    }
</style>
@section('breadcrumbs')
<li class="breadcrumb-item active">
    @lang('app.dashboard')
</li>
@stop

@section('content')

<div class="row" style="height: 500px;">
    <div class="col-md-6" >
        <!--Carousel Wrapper-->
        <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
            <!--Indicators-->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-1z" data-slide-to="1"></li>
                <li data-target="#carousel-example-1z" data-slide-to="2"></li>
            </ol>
            <!--/.Indicators-->
            <!--Slides-->
            <div class="carousel-inner" role="listbox">
                <!--First slide-->
                <div class="carousel-item active">
                    <div class="card card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Others/gradient1.jpg);">

                        <div class="text-white text-center py-5 px-4 my-5">
                            <div>
                                <h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>Fifth Third Financial Benefits</strong></h2>
                                <p class="mx-5 mb-5">You're eligible for Fifth Third's Membership Advantage program, offered through PEASI. Follow the link below to see what Fifth Third has to offer.
                                </p>
                                <a href="https://www.53.com/content/fifth-third/en/mkg/membership-advantage.html?ma=79520" class="btn btn-outline-white btn-md"><i class="fa fa-clone left"></i> View project</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--/First slide-->
                <!--Second slide-->
                <div class="carousel-item">
                    <div class="card card-image" style="background-image: url(https://dehayf5mhw1h7.cloudfront.net/wp-content/uploads/sites/757/2017/02/03134431/FifthThirdBankLogo.jpg);">
                        <div class="text-center align-top"><h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>Fifth Third Financial Benefits</strong></h2></div>
                        <div class="text-center py-5 px-4 my-5 align-bottom">
                            <div>

                            </div>
                        </div>
                        <div class="text-center align-bottom">
                            <p class="mx-5 mb-5">Achieve greatness by making financial decisions that are best for you and your family. Click Get Started or browse the play lists below to begin.
                            </p>
                            <a href="https://53.everfi-next.net/welcome/MA?show=registration&rf=79520" class="btn btn-outline-blue btn-md"><i class="fa fa-clone left"></i> Get Started</a>
                        </div>
                    </div>
                </div>
                <!--/Second slide-->
                <!--Third slide-->
                <div class="carousel-item">
                    <div class="card card-image" style="background-image: url(https://ujg433eawlo3i4uqknhm8e1b-wpengine.netdna-ssl.com/wp-content/uploads/2015/06/firstnet-logo-702x370-702x336.jpg);">

                        <div class="text-center py-5 px-4 my-5 align-bottom">
                            <div>

                            </div>
                        </div>
                        <div class="text-center align-bottom">

                            <a href="https://www.firstnet.com/" class="btn btn-outline-blue btn-md"><i class="fa fa-clone left"></i> View Plans</a>
                        </div>
                    </div>
                </div>
                <!--/Third slide-->
            </div>
            <!--/.Slides-->
            <!--Controls-->
            <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <!--/.Controls-->
        </div>
        <!--/.Carousel Wrapper-->
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('profile') }}" class="text-center no-decoration">
                            <div class="icon my-3">
                                <i class="fas fa-user fa-2x"></i>
                            </div>
                            <p class="lead mb-0">@lang('app.update_profile')</p>
                        </a>
                    </div>
                </div>
            </div>

            @if (config('session.driver') == 'database')
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('profile.sessions') }}" class="text-center  no-decoration">
                            <div class="icon my-3">
                                <i class="fa fa-list fa-2x"></i>
                            </div>
                            <p class="lead mb-0">@lang('app.my_sessions')</p>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('profile.activity') }}" class="text-center no-decoration">
                            <div class="icon my-3">
                                <i class="fas fa-server fa-2x"></i>
                            </div>
                            <p class="lead mb-0">@lang('app.activity_log')</p>
                        </a>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('auth.logout') }}" class="text-center no-decoration">
                            <div class="icon my-3">
                                <i class="fas fa-sign-out-alt fa-2x"></i>
                            </div>
                            <p class="lead mb-0">@lang('app.logout')</p>
                        </a>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="row">
            <!--Card-->
            <div class="card w-100">

                <!--Card content-->
                <div class="card-body elegant-color white-text ">
                    
                    <!--Text-->
                    <h1>Welcome {{ auth()->user()->present()->name }} -- {{ $employee->employeepositions->label or '' }}</h1>
                    <h2>
                        Phone: @if(!$employee) Contact HR 740-351-2617 @else {{ '('.substr($employee->phone_mobile, 0, 3).') '.substr($employee->phone_mobile, 3, 3).'-'.substr($employee->phone_mobile,6)  }}@endif</h2>
                    <small>Confirm this information daily. This information is what the company has on file and utilizes to contact you. </small>
                </div>

            </div>
            <!--/.Card-->
        </div>


    </div>


</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-6">
                        
                        <div class="card">
                            <div class="card-body">
                                
                                <div class="col-md-12">
                                    <div class="row"><h1 class="text-center">Employee Score Card</h1> <small>The employee score card is new and under development. </small></div>
                                    <a data-toggle="modal" data-target="#exampleModalPreview">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                
                                                <div class="col-md-8">
                                                    <h1>Attendance</h1>
                                                    <small>Click to view attendance record.</small>
                                                    
                                                </div>
                                                <div class="col-md-4">
                                                    @if($percent <= 100)
                                                    <i class="far fa-check-square fa-7x" style="color:green" ></i>
                                                    @else
                                                    <i class="far fa-times-circle fa-7x" style="color:red" ></i>
                                                    @endif
                                                </div>
                                                <?php
                                                if($percent >= 0 && $percent <= 25)
                                                {
                                                    $acolor= "bg-success";
                                                }elseif($percent >= 26 && $percent <= 50)
                                                {
                                                    $acolor= "bg-primary";
                                                }elseif($percent >= 51 && $percent <= 99)
                                                {
                                                    $acolor= "bg-warning";
                                                }elseif($percent >= 100)
                                                {
                                                    $acolor= "bg-danger";
                                                }else
                                                {
                                                    $acolor= "";
                                                }
                                                ?>
                                                <div class="col-md-12">
                                                    <div class="progress md-progress" style="height: 20px">
                                                        <div class="progress-bar {{$acolor}}" role="progressbar" style="width: {{$percent}}%; height: 20px" aria-valuenow="1" aria-valuemin="0" aria-valuemax="7"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>

                                </div>
                                <div class="col-md-12">
                                    
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h1>Driving</h1>
                                                </div>
                                                <div class="col-md-4">
                                                    @if($driverpercent >= 50)
                                                    <i class="far fa-check-square fa-7x" style="color:green" ></i>
                                                    @elseif($driverpercent == 0)
                                                    <i class="far fa-check-square fa-7x" style="color:green" ></i>
                                                    @else
                                                    <i class="far fa-times-times fa-7x" style="color:red" ></i>
                                                    @endif
                                                </div>
                                                <div class="col-md-12">
                                                    
                                                    <?php 
                                                    if($driverpercent == 0)
                                                {
                                                    $driverpercent = 100;
                                                    $dcolor= "bg-success";
                                                }elseif($driverpercent >= 90 && $driverpercent <= 100)
                                                {
                                                    $dcolor= "bg-success";
                                                }elseif($driverpercent >= 85 && $driverpercent <= 89)
                                                {
                                                    $dcolor= "bg-primary";
                                                }elseif($driverpercent >= 80 && $driverpercent <= 84 )
                                                {
                                                    $dcolor= "bg-warning";
                                                }
                                                elseif($driverpercent <= 79  )
                                                {
                                                    $dcolor= "bg-danger";
                                                }else{
                                                    $dcolor="";
                                                }
                                                ?>
                                                    
                                                    <div class="progress md-progress" style="height: 20px">
                                                        <div class="progress-bar {{$dcolor}}" role="progressbar" style="width: {{$driverpercent}}%; height: 20px" aria-valuenow="1" aria-valuemin="0" aria-valuemax="7"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-12">
                                    <a data-toggle="modal" data-target="#qaModal">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h1>Quality Assurance</h1>
                                                </div>
                                                <div class="col-md-4">
                                                    @if($qapercent >= 50)
                                                    <i class="far fa-check-square fa-7x" style="color:green" ></i>
                                                    @elseif($qapercent == 0)
                                                    <i class="far fa-check-square fa-7x" style="color:green" ></i>
                                                    @else
                                                    <i class="far fa-times-times fa-7x" style="color:red" ></i>
                                                    @endif
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="progress md-progress" style="height: 20px">
                                                                <?php
                                                if($qapercent == 0)
                                                {
                                                    $qapercent = 100;
                                                    $qacolor= "bg-success";
                                                }elseif($qapercent >= 90 && $qapercent <= 100)
                                                {
                                                    $qacolor= "bg-success";
                                                }elseif($qapercent >= 85 && $qapercent <= 89)
                                                {
                                                    $qacolor= "bg-primary";
                                                }elseif($qapercent >= 80 && $qapercent <= 84 )
                                                {
                                                    $qacolor= "bg-warning";
                                                }
                                                elseif($qapercent <= 79  )
                                                {
                                                    $qacolor= "bg-danger";
                                                }else{
                                                    $qacolor="";
                                                }
                                                ?>
                                                        <div class="progress-bar {{$qacolor}}" role="progressbar" style="width: {{$qapercent}}%; height: 20px" aria-valuenow="1" aria-valuemin="0" aria-valuemax="7"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>

                                </div>
                                <div class="col-md-12">
                                    <a data-toggle="modal" data-target="#complianceModal">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h1>Compliance</h1>
                                                </div>
                                                <div clas="col-md-4">
                                                    
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="progress md-progress" style="height: 20px">
                                                        <div class="progress-bar {{$acolor}}" role="progressbar" style="width: 0%; height: 20px" aria-valuenow="1" aria-valuemin="0" aria-valuemax="7"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row text-center"><h1>Notifications</h1></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach($statecert as $row)
                                                    <?php $expiration = strtotime($row->expiration) ?>
                                                    @if($expiration < strtotime("now"))
                                                    <!--Card-->
                                                    <div class="card">

                                                        <!--Card content-->
                                                        <div class="card-body danger-color-dark white-text">
                                                            <!--Title-->
                                                            <h4 class="card-title">Certification Notification</h4>
                                                            <!--Text-->
                                                            <i class="fa fa-user-md" style="font-size:48px;color:red"></i>
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <span><i class="fa fa-user-md" style="font-size:60px;color:white"></i></span>
                                                                </div>
                                                                <div class="col-9">
                                                                    <p>Your {{$row->states->label or 'Unknown Cert'}} {{$row->certtype->label or ''}} has expired on {{date('m-d-y', strtotime($row->expiration))}}</p>

                                                                    <small>Please contact the human resources department to update this information when your certification is renewed.</small>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--/.Card-->
                                                    @elseif($expiration > strtotime("now") && $expiration < strtotime("+ 60 days"))
                                                    <!--Card-->
                                                    <div class="card">

                                                        <!--Card content-->
                                                        <div class="card-body warning-color-dark white-text">
                                                            <!--Title-->
                                                            <h4 class="card-title">Certification Notification</h4>
                                                            <!--Text-->
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <span><i class="fa fa-user-md" style="font-size:60px;color:white"></i></span>
                                                                </div>
                                                                <div class="col-9">
                                                                    <p>Your {{$row->states->label}} {{$row->certtype->label}} is expiring on {{date('m-d-y', strtotime($row->expiration))}}</p>

                                                                    <small>Please contact the human resources department to update this information when your certification is renewed.</small>
                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>
                                                    <!--/.Card-->
                                                    @elseif($expiration > strtotime("+ 60 days") && $expiration < strtotime("+ 90 days"))

                                                    @endif

                                                    @endforeach

                                                </div>
                                                <div class="row">
                                                    <?php $qaackcount = 0  ?>
                                                    @if(count($qaack))
                                                    
                                                        @foreach($qaack as $row)
                                                        <?php $qaackcount++ ?>
                                                        @endforeach
                                                    @endif
                                                    @if($qaackcount > 0)
                                                        <!--Card-->
                                                        <a data-toggle="modal" data-target="#qaModal">
                                                    <div class="card">

                                                        <!--Card content-->
                                                        <div class="card-body danger-color-dark white-text">
                                                            <!--Title-->
                                                            <h4 class="card-title">Quality Assurance Notification</h4>
                                                            <!--Text-->
                                                    
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <span><i class="fa fa-paperclip" style="font-size:60px;color:white"></i></span>
                                                                </div>
                                                                <div class="col-9">
                                                                    <p>You have {{$qaackcount}} qaulity assurance reports that have not been reviewed. Please review your reports to clear from your dashboard.</p>

                                                                    
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    </a>
                                                    @endif
                                                </div>
                                                <div class="row">
                                                   
                                                    @if($percent > 0)
                                                    <?php
                                                    if($percent >= 1 && $percent <= 25)
                                                {
                                                    $qackcardcolor= "success-color-dark";
                                                    
                                                }elseif($percent >= 26 && $percent <= 50)
                                                {
                                                    $qackcardcolor= "primary-color-dark";
                                                    
                                                }if($percent >= 51 && $percent <= 99)
                                                {
                                                    $qackcardcolor= "warning-color-dark";
                                                    
                                                }if($percent >= 100)                                               
                                                {
                                                    $qackcardcolor= "danger-color-dark";
                                                    
                                                }else
                                                {
                                                    $qackcardcolor= "info-color-dark";
                                                }?>
                                                    @endif
                                                    @if($percent >= 1 && $percent <= 25)
                                                        <!--Card-->
                                                        <a data-toggle="modal" data-target="#exampleModalPreview">
                                                    <div class="card w-100">

                                                        <!--Card content-->
                                                        <div class="card-body {{$qackcardcolor}} white-text">
                                                            <!--Title-->
                                                            <h4 class="card-title">Attendance Notification</h4>
                                                            <!--Text-->
                                                    
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <span><i class="fa fa-calendar-times-o" style="font-size:60px;color:white"></i></span>
                                                                </div>
                                                                <div class="col-9">
                                                                    
                                                                    <p>You have accumalted attendance points to review your record click here.</p>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    </a>
                                                    @elseif($percent >= 26 && $percent <= 50)
                                                     <!--Card-->
                                                        <a data-toggle="modal" data-target="#exampleModalPreview">
                                                    <div class="card w-100">

                                                        <!--Card content-->
                                                        <div class="card-body {{$qackcardcolor}} ">
                                                            <!--Title-->
                                                            <h4 class="card-title">Attendance Notification</h4>
                                                            <!--Text-->
                                                    
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <span><i class="fa fa-calendar-times-o" style="font-size:60px"></i></span>
                                                                </div>
                                                                <div class="col-9">
                                                                    
                                                                    <p>You have accumalted attendance points to review your record click here.</p>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    </a>
                                                    @elseif($percent >= 51 && $percent <= 99)
                                                     <!--Card-->
                                                        <a data-toggle="modal" data-target="#exampleModalPreview">
                                                    <div class="card w-100">

                                                        <!--Card content-->
                                                        <div class="card-body {{$qackcardcolor}} white-text">
                                                            <!--Title-->
                                                            <h4 class="card-title">Attendance Notification</h4>
                                                            <!--Text-->
                                                    
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <span><i class="fa fa-calendar-times-o" style="font-size:60px;color:white"></i></span>
                                                                </div>
                                                                <div class="col-9">
                                                                    
                                                                    <p>You have accumalted attendance points to review your record click here.</p>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    </a>
                                                    @elseif($percent >= 100)
                                                     <!--Card-->
                                                        <a data-toggle="modal" data-target="#exampleModalPreview">
                                                    <div class="card w-100">

                                                        <!--Card content-->
                                                        <div class="card-body {{$qackcardcolor}} white-text">
                                                            <!--Title-->
                                                            <h4 class="card-title">Attendance Notification</h4>
                                                            <!--Text-->
                                                    
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <span><i class="fa fa-calendar-times-o" style="font-size:60px;color:white"></i></span>
                                                                </div>
                                                                <div class="col-9">
                                                                    
                                                                    <p>You have accumalted more than 7 attendance points and are now eneligiable for a quarterly bounus to review your record click here. If you feel a point has been added in error please contact the compliance department.</p>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    </a>
                                                    @endif
                                                </div>
                                                
                                                @if($badrunsheet)
                                                    <!--Card-->
                                                    <div class="card">

                                                        <!--Card content-->
                                                        <div class="card-body danger-color-dark white-text">
                                                            <!--Title-->
                                                            <h4 class="card-title">Patient Care Report Notification</h4>
                                                            <!--Text-->
                                                            
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    <span><i class="fa fa-paperclip" style="font-size:60px;color:white"></i></span>
                                                                </div>
                                                                <div class="col-9">
                                                                    <p>You have {{$badrunsheet}} @if($badrunsheet > 1) run sheets that need corrected @else run sheet that needs corrected. @endif</p>

                                                                    <small>If you are in need of assistance or have any questions please contact billing department at 740-351-2636.</small>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!--/.Card-->
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<example-component></example-component>

<!--Attandance Model-->
    <div class="modal fade right" id="exampleModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
  <div class="modal-dialog modal-fluid modal-full-height modal-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalPreviewLabel">Employee Attendance Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!--Card-->
        <div class="card">

            <!--Card content-->
            <div class="card-body elegant-color white-text">
                <!--Title-->
                <h4 class="card-title">Current Quarter Attendance</h4>
                <!--Text-->
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Infraction</th>
                            <th>Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!count($attend))
                        <tr>
                            <td colspan="2">No Attendance Infractions</td>
                        </tr>
                        @else
                        @foreach($attend as $row)
                        <tr>
                            <td>{{date('m-d-Y', strtotime($row->date))}}</td>
                            <td>{{$row->type->label or 'Unknown'}}</td>
                            <td>{{$row->type->points}}</td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="progress md-progress" style="height: 20px">
                    <div class="progress-bar" role="progressbar" style="width: {{$percent}}%; height: 20px" aria-valuenow="1" aria-valuemin="0" aria-valuemax="7"></div>
                </div>
                <small>This progress bar shows a count of your current attendance record for this quarter. When 100% is reached you are ineligibleble for the quarterly bonus. If you feel this information is inaccurate contact compliance as soon as possible. </small>
            </div>

        </div>
        <!--/.Card-->
      </div>
    
    </div>
  </div>
</div>
<!--/.Attendance Model-->

<div class="modal fade right" id="qaModal" tabindex="-1" role="dialog" aria-labelledby="qaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qaModalLabel">Quality Assurance</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(!count($qa))
        @else
        <!--Card-->
        <div class="card">
            <!--Card content-->
            <div class="card-body elegant-color white-text">
                <!--Title-->
                <h4 class="card-title">Recent Quality Assurance</h4>
                <!--Text-->
                <div class="list-group">



                    @foreach($qa as $row)
                    <a href="qaqi/{{$row->id}}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-2 h5">{{date('m-d-Y', strtotime($row->date))}}</h5>
                            <small></small>
                        </div>
                        <p class="mb-2">{!!substr($row->comments, 0, 200)!!}</small>

                        <p class="mb-2">@if(!$row->acknowledged) <span class="badge badge-danger">Please click to review and sign the qa report.</span>@else You have signed and acknowledged this QaQi report. Thank you @endif</small>
                    </a>
                    @endforeach

                </div>
                {{$qa->links("pagination::bootstrap-4")}}
                <small>Items displayed here are from quality assurance reviews completed on your patient care documents. You may click a review to see more detailed information.</small>
            </div>

        </div>
        <!--/.Card-->
        @endif
      </div>
      
    </div>
  </div>
</div>

<div class="modal fade right" id="complianceModal" tabindex="-1" role="dialog" aria-labelledby="complianceModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="complianceLabel">Compliance Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        @if(!count($encounters))
            <h3>No Compliance Issues</h3>
        @else
        <!--Card-->
        <div class="card">

            <!--Card content-->
            <div class="card-body elegant-color white-text">
                <!--Title-->
                <h4 class="card-title">Employee Encounters Needing Action</h4>
                <!--Text-->
                <div class="list-group">
                    @foreach($encounters as $row)
                    <a href="#!" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-2 h5">{{date('m-d-Y', strtotime($row->doi))}}</h5>
                            <small>@if($row->status == 1) Investigation @elseif($row->status == 2)
                                Contact @elseif($row->status == 3) Admin/Training @elseif($row->status == 4)
                                Closed @else Unknown @endif</small>
                        </div>
                        <p class="mb-2">{!!substr($row->incident_report, 0, 200)!!}</small>
                    </a>
                    @endforeach
                </div>
                <small>Items displayed here are from encounters entered into the system that require a response or action by the employee.</small>
            </div>

        </div>
        <!--/.Card-->
        @endif
      </div>
      
    </div>
  </div>
</div>


@stop

@section('scripts')
<script>
    var labels = {!! json_encode(array_keys($activities)) !!}
    ;
            var activities = {!! json_encode(array_values($activities)) !!}
    ;
    var trans = {
        chartLabel: "{{ trans('app.registration_history')  }}",
        action: "{{ trans('app.action_sm')  }}",
        actions: "{{ trans('app.actions_sm')  }}"
    };
</script>
{!! HTML::script('assets/js/chart.min.js') !!}
{!! HTML::script('assets/js/as/dashboard-default.js') !!}
@stop