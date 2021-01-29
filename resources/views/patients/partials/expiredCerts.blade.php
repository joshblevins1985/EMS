@foreach($certs as $row)
<div class="row mb-1">
    <div class="widget bg-black">
        <div class="row">
            <div class="col-xl-12">Patient: {{ decrypt($row->patient->first_name) }} {{ decrypt($row->patient->last_name) }}</div>
            <div class="col-xl-6">Start Date:</div><div class="col-xl-6">End Date: </div>
            <div class="col-xl-6">{{ Carbon\Carbon::parse($row->start_date)->format('m-d-y') }}</div><div class="col-xl-6">{{ Carbon\Carbon::parse($row->end_date)->format('m-d-y') }}</div>
            <div class="col-xl-12">{{ $row->procedure->description ?? '' }}</div>
        </div>
    </div>
</div>
@endforeach
