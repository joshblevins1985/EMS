<!-- begin panel -->
<div class="panel panel-inverse" >
    <div class="panel-heading">
        <h2 class="panel-title">Run Sheets That Need Corrected</h2>

    </div>
    <div class="panel-body pr-1">
        <div class="row">
            <div class="col-xl-12">
                <ul class="list-group">
                    @if( in_array(21, explode(',', $employee->additional_postions )))
                        @foreach($RunSheetCorrection as $row)
                            <a data-toggle="collapse" href="#brs{{ $row->user_id }}" role="button" aria-expanded="false" aria-controls="brs{{ $row->user_id }}">
                                <li class="list-group-item" >
                                    <div class="row">
                                        <div class="col-xl-2">{{ $row->last_name }} {{ $row->first_name }}</div>
                                        <div class="col-xl-4">@if(count($row->BadRunSheets->where('status', '<=', 3))){{ count($row->BadRunSheets->where('status', '<=', 3)) }} @endif</div>
                                        <div class="col-xl-2">

                                                <button onclick="window.location.href = '/brs/allBilling/{{$row->user_id}}';" class="badge badge-pill bg-success">
                                                    <span class="badge badge-pill bg-success">All to Billing</span>
                                                </button>

                                        </div>
                                    </div>

                                </li>
                            </a>

                            <div class="collapse" id="brs{{ $row->user_id }}">
                                <div class="card card-body">
                                    <ul class="list-group">
                                        @foreach($row->BadRunSheets->where('status', '<', 5) as $brs)
                                        <li>
                                            <div class="row">
                                                <div class="col-xl-3">
                                                    Added: {{ Carbon\Carbon::parse($brs->created_at)->format('m-d-Y') }}
                                                </div>
                                                <div class="col-xl-3">
                                                    {{ $brs->pcr_number }}
                                                </div>
                                                <div class="col-xl-3">
                                                    @if($brs->status == 1)

                                                        {!! Form::open(['url' => route('badrunsheets.oneclick', $row->id), 'method' => 'POST']) !!}
                                                        @method('PUT')
                                                        @csrf

                                                        {{ Form::hidden('id', $brs->id) }}
                                                        {{ Form::hidden('status', '2') }}

                                                        <button type="submit"  class="badge badge-pill bg-danger"><span class="badge badge-pill bg-danger">Uploaded</span></button>

                                                        {!! Form::close() !!}
                                                    @elseif($brs->status == 2)
                                                        {!! Form::open(['url' => route('badrunsheets.oneclick', $row->id), 'method' => 'POST']) !!}
                                                        @method('PUT')
                                                        @csrf

                                                        {{ Form::hidden('id', $brs->id) }}
                                                        {{ Form::hidden('status', '3') }}

                                                        <button type="submit"  class="badge badge-pill bg-warning"><span class="badge badge-pill bg-warning">Notified</span></button>

                                                        {!! Form::close() !!}
                                                    @elseif($brs->status == 3)
                                                        {!! Form::open(['url' => route('badrunsheets.oneclick', $row->id), 'method' => 'POST']) !!}
                                                        @method('PUT')
                                                        @csrf

                                                        {{ Form::hidden('id', $brs->id) }}
                                                        {{ Form::hidden('status', '4') }}

                                                        <button type="submit"  class="badge badge-pill bg-primary"><span class="badge badge-pill bg-primary">Acknowledged</span></button>

                                                        {!! Form::close() !!}
                                                    @elseif($brs->status == 4)
                                                        {!! Form::open(['url' => route('badrunsheets.oneclick', $row->id), 'method' => 'POST']) !!}
                                                        @method('PUT')
                                                        @csrf

                                                        {{ Form::hidden('id', $brs->id) }}
                                                        {{ Form::hidden('status', '5') }}

                                                        <button type="submit"  class="badge badge-pill bg-primary"><span class="badge badge-pill bg-primary">To Billing</span></button>

                                                        {!! Form::close() !!}
                                                    @elseif($brs->status == 5)
                                                        <span class="badge badge-pill green">Complete</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                            @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </ul>


            </div>
        </div>
    </div>
</div>
<!-- end panel -->
