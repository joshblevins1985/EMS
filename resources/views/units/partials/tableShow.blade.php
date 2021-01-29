<!-- begin table-responsive -->
				<div class="table-responsive">
					<table id="user" class="table table-striped">
						<tbody>
						    <tr>
						        <td class="bg-dark" width="30%"> Vehicle Type </td>
						        <td>@if($unit->type == 1) <span class="text-danger"><i class="fad fa-ambulance fa-3x"></i></span>  @elseif($unit->type == 2) <span class="text-warning"><i class="fad fa-ambulance fa-3x"></i></span> @elseif($unit->type == 3) <span class="text-primary"><i class="fad fa-ambulance fa-3x"></i></span> @elseif($unit->type == 4) <span class="text-success"><i class="fad fa-ambulance fa-3x"></i></span> @elseif($unit->type == 5) <span class="text-light"><i class="fad fa-shuttle-van fa-3x"></i></span> @endif</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Unit Number </td>
						        <td>{{ $unit->unit_number }}</td>
						        <td>Company unit ID </td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Primary Station </td>
						        <td>{{ $unit->location->station }}</td>
						        <td> </td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Current Status </td>
						        <td>@if($unit->status == 0) Out of Service @elseif($unit->status == 1) In-Service @endif </td>
						        <td> </td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> VIN # </td>
						        <td>{{ $unit->vin }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Year </td>
						        <td>{{ $unit->year }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Manufacturer </td>
						        <td>{{ $unit->manufacturer }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Make </td>
						        <td>{{ $unit->make }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Model </td>
						        <td>{{ $unit->model }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> License Plate Number </td>
						        <td>{{ $unit->license_plate }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> License Plate Expiration </td>
						        <td 
						        @if (Carbon\Carbon::now()->addDays(14) > $unit->tag_expiraton)
						        class="bg-danger text-dark"
						        @elseif ($unit->tag_expiraton >= Carbon\Carbon::now()->addDays(15)  && $unit->tag_expiraton <= Carbon\Carbon::now()->addDays(30) )
						        class="bg-warning text-dark"
						        @elseif ($unit->tag_expiraton >= Carbon\Carbon::now()->addDays(31))
                                class="bg-success text-dark"
						        @endif
						        >
						        {{ Carbon\Carbon::parse($unit->tag_expiraton)->format('m/d/Y') }}
						        </td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%">Fleet Complete Id</td>
						        <td>{{ $unit->fleet_complete_id }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Company Licensed With </td>
						        <td>{{ $unit->company_id }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> ODPS Number</td>
						        <td>{{ $unit->odps_number }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> ODPS Expiration </td>
						        <td
						        @if (Carbon\Carbon::now()->addDays(14) > $unit->odps_expiration)
						        class="bg-danger text-dark"
						        @elseif ($unit->odps_expiration >= Carbon\Carbon::now()->addDays(15)  && $unit->odps_expiration <= Carbon\Carbon::now()->addDays(30) )
						        class="bg-warning text-dark"
						        @elseif ($unit->odps_expiration >= Carbon\Carbon::now()->addDays(31))
                                class="bg-success text-dark"
						        @endif
						        
						        >{{ Carbon\Carbon::parse($unit->odps_expiration)->format('m/d/Y') }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Kentucky Number </td>
						        <td>{{ $unit->ky_number }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Kentucky Expiration </td>
						        <td
						        @if (Carbon\Carbon::now()->addDays(14) > $unit->ky_expiration)
						        class="bg-danger text-dark"
						        @elseif ($unit->ky_expiration >= Carbon\Carbon::now()->addDays(15)  && $unit->ky_expiration <= Carbon\Carbon::now()->addDays(30) )
						        class="bg-warning text-dark"
						        @elseif ($unit->ky_expiration >= Carbon\Carbon::now()->addDays(31))
                                class="bg-success text-dark"
						        @endif
						        >{{ Carbon\Carbon::parse($unit->ky_expiration)->format('m/d/Y') }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> West Virgina Number </td>
						        <td>{{ $unit->wv_number }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> West Virgina Expiration </td>
						        <td
						        @if (Carbon\Carbon::now()->addDays(14) > $unit->wv_expiration)
						        class="bg-danger text-dark"
						        @elseif ($unit->wv_expiration >= Carbon\Carbon::now()->addDays(15)  && $unit->wv_expiration <= Carbon\Carbon::now()->addDays(30) )
						        class="bg-warning text-dark"
						        @elseif ($unit->wv_expiration >= Carbon\Carbon::now()->addDays(31))
                                class="bg-success text-dark"
						        @endif
						        >{{ Carbon\Carbon::parse($unit->wv_expiration)->format('m/d/Y') }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Fuel Card Number </td>
						        <td>{{ $unit->fuel_card_number }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Fuel Card Expiration </td>
						        <td
						        @if (Carbon\Carbon::now()->addDays(14) > $unit->fuel_card_expiration)
						        class="bg-danger text-dark"
						        @elseif ($unit->fuel_card_expiration >= Carbon\Carbon::now()->addDays(15)  && $unit->fuel_card_expiration <= Carbon\Carbon::now()->addDays(30) )
						        class="bg-warning text-dark"
						        @elseif ($unit->fuel_card_expiration >= Carbon\Carbon::now()->addDays(31))
                                class="bg-success text-dark"
						        @endif
						        >{{ Carbon\Carbon::parse($unit->fuel_card_expiration)->format('m/d/Y') }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Insurance Added </td>
						        <td>{{ Carbon\Carbon::parse($unit->insurance_added)->format('m/d/Y') }}</td>
						        <td></td>
						    </tr>
						    <tr>
						        <td class="bg-dark" width="20%"> Insurance Expiration </td>
						        <td
						        @if (Carbon\Carbon::now()->addDays(14) > $unit->insurance_expiration)
						        class="bg-danger text-dark"
						        @elseif ($unit->insurance_expiration >= Carbon\Carbon::now()->addDays(15)  && $unit->insurance_expiration <= Carbon\Carbon::now()->addDays(30) )
						        class="bg-warning text-dark"
						        @elseif ($unit->insurance_expiration >= Carbon\Carbon::now()->addDays(31))
                                class="bg-success text-dark"
						        @endif
						        >{{ Carbon\Carbon::parse($unit->insurance_expiration)->format('m/d/Y') }}</td>
						        <td></td>
							</tr>
							<tr>
						        <td class="bg-dark" width="20%"> Service Tickets </td>
						        <td> Count of service tickets </td>
						        <td></td>
							</tr>
							<tr>
						        <td class="bg-dark" width="20%"> Safety Reports </td>
						        <td> Count of safety reports </td>
						        <td></td>
							</tr>
							<tr>
						        <td class="bg-dark" width="20%"> Assigned Equipment </td>
						        <td> Count of items assigned to unit </td>
						        <td></td>
						    </tr>
						</tbody>
					</table>
				</div>
				<!-- end table-responsive -->