<!-- begin card -->
        <div class="card border-0 bg-danger text-white mb-3 overflow-hidden">
            
            <!-- Card image -->
            <img class="card-img-top" src="/assets/img/pending.jpg" height="100px" alt="Card image cap" draggable= true dragenter="true" dragover="true" drop="true" dragleave="true" data-status="1" data-drop="true" data-user_id="">
            <!-- begin card-body -->
            <div class="card-body container" id="status_1" >
                <!-- begin row -->
                
                    @foreach($data->where('status', 1) as $row)
                    @if($row->status == 1)  <?php $color = 'bg-danger'; $status= 'Pending';?>
                    @elseif($row->status == 2) <?php $color = 'bg-warning'; $status= 'Assigned';?>
                    @elseif($row->status == 3) <?php $color = 'bg-primary'; $status= 'Working';?>
                    @elseif($row->status == 4) <?php $color = 'bg-info'; $status= 'Inspection';?>  
                    @elseif($row->status == 5) <?php $color = 'bg-success'; $status= 'Completed';?>  
                    @endif
                    <div class="row" draggable="true"  data-id="{{$row->id}}" >
                    <!-- begin col-12 -->
                    <div class="col-xl-12 "  >
                        <!-- begin card -->
                        <div class="card border-0 bg-dark text-white mb-3 overflow-hidden">
                            <!-- begin card-body -->
                            <div class="card-body">
                                <!-- begin row -->
                                <div class="row">
                                    <div class="col-xl-3">
                                        {{$row->unit_id}}
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="col-xl-12">
                                            Assigned To: {{$row->mechanic->first_name or 'Pending'}} {{$row->mechanic->last_name or ''}}
                                        </div>
                                        <div class="col-xl-12">
                                            Task: {{$row->task_label->label}}
                                        </div>
                                    </div>
                                    <div class="col-xl-3">
                                        <div class="col-xl-12">
                                            @if($row->anticipated_start_date === NULL) {{$status}} @else{{date('m-d-Y', strtotime($row->anticipated_start_date))}} @endif
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        Comments: {{$row->comments}}
                                    </div>
                                    <div class="col-xl-4 col-sm-4"><a href="mechanic/{{$row->id}}/edit"> <i class="fad fa-edit"></i> Edit</a></div>
                                    <div class="col-xl-4 col-sm-4"><a href="mechanic/{{$row->id}}/edit"> <i class="fad fa-trash"></i> View</a></div>
                                    <div class="col-xl-4 col-sm-4"><a href="mechanics/{{$row->id}}/delete"> <i class="fad fa-eye"></i> Delete</a></div>
                                    
                                </div>
                                <!-- end row -->
                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col-12 -->
                </div>
                <!-- end row -->
                    @endforeach
                
            </div>
            <!-- end card-body -->
        </div>
        <!-- end card -->