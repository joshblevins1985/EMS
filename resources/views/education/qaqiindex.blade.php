@extends('layouts.app')

@section('page-title', trans('app.dashboard'))
@section('page-heading', trans('app.dashboard'))

@section('breadcrumbs')
    <li class="breadcrumb-item active">
        @lang('Companies')
    </li>
@stop

@section('content')

    @include('partials.toastr')

    <div class="row">
        <div class="col-9">
            <form class="form-inline" role="search" method="GET" action="#">
                <select class="mdb-select" id="name" name="name" searchable="Search here..">
                    <option value="" disabled selected>Choose Employee</option>
                    @foreach($employees as $id => $employee_name)
                        <option value="{{$id}}">{{$employee_name}}</option>
                    @endforeach
                </select>

                <div class="md-form mb-4 mr-sm-2">
                    <input placeholder="Select date" type="text" id="date" name="date" class="form-control datepicker">
                    <label for="date">Search by Date</label>
                </div>

                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </form>
        </div>

        <div class="col-lg-3 col-sm-12">
            <div class="row">
                <a href="{{ route('qaqi.create') }}">
                    <button type="button" class="btn btn-outline-primary btn-rounded waves-effect">Add New QA/QI
                        Review
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-sm-12">
            <table class="table table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Employee</th>
                    <th>Date of Review</th>
                    <th>Date of Run</th>
                    <th>Grade</th>
                </tr>
                </thead>
                <tbody>
                @foreach($qa as $row)
                    <tr>
                        <td><a href="/qaqi/{{$row->id}}">QA-{{date('y', strtotime($row->date))}}
                                -{{sprintf('%05d', $row->id )}}</a></td>
                        <td>{{$row->employee->first_name}} {{$row->employee->last_name}}</td>
                        <td>{{date('Y-m-d', strtotime($row->created_at))}}</td>
                        <td>{{date('Y-m-d', strtotime($row->date))}}</td>
                        <td>
                            @if($row->grade == 1)
                                Sufficient
                            @elseif($row->grade == 2)
                                Insufficient
                            @else
                                Unknown
                            @endif</td>
                        <td>
                            <div class="dropdown show d-inline-block">
                                <a class="btn btn-icon"
                                   href="#" role="button" id="dropdownMenuLink"
                                   data-toggle="dropdown"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

                                    <a href="/qaqi/{{$row->id}} " class="dropdown-item text-gray-500">
                                        <i class="fas fa-eye mr-2"></i>
                                        View Incident
                                    </a>
                                </div>
                            </div>
                            @permission('qaqi.edit')
                            <a href="/qaqi/{{$row->id}}/edit "
                               class="btn btn-icon edit"
                               title="Edit Incident"
                               data-toggle="tooltip" data-placement="top">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endpermission
                            @permission('qaqi.delete')
                            <a href="{{ route('qaqi.destroy', $row->id) }}"
                               class="btn btn-icon bg-danger"
                               title="@lang('app.delete_user')"
                               data-toggle="tooltip"
                               data-placement="top"
                               data-method="DELETE"
                               data-confirm-title="@lang('app.please_confirm')"
                               data-confirm-text="Are you sure you want to delete this incident"
                               data-confirm-delete="@lang('app.yes_delete_him')">
                                <i class="fas fa-trash"></i>
                            </a>
                            @endpermission
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$qa->links()}}
        </div>





        <div class="col-lg-2 col-sm-12">
            <!--Panel-->
            <div class="card text-center">
                <div class="card-header primary-color white-text">
                    QA QI Menu
                </div>
                <div class="card-body">
                    <ul class="nav flex-column">

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="true" aria-expanded="false">Reports</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                   data-target="#basicExampleModal2">Report By Date</a>

                            </div>
                        </li>


                    </ul>


                </div>
                <div class="card-footer text-muted primary-color white-text">
                    <p class="mb-0"></p>
                </div>
            </div>
            <!--/.Panel-->
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Vial of Medication</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('qaqi.store') }}" method="POST">
                        {{csrf_field()}}

                        <div class="md-form">
                            <input placeholder="Date of Run" type="text" id="date" name="date"
                                   class="form-control datepicker" required>
                            <label for="doi">Date of Run</label>
                        </div>

                        <select class="mdb-select" id="employee_id" name="employee_id" searchable="Search here..">
                            <option value="" disabled selected>Select Authoring Employee</option>
                            @foreach($employees as $id => $employee)
                                <option value="{{$id}}">{{$employee}}</option>
                            @endforeach
                        </select>


                        <input type='text' class='form-control' name='location'
                               placeholder='Enter pick up location of run.' required>

                        <select class="mdb-select md-form" name="protocol">
                            <option value="" disabled selected>Select Protocol</option>
                            @foreach($protocols as $id => $protocol)
                                <option value="{{$id}}">{{$protocol}}</option>
                            @endforeach
                        </select>

                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="defaultGroupExample1" value="1"
                                   name="grade" checked>
                            <label class="custom-control-label" for="defaultGroupExample1">Sufficient</label>
                        </div>

                        <!-- Group of default radios - option 2 -->
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" value="2" id="defaultGroupExample2"
                                   name="grade">
                            <label class="custom-control-label" for="defaultGroupExample2">Insufficient</label>
                        </div>

                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" id="eresponse1" value="1" name="eresponse"
                                   checked>
                            <label class="custom-control-label" for="eresponse1">No Response Needed</label>
                        </div>
                        <!-- Group of default radios - option 2 -->
                        <div class="custom-control custom-radio">
                            <input type="radio" class="custom-control-input" value="2" id="eresponse2" name="eresponse">
                            <label class="custom-control-label" for="eresponse2">Request for Incident Report</label>
                        </div>

                        <div class="form-group">
                            <label for="comments">Comments</label>
                            <textarea class="form-control rounded-0" id="exampleFormControlTextarea1" name="comments"
                                      rows="10"></textarea>
                        </div>

                        <table id="employee_table" align=center class="table table">
                            <tr>
                                <th>Select All Deficiencies Found</th>
                            </tr>
                            <tr id="row1">
                                <td><input type='text' class='form-control' name='deficiencies[]'
                                           placeholder='Describe Deficiency'></td>
                            </tr>
                        </table>
                        <input type="button" class="btn btn-primary" onclick="add_row();" value="ADD ROW">
                        <input type="submit" class="btn btn-success" name="submit_row" value="SUBMIT">
                    </form>

                </div>

            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="basicExampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Create QA QI By Date Report</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="height: 600px;">
                    <form class="form-inline" role="search" method="GET" action="{{url('/qa/report/pdf')}}">
                        @csrf


                        <div class="md-form">
                            <input placeholder="Selected date" type="text" id="start" name="start"
                                   class="form-control datepicker">
                            <label for="expiration">Start Date</label>
                        </div>

                        <div class="md-form">
                            <input placeholder="Selected date" type="text" id="end" name="end"
                                   class="form-control datepicker">
                            <label for="expiration">End Date</label>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Get Report</button>

                    </form>
                </div>
            </div>
        </div>
    </div>


@stop

@section('styles')

@stop

@section('scripts')
    <script type="text/javascript">
        function add_row() {
            $rowno = $("#employee_table tr").length;
            $rowno = $rowno + 1;
            $("#employee_table tr:last").after("<tr id='row" + $rowno + "'><td><input type='text' class='form-control' name='deficiencies[]' placeholder='Describe Deficiency'></td><td><input type='button' class='btn btn-danger' value='DELETE' onclick=delete_row('row" + $rowno + "')></td></tr>");
        }

        function delete_row(rowno) {
            $('#' + rowno).remove();
        }
    </script>

@stop