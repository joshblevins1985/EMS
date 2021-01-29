<table id="employee_table" align=center class="table table">
            <tr>
                <th>Please enter the last 5 years employment history.</th>
            </tr>
            <tr id="row1">
                <input type = "hidden" name="rowid" value="0"/>
                <input type='hidden' class='form-control' name='hx[pid][]' value="{{$employee->user_id}}" placeholder='Start Date'>
                <td> <div class ="md-form"><input type='text' class='form-control' name='hx[start][]' placeholder='Start Date'></div> </td>
                <td> <div class ="md-form"><input type='text' class='form-control' name='hx[end][]' placeholder='End Date'></div> </td>
                <td> <div class ="md-form"><input type='text' class='form-control' name='hx[name][]' placeholder='Name'></div> </td>
                <td> <div class ="md-form"><input type='text' class='form-control' name='hx[address][]' placeholder='Address'></div> </td>
                <td> <div class ="md-form"><input type='text' class='form-control' name='hx[wage][]' placeholder='Wages'></div> </td>
                <td> <div class ="md-form"><input type='text' class='form-control' name='hx[leave][]' placeholder='Reason for Leaving'></div> </td>
            </tr>
        </table>
        <input type="button" class="btn btn-primary" onclick="add_row_employment();" value="ADD ROW">
        