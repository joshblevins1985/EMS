@foreach($encounters as $row)
    <tr>
        <td>{{date('M d, Y', strtotime($row->doi))}}</td>
        <td>@if(!$row->employee) Unknown @else{{$row->employee->first_name}} {{$row->employee->last_name}}@endif</td>
        <td>
            @if($row->encounter_type == 1)
                File Notation
            @elseif($row->encounter_type == 2)
                Corrective Counciling
            @elseif($row->encounter_type == 3)
                Verbal Warning
            @elseif($row->encounter_type == 4)
                Written Warning
            @elseif($row->encounter_type == 5)
                Suspension
            @elseif($row->encounter_type == 6)
                Termination
            @elseif($row->encounter_type == 7)
                Resignation
            @elseif($row->encounter_type == 8)
                Deemed Non-Driver
            @elseif($row->encounter_type == 9)
                Last Chance Agreement
            @endif
        </td>
        <td></td>
        <td>{!!$row->incident_report!!}</td>
        
        <td>
            @if(count($row->encounterreport))
            <i class="fa fa-paperclip" style="color: green" aria-hidden="true"></i>
            @else
                
            @endif
        </td>
        <td>
            <div class="dropdown show d-inline-block">
            <a class="btn btn-icon"
               href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

                <a href="/compliance/{{$row->id}} " class="dropdown-item text-gray-500">
                    <i class="fas fa-eye mr-2"></i>
                    View Incident
                </a>
            </div>
        </div>

        <a href="/compliance/{{$row->id}}/edit "
           class="btn btn-icon edit"
           title="Edit Incident"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>
        @role('company.admin', 'Admin')
        <a href="{{ route('compliance.destroy', $row->id) }}"
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
        @endrole
        </td>
    </tr>
@endforeach