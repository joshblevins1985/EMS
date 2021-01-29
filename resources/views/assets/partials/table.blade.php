<table id="data-table-default" class="table table-striped  table-td-valign-middle">
				<thead>
					<tr>
						<th >Service Tag</th>
						<th >Asset Type</th>
						<th >Station</th>
						<th >Unit</th>
						<th >Company</th>
						<th >Status</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
				    @foreach($assets as $asset)
					<tr class="odd gradeX">
						<td>{{ $asset->asset_tag }}</td>
						<td>{{ $asset->deviceType->description }}</td>
						<td>{{ $asset->station->station }}</td>
						<td>@if($asset->unit) {{ $asset->unit->unit_number }} @else No Unit Assigned @endif</td>
						<td>{{ $asset->company->name ?? '' }}</td>
						<td>{{ $asset->assetStatus->description }}</td>
						<td>
						    <a href="/asset/{{ $asset->id }}"><i class="fas fa-edit"></i></a>
						</td>
					</tr>
					@endforeach

				</tbody>
			</table>
