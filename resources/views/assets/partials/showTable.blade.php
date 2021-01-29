<!-- begin table-responsive -->
				<div class="table-responsive">
					<table id="user" class="table table-striped">
						<tbody>
						    <tr>
						        <td class="bg-dark" width="20%"> Asset Tag / Service Tag </td>
						        <td>{{ $asset->asset_tag }}</td>
						        <td>Company asset ID </td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Serial Number </td>
						        <td>{{ $asset->seirial_number }}</td>
						        <td>Serial number of asset </td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Year Manufactured </td>
						        <td>{{ $asset->year }}</td>
						        <td>Year asset manufactured </td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Make</td>
						        <td>{{ $asset->make }}</td>
						        <td>Manufacture of asset</td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Model</td>
						        <td>{{ $asset->model }}</td>
						        <td>Description of asset</td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Asset Type</td>
						        <td>{{ $asset->deviceType->description }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Asset Location</td>
						        <td>{{ $asset->location->description }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Station Housed</td>
						        <td>{{ $asset->station->station }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Asset Assigned Unit</td>
						        <td>@if($asset->unit){{ $asset->unit->unit_number }} @else Not Assigned to Unit @endif</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Asset Assigned Company</td>
						        <td>{{ $asset->company->name }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Asset Initial Cost</td>
						        <td>$ {{ $asset->cost}}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Decommision Date</td>
						        <td>@if($asset->decomissioned) @else Not Deomissioned at this time. @endif</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Asset Status</td>
						        <td>{{ $asset->assetStatus->description }}</td>
						        <td></td>
						    </tr>
						</tbody>
					</table>
				</div>
				<!-- end table-responsive -->