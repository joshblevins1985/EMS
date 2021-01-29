@extends('layouts.default')

@section('title', 'Administration Dashboard')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet"/>
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet"/>
    <link href="/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Pacifico&display=swap" rel="stylesheet">
    <style>
        .hiddenRow {
            padding: 0 !important;
        }
    </style>
@endpush

@section('content')

    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">CPR Calendar</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">CPR Class Dashboard</a></li>

    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header mb-3">CPR Class Dashboard</h1>
    <!-- end page-header -->
    @include('partials.toastr')

    <div class="row">
        <div class="col-lg-4">

        </div>
        <div class="col-lg-4">
            <a href="/cpr/invoice/{{$cpr->id}}"><button type="button"  class="btn btn-primary">Print PDF Invoice</button></a>
            <a href="/cpr/invoice/send/{{$cpr->id}}"><button type="button"  class="btn btn-primary">Send Invoice</button></a>
        </div>
        <div class="col-lg-4">
            <h1>ID: {{$cpr->id}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2>Bill To <a  data-toggle="modal" data-target="#cprClassEditModal" href="#" data-classid="{{ $cpr->id }}" data-toggle="tooltip" data-placement="top" title="Edit Info">
                    <i class="fad fa-edit"></i>
                </a></h2>
            <address>
                <strong>{{$cpr->facility->name}}</strong><br>
                {{$cpr->facility->house_number}} {{$cpr->facility->street}}<br>
                {{$cpr->facility->city}}, {{$cpr->facility->state}} {{$cpr->facility->zip}}<br>
                <abbr title="Email">E:</abbr> {{$cpr->email or 'No Email Provided' }}
            </address>
        </div>
        <div class="col-lg-6">
            <h2>Send Payment to</h2>
            <address>
                <strong>Portsmouth Emergecny Ambulance</strong><br>
                <strong>Accounting Training</strong><br>
                2796 Gallia Street<br>
                Portsmouth, Ohio 45662<br>
                <abbr title="Email">E:</abbr> training@peasi.net
            </address>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <h4>Date of Class:</h4>
        </div>
        <div class="col-lg-4">
            <h4>{{ Carbon\Carbon::parse($cpr->start_date)->format('M d, Y') }}</h4>

        </div>
    </div>

    <div class="row">
        <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#studentModal" data-class_id="{{$cpr->id}}" >Add New Student</button>
    </div>

    <div class="row">
        <table class="table table-striped">
            <thead class="black white-text">
            <tr>
                <th>Student Name</th>
                <th>Card Cost</th>
            </tr>
            </thead>
            <tbody>
            @if($cpr->students)
                @foreach($cpr->students as $row)
                    <tr>
                        <td>{{$row->student}}</td>
                        <td>@if($cpr->facility->contracted == 1) $6.00 @else $50.00 @endif</td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <table class="table">
                <tbody>
                <tr>
                    <td>Subtotal</td>
                    <td>
                        <?php
                        if($cpr->facility->contracted == 1){
                            $subtotal = count($cpr->students) * 6;
                            echo '$'. number_format($subtotal, 2);
                        }else{

                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Tax</td>
                    <td>$0.00</td>
                </tr>
                <tr>
                    <td>Total</td>
                    <td>$ {{number_format($subtotal, 2)}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>





@endsection

<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="studentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModal">Add New Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['url' => route('cpr.student'), 'method' => 'POST']) !!}
                @csrf
                <input type="hidden" id="classInput" name="class_id" value=""></iput>
                <div class="md-form">
                    <input type="text" id="student" name="student" class="form-control">
                    <label for="student">Student Full Name</label>
                </div>


                <button class="btn btn-info btn-block my-4" type="submit">Add New CPR Class</button>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>

@include('cpr.partials.modalCprClassEdit')

@include('fto.partials.ftoDateModal')

@push('scripts')

    <script>
        $('#studentModal').on('show.bs.modal', function(e) {
            var class_id = $(e.relatedTarget).data('class_id');

            $("#classInput").val(class_id);
        });
    </script>

    <script>

        $('#cprClassEditModal').on('show.bs.modal', function (e) {

            var classId = $(e.relatedTarget).data('classid');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            // AJAX request
            $.ajax({
                url: '/cpr/editModal/' + classId,
                type: 'get',
                data: {},
                success: function (response) {
                    // Add response in Modal body
                    $('.modal-body').html(response);
                    $('#cprClassEditModal').modal('show');

                }
            });

        });


    </script>

@endpush
