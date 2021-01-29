<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalDra" tabindex="-1" role="dialog" aria-labelledby="exampleDra"
     aria-hidden="true">
    <?php
            if($trisk == 'Low'){
                $color = 'success';
            }elseif($trisk == 'Medium'){
                $color = 'primary';
            }elseif($trisk == 'High'){
                $color = 'warning';
            }elseif($trisk == 'Very High'){
                $color = 'danger';
            }else{
                $color = 'elegant';
            }
            ?>
    <div class="modal-dialog modal-lg modal-notify modal-{{$color}}" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Employee Drivers Risk Assessment</p>
            </div>

            <!--Body-->
            <div class="modal-body">
                
                <!--Panel-->
                <div class="card ">
                    <div class=" card-header primary-color-dark white-text">
                        Driver Risk Assessment
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="list-group">
                  
                    <a href="#" data-toggle="modal" data-target="#draModal" data-employee3="{{$employees->user_id}}"
                       class="list-group-item list-group-item-action {{$demoline}} flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-2 h5">
                                Demographics
                            </h5>
                            <small>{{$demotot or 'Unknown'}}</small>
                        </div>
                    </a>
                    @if($employees->dra)
                         <ul>
                        <li class="list-group-item">
                          <div class="row">
                              <div class="col-lg-4">
                                  Driver Age
                              </div>
                              <div class="col-lg-4">
                                 {{ date_diff(new \DateTime($employees->dob), new \DateTime())->format("%y Years") }}
                              </div>
                              <div class="col-lg-4">
                                  
                              </div>
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="row">
                              <div class="col-lg-4">
                                  # Years Employeed
                              </div>
                              <div class="col-lg-4">
                                  {{ date_diff(new \DateTime($employees->doh), new \DateTime())->format("%y Years, %m Months") }}
                              </div>
                              <div class="col-lg-4">
                                  
                              </div>
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="row">
                              <div class="col-lg-4">
                                  Drivers Sex
                              </div>
                              <div class="col-lg-4">
                                  @if($employees->dra->sex == 8) Male @elseif($employees->dra->sex == 1) Female @else Unknown @endif
                              </div>
                              <div class="col-lg-4">
                                  
                              </div>
                          </div>
                          </li>
                          <li class="list-group-item">
                          <div class="row">
                              <div class="col-lg-4">
                                  Number Years Licensed
                              </div>
                              <div class="col-lg-4">
                                  @if($employees->dra->date_of_license) {{ date_diff(new \DateTime($employees->dra->date_of_license), new \DateTime())->format("%y Years, %m Months") }} @else @endif
                              </div>
                              <div class="col-lg-4">
                                  
                              </div>
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="row">
                              <div class="col-lg-4">
                                  License Status
                              </div>
                              <div class="col-lg-4">
                                  @if($employees->dra->license_status == 1) Valid @elseif($employees->dra->license_status == 2) Expired @elseif($employees->dra->license_status == 3) Suspended @else Unknown @endif
                              </div>
                              <div class="col-lg-4">
                                  
                              </div>
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="row">
                              <div class="col-lg-4">
                                  Corrective Lenses
                              </div>
                              <div class="col-lg-4">
                                  @if($employees->dra->corrective_lenses == 0) None @elseif($employees->dra->corrective_lenses == 4) Required  @else Unknown @endif
                              </div>
                              <div class="col-lg-4">
                                  
                              </div>
                          </div>
                        </li>

                        <li class="list-group-item">
                          <div class="row">
                              <div class="col-lg-4">
                                  Scheduled Shift
                              </div>
                              <div class="col-lg-4">
                                  {{$employees->dra->shift_hours or 'Unknown'}}
                              </div>
                              <div class="col-lg-4">
                                  
                              </div>
                          </div>
                        </li>
                        <li class="list-group-item">
                          <div class="row">
                              <div class="col-lg-4">
                                  Insurable
                              </div>
                              <div class="col-lg-4">
                                  @if($employees->dra->non_driver == 0) Insurable @elseif($employees->dra->corrective_lenses == 1) Not Insurable  @else Unknown @endif
                              </div>
                              <div class="col-lg-4">
                                  
                              </div>
                          </div>
                        </li>
                    </ul>
                    @endif
                   
                    <a href="#" data-toggle="modal" data-target="#mvrModal" data-employee1="{{$employees->user_id}}"
                       @if($mvr_total >= 30)
                            <?php $line = "list-group-item-danger" ?>
                       @elseif($mvr_total > 20 && $mvr_total <= 29)
                            <?php $line = "list-group-item-warning" ?>
                       @elseif($mvr_total >9 && $mvr_total <= 19)
                            <?php $line = "list-group-item-primary" ?>
                       @elseif($mvr_total >= 0 && $mvr_total <= 8)
                             <?php $line = "list-group-item-success" ?>
                       @endif

                       class="list-group-item list-group-item-action {{$line or ''}} flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-2 h5">
                                Motor Vehicle Report
                            </h5>
                            <small>{{$mvr_total or 'Unknown'}}</small>
                        </div>
                    </a>
                    <ul class="list-group">
                        @foreach($employees->mvrincident as $row)
                      <li class="list-group-item">
                          <div class="row">
                              <div class="col-lg-4">
                                  {{ Carbon\Carbon::parse($row->date)->format('m-d-Y') }}
                              </div>
                              <div class="col-lg-4">
                                 {{$row->mvroffense->offense or 'Unknown'}}
                              </div>
                              <div class="col-lg-4">
                                  <?php
                                   $date1 = strtotime($row->date);
                $date1 = date('Y-m-d', $date1);
                $date1 = new DateTime($date1);
                $date2 = strtotime('now');
                $date2 = date('Y-m-d', $date2);
                $date2 = new DateTime($date2);


                $doiage = date_diff($date1, $date2);
                $doiage = $doiage->m + ($doiage->y * 12);


                if ($row->mvroffense->level == 0) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                } elseif ($doiage >= 0 && $doiage <= 36 && $row->mvroffense->level == 10) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '10';
                } elseif ($doiage >= 37 && $doiage <= 48 && $row->mvroffense->level == 10) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '5';
                } elseif ($doiage >= 49 && $row->mvroffense->level <= 10) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                }elseif ($doiage >= 0 && $doiage <= 36 && $row->mvroffense->level == 15) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '15';
                } elseif ($doiage >= 37 && $doiage <= 48 && $row->mvroffense->level == 15) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '7';
                } elseif ($doiage >= 49 && $row->mvroffense->level <= 15) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                }elseif ($doiage >= 0 && $doiage <= 36 && $row->mvroffense->level == 20) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '20';
                } elseif ($doiage >= 37 && $doiage <= 48 && $row->mvroffense->level == 20) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '10';
                } elseif ($doiage >= 49 && $row->mvroffense->level <= 20) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                }elseif ($doiage >= 0 && $doiage <= 36 && $row->mvroffense->level == 25) {
                    $risk = '<h4> <span class="badge badge-warning">HIGH</span></h4>';
                    $level = '25';
                } elseif ($doiage >= 37 && $doiage <= 48 && $row->mvroffense->level == 25) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '10';
                } elseif ($doiage >= 49 && $row->mvroffense->level <= 25) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                }
                elseif ($doiage >= 0 && $doiage <= 36 && $row->mvroffense->level == 30) {
                    $risk = '<h4> <span class="badge badge-danger">VERY HIGH</span></h4>';
                    $level = '30';
                } elseif ($doiage >= 37 && $doiage <= 48 && $row->mvroffense->level == 30) {
                    $risk = '<h4> <span class="badge badge-primary">MEDIUM</span></h4>';
                    $level = '15';
                } elseif ($doiage >= 49 && $doiage <= 60 && $row->mvroffense->level == 30) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '10';
                } elseif ($doiage >= 61 && $row->mvroffense->level == 30) {
                    $risk = '<h4> <span class="badge badge-success">LOW</span></h4>';
                    $level = '0';
                }
                                  ?>
                                  
                                
                                <div class="col-lg-6">
                                    {!!$risk or ''!!}
                                </div>
                                
                                <div class="col-lg-6">
                                    {{$level or 'Unknown Pts'}}
                                </div>
                                  
                              </div>
                          </div>
                          </li>
                      @endforeach
                    </ul>
                    <a href="#" data-toggle="modal" data-target="#driverModal" data-employee2="{{$employees->user_id}}"
                    @if($dhisttotal >= 30) 
                        <?php $line= "list-group-item-danger" ?>
                    @elseif($dhisttotal >= 20 && $dhisttotal <= 29)
                        <?php $line= "list-group-item-warning" ?>
                    @elseif($dhisttotal > 9 && $dhisttotal <= 19)
                        <?php $line= "list-group-item-primary" ?>
                    @elseif ($dhisttotal >= 0 && $dhisttotal <= 8)
                        <?php $line= "list-group-item-success" ?>
                    @endif
                       class="list-group-item list-group-item-action {{$line}} flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-2 h5">
                                Driver History
                            </h5>
                            <small>{{$dhisttotal or 'Unknown'}}</small>
                        </div>
                    </a>
                    <ul>
                    @foreach($employees->drivingincident as $row)
                      <li class="list-group-item">
                          <div class="row">
                              <div class="col-lg-4">
                                  {{ Carbon\Carbon::parse($row->date)->format('m-d-Y') }}
                              </div>
                              <div class="col-lg-4">
                                  {{$row->type->label or 'Unknown'}}
                              </div>
                              <div class="col-lg-4">
                                  
                              </div>
                          </div>
                          </li>
                      @endforeach
                    </ul>
                    <a href="#"
                       class="list-group-item list-group-item-action {{$totalline}} flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-2 h5">
                                Total Score
                            </h5>
                            <small>{{$drivertotal}}</small>
                        </div>
                    </a>

                </div>

                        </div>

                    </div>
                    <div class="card-footer text-muted primary-color-dark white-text">
                        <p class="mb-0"></p>
                    </div>
                </div>
                <!--/.Panel-->

            </div>
            
            <!--Footer-->
            <div class="card-footer text-muted {{$color}}-color white-text">
            <p class="mb-0">Risk Level : {{$trisk or 'Unknown'}}</p>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalConfirmDelete-->


