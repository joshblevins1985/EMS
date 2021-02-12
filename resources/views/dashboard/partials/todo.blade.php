<div class="col-md-12 col-xl-12 grid-margin stretch-card">
	<div class="card">
		<div class="card-body">
			<h4 class="card-title">To do list</h4>

			<div class="row mb-2">
				<div class="col">
					<span class="badge badge-danger align-top">Overdue</span>
				</div>
				<div class="col">
					<span class="badge badge-warning align-top">Due today</span>
				</div>
				<div class="col">
					<span class="badge badge-light text-dark align-top">Not yet started</span>
				</div>
			</div>
			<div class="add-items d-flex">
				<input type="text" id="task" name="task" class="form-control todo-list-input" placeholder="enter task..">
				<button class="add btn btn-primary todo-list-add-btn">Add</button>
			</div>
			<div class="list-wrapper">
				<ul class="d-flex flex-column-reverse todo-list todo-list-custom">
					@foreach($todos as $todo)
					<li>
						<div class="form-check form-check-primary">
							<label class="form-check-label">
								<input class="checkbox" type="checkbox" data-id="{{$todo->id}}">  </label>
						</div>
						<div>
							@if(is_null($todo->expected_complete)) <span> {!! $todo->task !!} </span> @elseif(date('Y-m-d') > $todo->expected_complete) <span class="text-danger"> {!! $todo->task !!} </span> @elseif(date('Y-m-d') == $todo->expected_complete) <span class="text-warning"> {!! $todo->task !!} </span>  @endif
							<span id="task-status_{{$todo->id}}" >@if($todo->status == 2 ) <span class='text-warning'> <i class='fal fa-snowboarding'></i>< </span> @endif</span>
						</div>

						@if(count($todo->notes))
							<div class="pull-right ml-4">Notes <span class='badge badge-pill badge-primary'> {{count($todo->notes)}} </span></div>

						@endif

						<div class="remove btn-group">
							<i class="fad fa-ellipsis-v" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ></i>

							<div class="dropdown-menu">
								<a class="dropdown-item" id="task-remove" data-id="{{$todo->id}}" ><span class='text-danger'> Remove Task </span> </a>
								<div class="dropdown-divider"></div>
								<a class='dropdown-item' id='task-note' data-toggle="modal" data-target="#newTodoNoteModal" data-tid="{{$todo->id}}" ><span > Add Note </span> </a>
								<div class='dropdown-divider'></div>
								<a class='dropdown-item' id='task-working' data-id="{{$todo->id}}" ><span class="dropdown-item-text"> Mark Working </span> </a>
								<div class='dropdown-divider'></div>

							</div>
						</div>

					</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
</div>