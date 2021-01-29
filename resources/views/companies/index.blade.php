@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')

@include('partials.messages')

<!--Top Table UI-->
<div class="card p-2 mb-5">

    <!--Grid row-->
    <div class="row">

        <!--Grid column-->
        <div class="col-lg-3 col-md-12">

            <!--Name-->
            <select class="mdb-select colorful-select dropdown-primary mx-2">
                <option value="" disabled selected>Bulk actions</option>
                <option value="1">Delate</option>
                <option value="2">Export</option>
                <option value="3">Change segment</option>
            </select>

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6">

            <!--Blue select-->
            <select class="mdb-select colorful-select dropdown-primary mx-2">
                <option value="" disabled selected>Show only</option>
                <option value="1">All <span> (2000)</span></option>
                <option value="2">Never opened <span> (200)</span></option>
                <option value="3">Opened but unanswered <span> (1800)</span></option>
                <option value="4">Answered <span> (200)</span></option>
                <option value="5">Unsunscribed <span> (50)</span></option>
            </select>
            <!--/Blue select-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6">

            <!--Blue select-->
            <select class="mdb-select colorful-select dropdown-primary mx-2">
                <option value="" disabled selected>Filter segments</option>
                <option value="1">Contacts in no segments <span> (100)</span></option>
                <option value="1">Segment 1 <span> (2000)</span></option>
                <option value="2">Segment 2 <span> (1000)</span></option>
                <option value="3">Segment 3 <span> (4000)</span></option>
            </select>
            <!--/Blue select-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-3 col-md-6">

            <form class="form-inline md-form mt-2 ml-2">
                <input class="form-control my-0" type="text" placeholder="Search" style="max-width: 150px;">
                <button class="btn btn-sm btn-primary ml-2 px-1"><i class="fa fa-search"></i>  </button>
            </form>

        </div>
        <!--Grid column-->

    </div>
    <!--Grid row-->

</div>
<!--Top Table UI-->

<div class="card card-cascade narrower">

    <!--Card image-->
    <div class="view view-cascade gradient-card-header blue-gradient narrower py-2 mx-4 mb-3 d-flex justify-content-between align-items-center">

        <div>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fa fa-th-large mt-0"></i></button>
            <button type="button" class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fa fa-columns mt-0"></i></button>
        </div>

        <a href="" class="white-text mx-3">Companies</a>
@permission('company.add')
        <div>
            
            <a href="companies/create"  class="btn btn-outline-white btn-rounded btn-sm px-2"><i class="fa fa-plus-circle mt-0"></i> </a>
            
        </div>
@endpermission
    </div>
    <!--/Card image-->

    <div class="px-4">

        <div class="table-wrapper">
            <!--Table-->
            <table class="table table-hover mb-0">

                <!--Table head-->
                <thead>
                    <tr>
                        <th>
                            <input class="form-check-input" type="checkbox" id="checkbox">
                            <label class="form-check-label" for="checkbox" class="mr-2 label-table"></label>
                        </th>
                        <th class="th-lg"><a>Company Name <i class="fa fa-sort ml-1"></i></a></th>
                        <th class="th-lg"><a href="">Address<i class="fa fa-sort ml-1"></i></a></th>
                        <th class="th-lg"><a href="">Phone<i class="fa fa-sort ml-1"></i></a></th>
                        <th class="th-lg"><a href="">Email<i class="fa fa-sort ml-1"></i></a></th>
                        <th></th>

                    </tr>
                </thead>
                <!--Table head-->

                <!--Table body-->
                <tbody>
                    @if(count($companies) > 0)
                        @foreach($companies as $company)
                    <tr>
                        <th scope="row">
                            <input class="form-check-input" type="checkbox" id="checkbox{{$company->id}}">
                            <label class="form-check-label" for="checkbox{{$company->id}}" class="label-table"></label>
                        </th>
                        <td>{{$company->name}}</td>
                        <td>{{$company->street_number}} {{$company->route}} {{$company->locality}}, {{$company->state}} {{$company->postal_code}}</td>
                        <td>{{$company->phone}}</td>
                        <td>{{$company->email}}</td>
                        <td>
                            @permission('company.view')
                            <a href="companies/{{$company->id}}" >
                                <button type="button" class="btn btn-outline-blue btn-rounded btn-sm px-2"><i class="fa fa-info-circle mt-0"></i></button>
                            </a>
                            @endpermission
                            @permission('company.edit')
                            <a href="companies/{{$company->id}}/edit">
                                <button type="button" class="btn btn-outline-blue btn-rounded btn-sm px-2"><i class="fa fa-pencil mt-0"></i></button>
                            </a>
                            @endpermission
                            @permission('company.delete')
                            {!! Form::open(['route' => ['companies.destroy', $company->id], 'id' => 'companies-form']) !!}
                             {{Form::hidden('_method', 'DELETE')}}
                             {{Form::submit('D', ['class' => 'btn btn-outline-blue btn-rounded btn-sm px-2'])}}
                            
                            {!!Form::close()!!}
                            @endpermission
                        </td>
                    </tr>
                    @endforeach
                   
                    @else
                        <tr>
                            <th colspan="6">No Companies to View</th>
                        </tr>
                    @endif
                	
                </tbody>
                <!--Table body-->
            </table>
            <!--Table-->
        </div>

        <hr class="my-0">

        <!--Bottom Table UI-->
        <div class="d-flex justify-content-between">

            <!--Name-->
            <select class="mdb-select colorful-select dropdown-primary mt-2 hidden-md-down">
                <option value="" disabled >Rows number</option>
                <option value="1" selected>10 rows</option>
                <option value="2">25 rows</option>
                <option value="3">50 rows</option>
                <option value="4">100 rows</option>
            </select>

            <!--Pagination -->
            <nav class="my-4">
                
            </nav>
            <!--/Pagination -->

        </div>
        <!--Bottom Table UI-->

    </div>
</div>
@stop

@section('styles')
    <style>
        .table-wrapper {
			    display: block;
			    max-height: 300px;
			    overflow-y: auto;
			    -ms-overflow-style: -ms-autohiding-scrollbar;
			}
    </style>
@stop
 
@section('scripts')

    {!! HTML::script('assets/js/chart.min.js') !!}
    {!! HTML::script('assets/js/as/dashboard-admin.js') !!}
    <script type="text/javascript">
		$(document).ready(function () {
  $('#dtMaterialDesignExample').DataTable();
  $('#dtMaterialDesignExample_wrapper').find('label').each(function () {
    $(this).parent().append($(this).children());
  });
  $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('input').each(function () {
    $('input').attr("placeholder", "Search");
    $('input').removeClass('form-control-sm');
  });
  $('#dtMaterialDesignExample_wrapper .dataTables_length').addClass('d-flex flex-row');
  $('#dtMaterialDesignExample_wrapper .dataTables_filter').addClass('md-form');
  $('#dtMaterialDesignExample_wrapper select').removeClass('custom-select custom-select-sm form-control form-control-sm');
  $('#dtMaterialDesignExample_wrapper select').addClass('mdb-select');
  $('#dtMaterialDesignExample_wrapper .mdb-select').material_select();
  $('#dtMaterialDesignExample_wrapper .dataTables_filter').find('label').remove();
});
    </script>
@stop