@extends('layouts.clean')

@section('page-title', __('Drug Bag Management'))
@section('page-heading', __('Drug Bag Management'))


@section('content')
    @include('partials.messages')

    <div class="row">
        <div class="col-sm-12 "  >
            <div class="tablos">
                <div class="row mb-xl-2 mb-xxl-3">
                    <div class="col-sm-12 col-xl-3">
                        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="/drugBagsPdf">
                            <div class="value">
                                {{count($drugBags)}}
                            </div>
                            <div class="label">
                                Total Drug Bags
                            </div>

                        </a>
                    </div>

                    <div class="col-sm-12 col-xl-3">
                        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="apps_support_index.html">
                            <div class="value">
                                {{$expiredDrugsCount}}
                            </div>
                            <div class="label">
                                Expiring Drugs
                            </div>

                        </a>
                    </div>

                    <div class="col-sm-12 col-xl-3">
                        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="/missingDrugBagInspections">
                            <div class="value">
                                {{count($inspections)}}
                            </div>
                            <div class="label">
                                Missing Inspections
                            </div>

                        </a>
                    </div>

                    <div class="col-sm-12 col-xl-3">
                        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="apps_support_index.html">
                            <div class="value">
                                {{count($drugBags->where('status', 2))}}
                            </div>
                            <div class="label">
                                Bags Out
                            </div>

                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="table-responsive">
            <div class="col-xl-12">
                <table class="table table-striped" id="drugBagTable">
                    <thead>
                    <tr>
                        <th>Station</th>
                        <th>Bag ID</th>
                        <th>Seal Number</th>
                        <th>Bag Expires</th>
                        <th>Employee</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($drugBags as $d)
                        <tr>
                            <td>{{$d->station->description}}</td>
                            <td>{{$d->description ?? ''}}</td>
                            <td>{{$d->currentSealNumber ?? 'Unknown'}}</td>
                            <td>@if($d->bagExpires) {{\Carbon\Carbon::parse($d->bagExpires)->format('m-d-Y')}} @else Unknown @endif</td>
                            <td>{{$d->lastAssigned->employee->first_name ?? 'Never Assigned'}} {{$d->lastAssigned->employee->last_name ?? ''}}</td>
                            <td>@if($d->status == 1) In @elseif($d->status == 2) Out @else Unknown @endif </td>
                            <td><div class="row">@if($d->inspection) <div class="col"> <a href="/drugbaginspectionPdf/{{$d->inspection->id}}"><i class="fad fa-file-pdf"></i></a> </div> @endif</div></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@push('css')

@endpush

@push('modals')

@endpush


@push('scripts')
    <script>
        $(document).ready( function () {
            $('#drugBagTable').DataTable();
        } );
    </script>

@endpush
