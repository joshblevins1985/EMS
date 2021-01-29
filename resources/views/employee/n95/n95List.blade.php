@extends('layouts.sidebar-fixed')

@section('page-title', 'N95 Fit Test')
@section('page-heading', 'N95 Fit Test')
@push('css')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #printarea, #printarea * {
                visibility: visible;
                font-size: 14pt;
                color: black;
            }
            #printarea {
                position: absolute;
                left: 0;
            }
        }

        table tr.page-break{
            page-break-after:always

        }

        /* class works for table */
        table.page-break{
            page-break-after:always;
            width: 100%;
        }
    </style>
@endpush

@section('content')

    @include('partials.toastr')
<div id="printarea">
    <div class="row text-center border-bottom">
        <div class="col-xl-12 text-center">
            <h1 class="text-center">N95 FIT/SUPERVISED SEAL CHECKS COMPLETED </h1>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <table class="table table-striped page-break">
                <thead>
                <tr>
                    <th>Employee</th>
                    <th>Station</th>
                    <th>Fit Date</th>
                    <th>Tester</th>
                    <th>Test Type</th>
                    <th>Mask</th>
                    <th>Type</th>
                    <th>Limitations</th>

                </tr>
                </thead>

                <tbody>
                @foreach($fit_tests as $ft)
                    <tr class="page-break">
                        <td>{{$ft->employee->last_name ?? ''}}
                            <p>{{$ft->employee->first_name ?? ''}}</p> </td>
                        <td>{{substr($ft->employee->station->station, 0, 4)}} </td>
                        <td>{{Carbon\Carbon::parse($ft->created_at)->format('m-d-Y')}}</td>
                        <td>{{substr($ft->test->first_name, 0, 1)}}.{{$ft->test->last_name ?? ''}}</td>
                        <td>
                            @if($ft->test_type == 1)
                                Seal Check
                            @elseif($ft->test_type == 2)
                                Quantitative
                            @elseif($ft->test_type == 3)
                                Qualitative
                            @endif

                        </td>
                        <td>{{$ft->mask->brand}}
                        <p>{{$ft->mask->niosh_number}}</p>
                        </td>
                        <td>{{$ft->mask->type}}</td>
                        <td>@if($ft->dentures) Dentures @endif @if($ft->facial_hair) Facial Hair @endif @if($ft->physical_exam) Physical @endif @if($ft->glasses) Glasses @endif @if($ft->limitatiions_other) Other @endif </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@stop

@push('scripts')

@endpush