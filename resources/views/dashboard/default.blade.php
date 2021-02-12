@extends('layouts.clean-right')

@section('title', 'Administration Dashboard')

@push('css')
    <link href="assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet"/>
    <link href="assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet"/>
    <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"/>
    <link rel="stylesheet" href="/assets/corona/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
@endpush


@section('content')
    <!-- begin breadcrumb -->

    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">Employee Dashboard</h1>


    <!-- end page-header -->
    <div class="row">
        <div class="col-xl-12">
            <div class="row-fluid">
                <!-- start panel -->
                <div class="panel panel-inverse">

                    <div class="panel-body pr-1">
                        <div class="row mb-3 mt-3">
                            @include('dashboard.partials.attendance')

                            @include('dashboard.partials.qa')

                            @include('dashboard.partials.badRunSheet')
                        </div>

                    </div>
                </div>
                <!-- end panel -->
            </div>
            @if($todos)

            @endif

            @if(Auth::user()->id == 450 || Auth::user()->employee->employee_status == 2)
                <div class="row">
                    @include('dashboard.partials.orientation')
                </div>
            @endif


            @if(Auth::user()->id == 40 || Auth::user()->employee->primary_position == 23 || in_array(21, explode(',', $employee->additional_postions )))
                <div class="row-fluid">
                    <!-- begin card -->
                    <div class="card bg-dark text-white mb-3 overflow-hidden">
                        <!-- begin card-body -->
                        <div class="card-body">
                            @include('dashboard.partials.mechanic')
                        </div>
                        <!-- end card-body -->
                    </div>
                    <!-- end card -->
                </div>
            @endif
        </div>
    </div>



    @include('dashboard.partials.modalAttendance')
    @include('dashboard.partials.modalCompliance')
    @include('dashboard.partials.modalQa')
    @include('fto.partials.ftoDateModal')
    @include('dashboard.partials.modalAddCompanyMeeting')
    @include('dashboard.partials.modalMeeting')
@endsection

@section('content-right')
    <div class="col-xl-12">
        <div class="row">
            <div class="col-xl-12">
                <!-- start panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title">What would you like to do?</h3>

                    </div>
                    <div class="panel-body pr-1 mb-2">
                        @if(Auth::user()->id == 450 || Auth::user()->employee->employee_status == 2)
                            <button class="btn btn-block btn-warning p-4"> Add New Training Date</button>
                        @endif

                        @if(in_array(21, explode(',', $employee->additional_postions )))
                            <a href="/fto/dashboard">
                                <button class="btn btn-block btn-primary p-4 mb-2"> FTO Dashboard</button>
                            </a>
                        @endif

                    </div>
                </div>
                <!-- end panel -->
            </div>

        </div>

        <div class="row">
            <div class="col-xl-12">
                <!-- start panel -->
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h3 class="panel-title">Newsletters</h3>

                    </div>
                    <div class="panel-body pr-1 mb-2">
                    @foreach($blogs as $blog)
                        <!-- begin card -->
                            <div class="card border-0 mb-3">

                                <div class="">
                                    <h4 class="card-title">{{$blog->title}}</h4>
                                    {!! strip_tags(substr($blog->content, 0, 200))   !!}
                                    <p class="card-text">Last updated {{Carbon\Carbon::parse($blog->updated_At)->diffForHumans()}}</p>
                                    <p class="card-text"><a class="btn btn-primary" href="/blog/{{$blog->id}}">Read More</a></p>
                                </div>
                            </div>
                            <!-- end card -->
                        @endforeach
                    </div>
                </div>
                <!-- end panel -->
            </div>

        </div>

    </div>
@endsection

@push('scripts')

    <script src="assets/plugins/moment/moment.js"></script>
    <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/assets/plugins/parsleyjs/dist/parsley.min.js"></script>
    <script src="/assets/plugins/highlight.js/highlight.min.js"></script>
    <script src="/assets/corona/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

    <script>
        $('#newTodoNoteModal').on('show.bs.modal', function(e) {
            var tid = $(e.relatedTarget).data('tid');

            $("#tid").val(tid);
        });
    </script>

    <script>
        $('#meetingModal').on('show.bs.modal', function(e) {
            var id = $(e.relatedTarget).data('id');

            $.get(
                '/companyMeeting/'+ id,
                function(result) {

                    $('#meeting').append(result);
                    //console.log(response[0].message);

                }
            );
        });
    </script>

    <script>
        $('.datepicker').datepicker({

        });
    </script>

    <script>
        var current = location.pathname;
        console.log(current);
    </script>

@endpush
