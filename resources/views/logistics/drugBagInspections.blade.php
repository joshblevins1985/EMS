@extends('layouts.clean')

@section('page-title', __('Drug Bag Management'))
@section('page-heading', __('Drug Bag Management'))


@section('content')
    @include('partials.messages')


    <div class="row">
        <div class="table-responsive">
            <div class="col-xl-12">
                <table class="table table-striped" id="drugBagTable">
                    <thead>
                    <tr>
                        <th>Completed</th>
                        <th>Station</th>
                        <th>Bag ID</th>
                        <th>Completed By</th>
                        <th>Witness</th>
                        <th>Expired Drugs</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($inspections as $d)
                        <?php
                        $assigned = \Vanguard\User::where('id', $d->items['baginfo']['assignedId'])->first();
                        $witness = \Vanguard\User::where('id', $d->items['baginfo']['witnessId'])->first();
                        ?>
                        <tr>
                            <td>{{\Carbon\Carbon::parse($d->created_at)->format('m-d-Y H:i')}}</td>
                            <td>{{$d->bag->station->description}}</td>
                            <td>{{$d->bag->description ?? 'Unknown'}}</td>
                            <td>{{$assigned->first_name ?? ''}} {{$assigned->last_name ?? ''}}</td>
                            <td>{{$witness->first_name ?? ''}} {{$witness->last_name ?? ''}}</td>
                            <td>
                            <?php
                            $count = 0;
                            foreach($d->items['drugs'] as $key => $value)
                                {
                                    if(\Carbon\Carbon::today() <= \Carbon\Carbon::parse($value))
                                        {
                                            $count++;
                                        }
                                }
                            ?>
                                {{$count}}
                            </td>
                            <td><div class="row">@if($d->id) <div class="col"> <a href="/drugbaginspectionPdf/{{$d->id}}"><i class="fad fa-file-pdf"></i></a> </div> @endif</div></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@push('css')

@endpush

@push('modals')

@endpush


@push('scripts')
    <script>
        $(document).ready( function () {
            $('#drugBagTable').DataTable();
        } );
    </script>

@endpush
