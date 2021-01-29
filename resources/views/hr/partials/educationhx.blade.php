<table id="school_table" align=center class="table table">
    <tr>
        <th>Please enter all EMS state certifications.</th>
    </tr>
    <tr id="row1">
        <input type='hidden' class='form-control' name='edu[index][application_id]' value="{{$employee}}" placeholder='Start Date'/>
        <td> <div class ="md-form"><input type='text' class='form-control' name='edu[index][completed]' placeholder='Year Completed'></div> </td>
        <td> <div class ="md-form"><input type='text' class='form-control' name='edu[index][school]' placeholder='School Name'></div> </td>
        <td> <div class ="md-form"><input type='text' class='form-control' name='edu[index][state]' placeholder='State'></div> </td>
        <td> <div class ="md-form"><input type='text' class='form-control' name='edu[index][degree]' placeholder='Degree/Certification'></div> </td>
    </tr>
</table>
        <input type="button" class="btn btn-primary" onclick="add_row_school();" value="ADD ROW">
        