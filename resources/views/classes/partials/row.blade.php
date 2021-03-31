<tr>
    <td>{{$row->iid}}</td>
    <td>{{$row->course->title ?? ''}}</td>
    <td>{{$row->location}}</td>
    <td>{{date('m-d-Y', strtotime($row->start))}}</td>
    <td>{{date('m-d-Y', strtotime($row->end))}}</td>
    <td>{{count($row->students)}}</td>
    <td></td>
    <td>
        @if($row->status == 1)
        Open
        @elseif($row->status == 2)
        Closed
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

                <a href="classes/{{$row->id}} " class="dropdown-item text-gray-500">
                    <i class="fas fa-eye mr-2"></i>
                    View Incident
                </a>
            </div>
        </div>

        <a href="classes/{{$row->id}}/edit "
           class="btn btn-icon edit"
           title="Edit Incident"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>
        <a href="{{ route('classes.destroy', $row->id) }}"
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
    </td>
</tr>
