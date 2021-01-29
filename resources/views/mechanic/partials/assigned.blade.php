<!-- begin card -->
<div class="card border-0 bg-warning text-white mb-3 overflow-hidden">
    <img class="card-img-top" src="/assets/img/assigned.png" height="125px" alt="Card image cap">
    <!-- begin card-body -->
    <div class="card-body">
        <!-- begin row -->
    @foreach($employees as $emp)

        <!-- begin col-12 -->
            <div class="col-xl-12 ">
                <!-- begin card -->
                <div class="card border-0 bg-dark text-white mb-3 overflow-hidden">
                    
                    <!-- begin card-body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xl-4"><h5 class="card-title">{{$emp->first_name}} {{$emp->last_name}}</h5>
                            </div>
                            <div class="col-xl-8 border border-success" draggable="true" dragenter="true"
                                 dragover="true" drop="true" dragleave="true" data-status="2" data-drop="true"
                                 data-user_id="{{$emp->user_id}}">Drag Assignment Here
                            </div>
                        </div>
                        <div class="row" id="{{$emp->user_id}}" style="min-height: 50px;" draggable= true>
                            @foreach($data->where('status', 2)->where('mechanic_assigned', $emp->user_id) as $row)
                                @if($row->status == 1)  <?php $color = 'bg-danger'; $status = 'Pending';?>
                                @elseif($row->status == 2) <?php $color = 'bg-warning'; $status = 'Assigned';?>
                                @elseif($row->status == 3) <?php $color = 'bg-primary'; $status = 'Working';?>
                                @elseif($row->status == 4) <?php $color = 'bg-info'; $status = 'Inspection';?>
                                @elseif($row->status == 5) <?php $color = 'bg-success'; $status = 'Completed';?>
                                @endif
                                <div class="row drag-drop" draggable="true" data-id="{{$row->id}}" data-id="{{$row->id}}">
                                    <!-- begin col-12 -->
                                    <div class="col-xl-12 ">
                                        <!-- begin card -->
                                        <div class="card border-0 bg-dark text-white mb-1 overflow-hidden">
                                            <!-- begin card-body -->
                                            <div class="card-body ">
                                                <!-- begin row -->
                                                <div class="row">
                                                    <div class="col-xl-3">
                                                        {{$row->unit_id}}
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="col-xl-12">
                                                            Assigned
                                                            To: {{$row->mechanic->first_name or 'Pending'}} {{$row->mechanic->last_name or ''}}
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
                                                        
                                                        <div class="col-xl-12"><button type="button" class="btn btn-primary btn-sm btn-block mb-2" data-toggle="modal" data-target="#modalAddNote" data-taskid="{{$row->id}}">Add Notes</button></div>
                                                        <div class="col-xl-12"><button type="button" class="btn btn-warning btn-sm btn-block mb-2" data-toggle="modal" data-target="#removePartsModal" data-used_on="{{$row->id}}">Add Parts Used</button></div>
                                                    
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
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col-12 -->

        @endforeach

    </div>
    <!-- end card-body -->
</div>
<!-- end card -->