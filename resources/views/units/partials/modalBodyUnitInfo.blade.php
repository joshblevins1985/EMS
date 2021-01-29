<div class="row">
    <div class="col-xl-6">
        <div class="col-xl-12">
            <table class="table table">
                <tr>
                    <th>Unit Number</th>
                    <td>{{ $unit->unit_number }}</td>
                </tr>
                <tr>
                    <th>VIN Number</th>
                    <td>{{ $unit->vin }}</td>
                </tr>
                <tr>
                    <th>Year</th>
                    <td>{{ $unit->year }}</td>
                </tr>
                <tr>
                    <th>Make</th>
                    <td>{{ $unit->make }}</td>
                </tr>
                <tr>
                    <th>Model</th>
                    <td>{{ $unit->model }}</td>
                </tr>
                <tr>
                    <th>Manufacture</th>
                    <td>{{ $unit->manufacturer }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="col-xl-12">
            <table class="table table">
                <tr>
                    <th>Current GPS Mileage</th>
                    <td>{{ $asset['odometer'] }}</td>
                </tr>
                <tr>
                    <th>Last Reported Mileage</th>
                    <td id="last_reported_mileage">
                        <a href="#" data-toggle="modal" data-unit_id="{{ $unit->id }}" data-target="#unitMilesUpdateModal">{{ $unit->odometer }}</a> 
                    <p>{{ Carbon\Carbon::parse($unit->odometer_date)->format('m-d-Y') }}</p>
                    </td>
                </tr>
                <tr>
                    <th>Next Service Mileage</th>
                    <td>{{ $unit->service }}</td>
                </tr>
                <tr>
                    <th>Last Service Date</th>
                    <td>Uknown</td>
                </tr>
                <tr>
                    <th>Last Crew Assigned</th>
                    <td>Uknown</td>
                </tr>
                <tr>
                    <th>Last Daily Inspection</th>
                    <td>Uknown</td>
                </tr>
            </table>
        </div>
    </div>
</div>