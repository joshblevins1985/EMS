
    <tr>
        <td>{{  $task->task }}</td>
        <td>{{ $task->goal }}</td>


    <tr >
        <td style="border: none" colspan="2">
            <div class="row">
                <div class="col-xl-1 col-md-6">
                    Date:
                </div>
                <div class="col-xl-3 col-md-6 text-center">
                    @if(count($employeeFtoTasks->where('task_id', $task->id)))
                        @foreach($employeeFtoTasks->where('task_id', $task->id) as $etask)
                            @if(isset($etask->fto_signed))

                                {{ Carbon\Carbon::parse($etask->fto_signed)->format('m-d-Y H:i') }}

                            @else
                                <a href="/fto/ftoComplete/{{ $employee->user_id }}/{{ $task->id }}"><i class="fad fa-badge-check"></i></a>

                            @endif
                        @endforeach
                    @else
                        Add Field Tasks
                    @endif
                </div>
                <div class="col-xl-1 col-md-6">
                    FTO:
                </div>
                <div class="col-xl-3 col-md-6 text-center">
                    @if(count($employeeFtoTasks->where('task_id', $task->id)))
                        @foreach($employeeFtoTasks->where('task_id', $task->id) as $etask)
                            @if(isset($etask->fto_signed))

                                <span style="font-family: 'Pacifico', cursive;">
                                {{ mb_substr($etask->fieldOfficer->first_name, 0, 1, "UTF-8")  }}{{ mb_substr($etask->fieldOfficer->last_name, 0, 1, "UTF-8")   }}
                            </span>

                            @else
                                <a href="/fto/ftoComplete/{{ $employee->user_id }}/{{ $task->id }}"><i class="fad fa-badge-check"></i></a>

                            @endif
                        @endforeach
                    @else
                        Add Field Tasks
                    @endif
                </div>
                <div class="col-xl-1 col-md-6">
                    Employee:
                </div>
                <div class="col-xl-3 col-md-6 text-center">

                    @if(count($employeeFtoTasks->where('task_id', $task->id)))
                        @foreach($employeeFtoTasks->where('task_id', $task->id) as $etask)
                            @if(Auth::user()->id == $employee->user_id)
                                @if(isset($etask->user_signed))

                                    <span style="font-family: 'Pacifico', cursive;">
                                {{ mb_substr($etask->trainee->first_name, 0, 1, "UTF-8")  }}{{ mb_substr($etask->trainee->last_name, 0, 1, "UTF-8")   }}
                            </span>

                                @else
                                    <a href="/fto/traineeComplete/{{ $employee->user_id }}/{{ $task->id }}"><i class="fad fa-badge-check"></i></a>

                                @endif
                            @elseif(isset($etask->user_signed))
                                <span style="font-family: 'Pacifico', cursive;">
                                {{ mb_substr($etask->trainee->first_name, 0, 1, "UTF-8")  }}{{ mb_substr($etask->trainee->last_name, 0, 1, "UTF-8")   }}
                            </span>
                            @endif

                        @endforeach
                    @else
                        Add Field Tasks
                    @endif

                </div>
            </div>

        </td>
    </tr>
    </tr>
