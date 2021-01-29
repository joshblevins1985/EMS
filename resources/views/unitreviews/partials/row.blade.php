<tr>
    <td>{{$row->unit->unit_number or $row->unit_id.'*'}}</td>
    <td>@if($row->date_requested == NULL) Not Requested @else {{ date('M d, Y', strtotime($row->date_requested))}} @endif</td>
    <td>@if($row->date_requested == NULL) Not Reviewed @else {{ date('M d, Y', strtotime($row->date_reviewed))}} @endif</td>
    <td>{{count($row->driver_assessments)}}</td>
    <td>
        <div class="dropdown show d-inline-block">
            <a class="btn btn-icon"
               href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

                <a href="/unitreview/{{$row->id}} " class="dropdown-item text-gray-500">
                    <i class="fas fa-eye mr-2"></i>
                    View Incident
                </a>
            </div>
        </div>

        <a href="# "
           class="btn btn-icon edit"
           title="Edit Incident"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>
        <a href="#"
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