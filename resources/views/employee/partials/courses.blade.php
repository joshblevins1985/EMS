<!--Modal: modalConfirmDelete-->
<div class="modal fade" id="modalContinuingEducation" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg modal-notify modal-warning" role="document">
        <!--Content-->
        <div class="modal-content text-center">
            <!--Header-->
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Continuing Education File</p>
            </div>

            <!--Body-->
            <div class="modal-body">

                <!--Panel-->
                <div class="card ">
                    <div class=" card-header primary-color-dark white-text">
                        Continuing Education
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <div class="list-group">
                                @foreach($employees->enrolledcourses as $row)
                                <?php
                                if($row->status == 1){
                                     $cert = '/certificate/'.$row->instructed->id.'/'.$employees->user_id; 
                                    $lcolor= "list-group-item-success";
                                    $completed = 'Completed'.date('m/d/Y', strtotime($row->completed));
                                    $complete = '';
                                }else{
                                    $cert = '#';
                                    $lcolor= "list-group-item-danger";
                                    $completed="";
                                    $complete = '<a data-toggle="modal" data-toggle="modal" data-target="#completeCourse" data-userid="'.$row->user_id.'" data-classid= "'.$row->class_id.'"  title="Add this item" class="open-courseComplete" href="#"><span class="badge badge-info" >Complete Manually  </span></a>';
                                }


                                ?>
                                <a href="{{$cert or ''}}"
                                   class="list-group-item list-group-item-action {{$lcolor}} flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
           
                                            <h5 class="mb-2 h5">
                                            {{$row->instructed->course->title or 'Unknown' }}
                                            </h5>
                                            <small>Started: {{date('m/d/Y H:i', strtotime($row->created_at))}}</small>
    
                                            <small>{{$completed}}</small>
                                        
                                            <h5><?php echo $complete ?></h5>
                                        
                                        
                                    </div>


                                </a>
                                @endforeach
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
            <div class="modal-footer flex-center">

                <a type="button" class="btn  btn-danger waves-effect" data-dismiss="modal">Close Modal</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!--Modal: modalConfirmDelete-->