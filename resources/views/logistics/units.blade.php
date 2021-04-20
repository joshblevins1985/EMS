@extends('layouts.coreui')

@section('page-title', __('Unit Screen'))
@section('page-heading', __('Unit Screen'))


@section('content')
    @include('partials.messages')

    <div class="row">


                <?php
                $station = explode(',', auth()->user()->defaultStationView);
                $level = explode(',', auth()->user()->defaultLevelView)
                //dd(array(auth()->user()->defaultStationView))
                ?>
                <div class="col-xl-5">
                    <label>Stations Viewing (Default All Stations)</label>
                    <select class="form-control select2" id="stations" multiple searchable="Search here..">
                        @foreach($stations as $row)
                            @if(in_array($row->id, $station))
                                <option selected value="{{$row->id}}"> {{$row->description}} </option> @else
                                <option value="{{$row->id}}"> {{$row->description}} </option>  @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-5">
                    <label>Levels Viewing (Default All Levels)</label>
                    <select class="form-control select2" id="levels" multiple searchable="Search here..">

                        @foreach($levels as $row)
                            @if(in_array($row->id, $level))
                                <option selected value="{{$row->id}}"> {{$row->description}} </option> @else
                                <option value="{{$row->id}}"> {{$row->description}} </option>  @endif
                        @endforeach
                    </select>
                </div>
                    <div class="col-xl-2 text-center">
                        <a data-toggle="modal" data-target="#unitModal"><i class="fad fa-plus-circle fa-3x" ></i></a>

                    </div>


    </div>

    <div class="element-wrapper">
        <div class="element-header">
            Company Units
        </div>
    </div>

    <div class="row">

        <div class="col-xl-12">
            <div class="table-responsive">
                <table id="unitsTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th>Station</th>
                        <th>Unit ID</th>
                        <th>VIN</th>
                        <th>Mileage</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>License Plate</th>
                        <th>Expiration</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($units as $u)
                        <tr>
                            <td>{{$u->station->description ?? ''}}</td>
                            <td>{{$u->unitNumber ?? ''}}</td>
                            <td>{{$u->vin ?? ''}}</td>
                            <td>{{$u->odometer ?? ''}}</td>
                            <td>{{$u->make ?? ''}}</td>
                            <td>{{$u->model ?? ''}}</td>
                            <td>{{$u->year ?? ''}}</td>
                            <td>{{$u->licensePlate ?? ''}}</td>
                            <td>{{$u->licensePlateExpiration ?? ''}}</td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <i class="fad fa-eye text-primary fa-2x"></i>
                                    </div>
                                    <div class="col">
                                        <i class="fad fa-file-edit text-info fa-2x"></i>
                                    </div>
                                    <div class="col">
                                        <i class="fad fa-folder-times text-danger fa-2x" ></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    </div>

    @include('logistics.modals.unitModal')
@stop

@push('css')

@endpush

@push('modals')

@endpush


@push('scripts')
    <script>

        $(document).ready(function () {
            $('#unitsTable').DataTable({
                buttons: ['copy', 'excel', 'pdf'],
            });
        });

        // Material Select Initialization
        $(document).ready(function () {
            $('.select2').select2();
        });

        $('.datetime').datetimepicker({
            inline: false,
        });

    </script>

@endpush
