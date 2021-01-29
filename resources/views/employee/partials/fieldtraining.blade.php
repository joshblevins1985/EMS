<!-- Card -->
<div class="card card-cascade">

    <!-- Card image -->
    <div class="view view-cascade gradient-card-header aqua-gradient">

        <!-- Title -->
        <h2 class="card-header-title mb-3">Orientation</h2>


    </div>

    <!-- Card content -->
    <div class="card-body card-body-cascade text-center">
        <div class="row">
            <div class="col-lg-12">
                <button type="button" data-toggle="modal" data-target="#modalOrientationDates" class="btn blue-gradient btn-sm">Update Orientation</button>
            </div>
            <div class="col-lg-12">
                <button type="button" data-toggle="modal" data-target="#modalFieldDates" class="btn aqua-gradient btn-sm">Add FT Date</button>
            </div>
        </div>
        <!-- Text -->
        <div class="row">
            <div class="col-lg-6">
                Orientation Start:
            </div>
            <div class="col-lg-6">
                Orientation End:
            </div>
            <div class="col-lg-6">
                @if($employees->orientation_start_date) {{ Carbon\Carbon::parse($employees->orientation_start_date)->format('m/d/Y') }}  @endif
            </div>
            <div class="col-lg-6">
                @if($employees->orientation_end_date) {{ Carbon\Carbon::parse($employees->orientation_end_date)->format('m/d/Y') }}  @endif
            </div>
            <div class="col-lg-6">
                Field Start:
            </div>
            <div class="col-lg-6">
                Field end:
            </div>
            <div class="col-lg-6">
                @if($employees->fto_start_date) {{ Carbon\Carbon::parse($employees->fto_start_date)->format('m/d/Y') }}  @endif
            </div>
            <div class="col-lg-6">
                @if($employees->fto_end_date) {{ Carbon\Carbon::parse($employees->fto_end_date)->format('m/d/Y') }}  @endif
            </div>
            <div class="col-lg-6">
                Orientation Status:
            </div>
            <div class="col-lg-6">
                Orientation Status:
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>FTO</th>
                    </tr>
                </thead>
                <tbody>
                    @if($employees->fieldtraining)
                    @foreach($employees->fieldtraining as $row)
                    <tr>
                        <td>{{ Carbon\Carbon::parse($row->date)->format('m/d/Y') }} </td>
                        <td>{{$row->fto->first_name or 'Unknown'}} {{$row->fto->last_name or ''}}</td>
                    </tr>
                    <tr>
                        <td colspan="2">@if($row->type == 1) Field Orientation @elseif($row->type == 2) Drivers Orientation @endif</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

</div>