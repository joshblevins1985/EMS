<!-- begin panel -->
			<div class="panel panel-inverse" >
				<div class="panel-heading">
					<h4 class="panel-title">Mechanic Tasks Menu</h4>
				
				</div>
				<div class="panel-body pr-1">
						<!-- begin tabs -->
			<ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile" >
				<li class="nav-item"><a href="#latest-post" data-toggle="tab" class="nav-link active"><i class="fas fa-list-ol fa-lg m-r-5"></i> <span class="d-none d-md-inline">Pending Units</span></a></li>
				<li class="nav-item"><a href="#purchase" data-toggle="tab" class="nav-link"><i class="fad fa-user-hard-hat fa-lg m-r-5"></i> <span class="d-none d-md-inline">Units Assigned to Me</span></a></li>
				<li class="nav-item"><a href="#email" data-toggle="tab" class="nav-link"><i class="fad fa-check-double fa-lg m-r-5"></i> <span class="d-none d-md-inline">Units Completed by Me</span></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane fade active show" id="latest-post">
					<div class="height-sm" data-scrollbar="true">
						<ul class="media-list media-list-with-divider">
						    <?php
						        $tasks = Vanguard\MechanicTask::where('status', 1)->groupBy('unit_id')->get();
						    ?>
						    @if(count($tasks))
						    @foreach($tasks as $row)
						    <li class="media media-lg">
								<a href="javascript:;" class="pull-left">
									<i class="far fa-ambulance fa-5x text-danger"></i>
								</a>
								<div class="media-body">
									<h5 class="media-heading">Unit # {{$row->unit_id}} -- </h5>
									<div class="row">
									    <div class="col-xl-8 col-md-12">
									        <?php 
									        $problems = Vanguard\MechanicTask::where('status', 1)->where('unit_id', $row->unit_id)->get();
									        ?>
									        @foreach($problems as $pro_row)
									        <ol class="fa-ul">
									            <li><span class="fa-li"><i class="fas fa-spinner"></i></span> 
									            <div class="col-xl-12">
									            {{$pro_row->task_label->label}} -- {{$pro_row->comments or 'No Comment Listed'}}
									        </div>
									            </li>
									        </ol>
									        
									        @endforeach
									        </div>
									    <div class="col-xl-4 col-md-12">
									        <form action="/garage/assignMe" method="POST">
									            @csrf
									            <input type="hidden" name="unit_id" value="{{$row->unit_id}}" />
									            <button type="submit" class="btn btn-success btn-lg btn-block btn-sm mb-2">Assign To Me</button>
									        </form>
									        
									        <button type="button" class="btn btn-primary btn-lg btn-block btn-sm mb-2">Add Note</button>
									    </div>
									</div>
								</div>
							</li>
						    @endforeach
						    @else
						    
						    @endif
							
							
						</ul>
					</div>
				</div>
				<div class="tab-pane fade" id="purchase">
		               
						<ul class="media-list media-list-with-divider">
						    <?php
						        $tasks = Vanguard\MechanicTask::where('status', 2)->where('mechanic_assigned', Auth::user()->id)->groupBy('unit_id')->get();
						    ?>
						    @if(count($tasks))
						    @foreach($tasks as $row)
						    <li class="media media-lg">
								<a href="javascript:;" class="pull-left">
									<i class="far fa-ambulance fa-5x text-danger"></i>
								</a>
								<div class="media-body">
									<h5 class="media-heading">Unit # {{$row->unit_id}} -- </h5>
									<div class="row">
									    <div class="col-xl-8 col-md-12">
									        <?php 
									        $problems = Vanguard\MechanicTask::where('status', 2)->where('mechanic_assigned', Auth::user()->id)->where('unit_id', $row->unit_id)->get();
									        ?>
									        @foreach($problems as $pro_row)
									        <div class="col-xl-12">
									            {{$pro_row->task_label->label}}
									        </div>
									        @endforeach
									        </div>
									    <div class="col-xl-4 col-md-12">
									        <form action="#" method="POST">
									            @csrf
									            <input type="hidden" name="unit_id" value="{{$row->unit_id}}" />
									            <button type="submit" class="btn btn-success btn-lg btn-block btn-sm mb-2">Complete These Tasks</button>
									        </form>
									        
									        <button type="button" class="btn btn-primary btn-lg btn-block btn-sm mb-2">Add Note</button>
									    </div>
									</div>
								</div>
							</li>
						    @endforeach
						    @else
						    
						    @endif
							
							
						</ul>
					
				</div>
				<div class="tab-pane fade" id="email">
					
						This can be seen
				
				</div>
			</div>
			<!-- end tabs -->
				</div>
			</div>
			<!-- end panel -->
	