<table id="school_table" align=center class="table table">
            <tr>
                <th>Please enter all EMS state certifications.</th>
            </tr>
            <tr id="row1">
                <input type='hidden' class='form-control' name='sc[index][user_id]' value="450" >
                <input type='hidden' class='form-control' name='sc[index][status]' value="1" >
                <td> 
                    <select class="mdb-select md-form" name="sc[index][state]">
                      <option value="" disabled selected>Choose your option</option>
                      <option value="1">Ohio</option>
                      <option value="2">Kentucky</option>
                      <option value="3">West Virgina</option>
                    </select>
                 </td>
                <td>
                    
                    <select class="mdb-select md-form" name="sc[index][certification_level]">
                      <option value="" disabled selected>Choose your option</option>
                      @foreach($cert_level as $row)
                      <option value="{{$row->id}}">{{$row->label}}</option>
                      @endforeach
                    </select>
                 
                </td>
                <td> </td>
                <td> <div class ="md-form"><input type='text' class='form-control' name='sc[index][cert_number]' placeholder='Certification Number'></div> </td>
            </tr>
        </table>
        <input type="button" class="btn btn-primary" onclick="add_row_school();" value="ADD ROW">
        