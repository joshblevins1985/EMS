@extends('layouts.sidebar-fixed')

@section('title', 'Scholarship Class')

@push('css')
    <link rel="stylesheet" href="/assets/css/mdb.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="/ßassets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />

@endpush

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{count($course->applicants)}}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-light ">
                                <i class="fas fa-users-class"></i>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Total Interested</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{count($course->applicants->where('status', 4))}}</h3>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-light">
                                <i class="fad fa-users-class"></i>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Enrolled</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{count($course->applicants->where('status', 8))}}</h3>

                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-danger">
                                <i class="fal fa-meh-rolling-eyes"></i>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Dropped</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-9">
                            <div class="d-flex align-items-center align-self-start">
                                <h3 class="mb-0">{{count($course->applicants->where('status', 7))}}</h3>

                            </div>
                        </div>
                        <div class="col-3">
                            <div class="icon icon-box-success ">
                                <span class="mdi mdi-arrow-top-right icon-item"></span>
                            </div>
                        </div>
                    </div>
                    <h6 class="text-muted font-weight-normal">Failed</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12">
                            @include('scholarships.partials.indexTable')
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3">
            <div class="row mb-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="preview-list">
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-primary">
                                            <i class="mdi mdi-file-document"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Applied</h6>
                                            <p class="text-muted mb-0"></p>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">## Students</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-success">
                                            <i class="mdi mdi-cloud-download"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Accepted</h6>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">## Students</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-info">
                                            <i class="mdi mdi-clock"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Denied</h6>

                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">## Students</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item border-bottom">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-danger">
                                            <i class="mdi mdi-email-open"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Testing</h6>

                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">## Students</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="mdi mdi-chart-pie"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Passed</h6>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">## Students</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="mdi mdi-chart-pie"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Failed</h6>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">## Students</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="mdi mdi-chart-pie"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Dropped</h6>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">## Students</p>

                                        </div>
                                    </div>
                                </div>
                                <div class="preview-item">
                                    <div class="preview-thumbnail">
                                        <div class="preview-icon bg-warning">
                                            <i class="mdi mdi-chart-pie"></i>
                                        </div>
                                    </div>
                                    <div class="preview-item-content d-sm-flex flex-grow">
                                        <div class="flex-grow">
                                            <h6 class="preview-subject">Certified</h6>
                                        </div>
                                        <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                            <p class="text-muted">## Students</p>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')

    <script src="/assets/plugins/select2/dist/js/select2.min.js"></script>

    <script>


        var handleSelect2 = function() {
            $(".status").select2();
        };


        var FormPlugins = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleSelect2();
                }
            };
        }();

        $(document).ready(function() {
            FormPlugins.init();
        });

    </script>

    <script>
        function setUpdateAction() {
            document.frmStudent.action = "/scholarship/studentUpdate";
            document.frmStudent.submit();
        }
    </script>

@endpush
