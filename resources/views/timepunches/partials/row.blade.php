<tr>
    <td>{{$row->employee->last_name}}, {{$row->employee->first_name}}</td>
    <td>

        {{Carbon\Carbon::parse($row->time_in)->format('l  M jS, Y H:i:s ')}}

    </td>
    <td class="align-middle">

        {{Carbon\Carbon::parse($row->time_out)->format('l  M jS, Y H:i:s ')}}</td>
    <?php
    $start = date_create($row->time_in);
    $end = date_create($row->time_out)
    ?>
    @if($row->time_out === NULL)
    <td class="align-middle">Calculation Pending</td>
    @else
    <?php
    $interval = $start->diff($end);
    ?>
    <td class="align-middle">{{$interval->format('%h Hours %i minutes')}}</td>
    @endif
    <td>
        <div class="dropdown show d-inline-block">
            <a class="btn btn-icon"
               href="#" role="button" id="dropdownMenuLink"
               data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-h"></i>
            </a>


        </div>

        <a href="timepunches/{{$row->id}}/edit "
           class="btn btn-icon edit"
           title="Edit Time Punch"
           data-toggle="tooltip" data-placement="top">
            <i class="fas fa-edit"></i>
        </a>
        <a href="{{ route('timepunches.destroy', $row->id) }}"
           class="btn btn-icon bg-danger"
           title="@lang('app.delete_user')"
           data-toggle="tooltip"
           data-placement="top"
           data-method="DELETE"
           data-confirm-title="@lang('app.please_confirm')"
           data-confirm-text="Are you sure you want to delete this employees time punch"
           data-confirm-delete="@lang('app.yes_delete_him')">
            <i class="fas fa-trash"></i>
        </a>

    </td>
</tr>