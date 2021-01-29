@extends('layouts.default')

@section('title', 'Administration Dashboard')
{!! $map['js'] !!}
@push('css')
<link href="/assets/plugins/bootstrap3-wysihtml5-bower/dist/bootstrap3-wysihtml5.min.css" rel="stylesheet" />
<link href="/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

@endpush

@section('content')

@include('partials.messages')

    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Unit Managment</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Unit Information</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">{{ $unit->unit_number }} Infomation </h1>
    <!-- end page-header -->


    <div class="row">
        <div class="col-xl-8">
            <div class="row mb-2">
                <div class="col-xl-2 float-right">
                    <button type="button"  class="btn btn-outline-light" data-toggle="modal" data-target="#myModal">Edit <i class="far fa-edit"></i></button>
                </div>

            </div>
            <div class="row">
                @include('units.partials.tableShow')
            </div>

        </div>
        <div class="col-xl-4">
            <div class="col-xl-12">
                <div class = "panel panel-default">
                       <div class = "panel-heading bg-dark">
                          Vehicle Dynamic Information
                       </div>

                       <div class = "panel-body">
                          <table class="table table-striped">
                              <tbody>
                                  <tr>
                                      <td class="bg-dark">
                                          Engine Status
                                      </td>
                                      <td>Turned Off</td>
                                  </tr>
                                  <tr>
                                      <td class="bg-dark">
                                          Emergency Lights
                                      </td>
                                      <td>Not Active</td>
                                  </tr>
                                  <tr>
                                      <td class="bg-dark">
                                          Last Speed
                                      </td>
                                      <td>@if($asset) @if($asset['speed'] <= $asset['speed_limit'])  @elseif($asset['speed'] <= $asset['speed_limit']) <span class="text-danger"><i class="fas fa-traffic-light-stop"></i></span>  @endif {{ $asset['speed'] }} @endif mph</td>
                                  </tr>
                                  <tr>
                                      <td class="bg-dark">
                                          Mileage
                                      </td>
                                      <td>@if($asset){{ $asset['odometer'] }} @endif</td>
                                  </tr>
                                  <tr>
                                      <td class="bg-dark">
                                          Last Known Location
                                      </td>
                                      <td>@if($asset) {{ $asset['location'] }} @endif</td>
                                  </tr>

                              </tbody>
                          </table>
                       </div>
                    </div>
            </div>
            <div class="col-xl-12">
                {!! $map['html'] !!}
            </div>
        </div>
    </div>

@endsection



@push('scripts')


@endpush
