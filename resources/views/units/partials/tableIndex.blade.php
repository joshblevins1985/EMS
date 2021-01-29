<table id="data-table-default" class="table table-striped  table-td-valign-middle">
				<thead>
					<tr>
					    <th></th>
						<th>Unit Number</th>
						<th>Primary Station</th>
						<th>VIN # </th>
						<th>Make</th>
						<th>Model</th>
						<th>ODPS #</th>
						<th>KBEMS #</th>
						<th>WVOEMS #</th>
						<th>Has Tracker</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
				    @foreach($units as $unit)
					<tr class="odd gradeX" data-toggle="collapse" data-target="#unit{{$unit->id}}" >
					    <td>
					    @if($unit->status)
					    <a data-toggle="modal" data-unit_id="{{ $unit->id }}" data-target="#unitInfoModal"><i class="far fa-question-square fa-2x" ></i></a>
					    @if($unit->odometer_date <= Carbon\Carbon::now()->subDays(15)) <span class="text-danger"><i class="far fa-tachometer-alt-slow" data-toggle="tooltip" data-placement="top" title="Units miles have not been updated within the last 15 days."></i></span> @endif
					    @endif
					    </td>
						<td>{{ $unit->unit_number }}</td>
						<td>{{ $unit->location->station }}</td>
						<td>{{ $unit->vin }}</td>
						<td>{{ $unit->make }}</td>
						<td>{{ $unit->model }}</td>
						<td>@if($unit->odps_number) {{ $unit->odps_number }} @else <span class"text-danger"> <i class="fas fa-times-circle fa-2x"></i> </span> @endif</td>
		                <td>@if($unit->ky_number) {{ $unit->ky_number }} @else <span class"text-danger"> <i class="fas fa-times-circle fa-2x"></i> </span> @endif</td>
						<td>@if($unit->wv_number) {{ $unit->wv_number }} @else <span class"text-danger"> <i class="fas fa-times-circle fa-2x"></i> </span> @endif</td>
						<td>@if($unit->fleet_complete_id) <span class="text-success"> <i class="fas fa-check fa-2x"></i> </span> @else <span class="text-danger"> <i class="fas fa-times-octagon fa-2x"></i> </span>  @endif</td>
						<td> @if($unit->status == 1) In Service @elseif($unit->status == 0) Out of Service @endif  </td>
						<td>
						    <div class="row">
						        <div class="col">
						            <a href="units/{{$unit->id}}" ><span class="text-primary"><i class="fas fa-ellipsis-h fa-2x"></i></span> </a>
						        </div>
						        <div class="col">
						            <span class="text-warning"><i class="fad fa-edit fa-2x"></i></span>
						        </div>
						        <div class="col">
						            <span class="text-danger"><i class="far fa-window-close fa-2x"></i></span>
						        </div>
						        
						    </div>
						</td>
					
					</tr>
					
					
					@endforeach

				</tbody>
			</table>