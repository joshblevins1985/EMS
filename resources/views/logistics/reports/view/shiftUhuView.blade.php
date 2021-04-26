@extends('layouts.coreui')

@section('page-title', __('Shift UHU Report'))
@section('page-heading', __('Shift UHU Report'))


@section('content')
    <div class="row mb-3">
        <div class="col-xl-12 text-center">
            <input type="text" style="width: 100%" name="daterange" id="reportrange" value="{{\Carbon\Carbon::today()->format('m/d/Y')}} - {{\Carbon\Carbon::today()->format('m/d/Y')}}" />
        </div>
    </div>

    @include('reports.shiftUhuBody')

@stop

@push('css')
<style>
    .progress {
        position: relative;
    }

    .progress span {
        position: absolute;
        display: block;
        width: 100%;
        color: black;
    }

</style>
@endpush

@push('scripts')

    <script type="text/javascript">
        $(function() {

            var start = moment();
            var end = moment();

            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

        });

        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
            const start = picker.startDate.format('YYYY-MM-DD');
            const end = picker.endDate.format('YYYY-MM-DD');

            window.location.href = "/shiftUhuView/"+ start + '/' + end;
        });
    </script>

@endpush
