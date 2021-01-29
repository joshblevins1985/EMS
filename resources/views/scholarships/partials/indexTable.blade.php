<form name="frmStudent" method="post" action="">
    <div class="row">
        @csrf
        <div class="col-xl-3 pull-right">
            <div class="form-group">
                <select class="select2 form-control" name="status" style="width: 100%" >
                    <option value="" disabled selected>Update Student Status </option>
                    <option value="1">Applied</option>
                    <option value="2">Accepted</option>
                    <option value="3">Denied</option>
                    <option value="4">Enrolled</option>
                    <option value="5">Testing</option>
                    <option value="6">Passed</option>
                    <option value="7">Failed</option>
                    <option value="8">Dropped</option>
                </select>
            </div>
        </div>

        <div class="col-xl-3 pull-right">
            <input type="button" class="btn btn-primary" name="update" value="Update" onClick="setUpdateAction();" />
        </div>
    </div>
    <div class="row">
        <table id="data-table-default" class="table table-striped  table-td-valign-middle" >
            <thead>
            <tr>
                <th></th>
                <th >Student</th>
                <th >Status</th>
                <th>Reading</th>
                <th >EMT Assessment</th>
                <th >Math</th>
                <th >Contract</th>
                <th>Book Agreement</th>
            </tr>
            </thead>
            <tbody>
            @foreach($course->applicants as $student)
                <tr class="odd gradeX
                  @if($student->status == 1) bg-light @elseif($student->status == 2) bg-info @elseif($student->status == 3) bg-warning @elseif($student->status == 4)  @elseif($student->status == 5) bg-primary @elseif($student->status == 6) bg-success @elseif($student->status == 7) bg-danger @elseif($student->status == 8) bg-danger @endif
                        "
                >
                    <td>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="checkbox" name="student[]" id="{{$student->id}}" value="{{$student->id}}">
                            </label>
                        </div>
                    </td>
                    <td>{{$student->student}}</td>
                    <td>
                        @if($student->status == 1) Applied @elseif($student->status == 2) Accepted @elseif($student->status == 3) Denied @elseif($student->status == 4) Enrolled @elseif($student->status == 5) Testing @elseif($student->status == 6) Passed @elseif($student->status == 7) Failed @elseif($student->status == 8) Dropped @endif
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</form>
