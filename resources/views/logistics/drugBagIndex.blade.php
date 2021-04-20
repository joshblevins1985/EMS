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

                            </div>
                            <div class="label">

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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($drugBags as $d)
                    <tr>
                        <td>{{$d->station->station}}</td>
                        <td>{{$d->bag_number ?? ''}}</td>
                        <td>{{$d->currentSealNumber ?? 'Unknown'}}</td>
                        <td>@if($d->bagExpires) {{\Carbon\Carbon::parse($d->bagExpires)->format('m-d-Y')}} @else Unknown @endif</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@stop

@push('css')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endpush

@push('modals')

@endpush


@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready( function () {
        $('#drugBagTable').DataTable();
    } );
</script>

@endpush
