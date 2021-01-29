<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>Student Name</td>
            @foreach($classroom->gradebook as $row)
                <th>{{ $row->label  }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    @foreach($classroom->students as $row)
    @if($row->user_id)
        <tr>
        <td>{{$row->employee->last_name ?? ''}}, {{$row->employee->first_name ?? ''}}</td>
        @foreach($classroom->gradebook as $grades)
            <?php
                $userGrade = Vanguard\ClassRoomStudentGrade::where('user_id', $row->user_id)->where('gradeBookId', $grades->id)->orderBy('grade', 'desc')->first();
            ?>
            <th>

                    <div class="row">
                        <input class="form-control text-center" value="{{ $userGrade->grade ?? '0'}}" data-id=""  />
                    </div>
                    <div class="row">
                        <span id="" class="text-success"><small>Updated</small></span>

                    </div>


            </th>
        @endforeach
    </tr>
        @endif
    @endforeach
    </tbody>
</table>